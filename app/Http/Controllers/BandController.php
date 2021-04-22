<?php
namespace App\Http\Controllers;
use App\Band;
use App\User;
use App\RequestBand;
use App\Stripe;
use App\Http\Requests\StoreBand;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Illuminate\Support\Facades\Log;
use App\Mail\ApprovalMail;
use App\Mail\DeclineMail;
use App\PushToken;
use App\LinkAgentBand;

/**
 * @group  Band
 *
 */
class BandController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    //

  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  /**
   * @response {
   * "status": "SUCCESS",
   * "server_message": "BAND_CREATED",
   * "user_message": "Your band has been created."
   * }
   * @response 404 {
   * "message": "No query results for model [\App\User]"
   * }
   */
  public function store(StoreBand $request) {
    $user = Auth::user();
    $userID = $user->id;
    $userRole = $user->role;
    if ($userRole === "TALENT" || $userRole === "ADMIN") {
      try {
        $validated = $request->validated();
        $band = new Band;
        $band->fill($validated);
        $band->createdBy()->associate(Auth::id());
        if (isset($request['photo']) && $request['photo'] !== null) {
          $band->photo()->associate($validated['photo']['id']);
        }
        if (isset($request['header_photo']) && $request['header_photo'] !== null) {
          $band->headerPhoto()->associate($validated['header_photo']['id']);
        }
        if (isset($request['hospitality_and_production_rider']) && $request['hospitality_and_production_rider'] !== null) {
          $band->hospitalityAndProductionRider()->associate($validated['hospitality_and_production_rider']['id']);
        }
        $band->state()->associate($validated['state']['id']);
        $band->save();
        $stateIds = array_column($validated['willing_to_travel'], 'id');
        if (isset($request['genres'])) {
          $genreIds = array_column($validated['genres'], 'id');
          $band->genres()->attach($genreIds);
        }
        $gigIds = array_column($validated['preferred_gig_types'], 'id');
        $band->willingToTravel()->attach($stateIds);
        $band->preferredGigTypes()->attach($gigIds);
        if (isset($request['featured_songs'])) {
          $band->featuredSongs()->createMany($validated['featured_songs']);
        }
        if (isset($request['social_links'])) {
          $band->socialLinks()->createMany($validated['social_links']);
        }
        $user->phone_number = $request['phone_number'];
        $elasticIndex = $band->load('willingToTravel', 'genres');
        unset($elasticIndex['created_by']);
        $elasticIndex->addToIndex();
        $newBand = $band->load('createdBy', 'photo', 'headerPhoto', 'willingToTravel', 'genres', 'featuredSongs', 'socialLinks', 'preferredGigTypes', 'hospitalityAndProductionRider', 'state');
        if ($user->status !== "APPROVED") {
          $userPayment = Stripe::whereHas('users', function ($query) use ($userID) {
            $query->where('users.id', $userID);
          })->get();
          if (count($userPayment) > 0) {
            $user->status = 'PENDING';
          } else {
            $user->status = 'MISSING_PAYMENT';
            $newBand->status = 'MISSING_PAYMENT';
            $newBand->save();
          }
        }
        $user->save();
        return response()->formatted(200, "BAND_CREATED", "band", $newBand, "item");
      } catch (\Exception $e) {
        return response()->formatted(500, "ERROR", "band", Log::error($e), "");
      }
    } else {
      return response()->formatted(400, "UNAUTHORIZED", "band", "", "");
    }
  }
  /**
   * Display the specified resource.
   *
   * @param  \App\Band  $band
   * @return \Illuminate\Http\Response
   */
  public function show(Band $band) {
    $bandWithRelations = $band->load('createdBy', 'photo', 'headerPhoto', 'willingToTravel', 'genres', 'featuredSongs', 'socialLinks', 'preferredGigTypes', 'hospitalityAndProductionRider', 'state');
    return response()->formatted(200, "BAND_DETAILS", "band", $bandWithRelations, "item");
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Band  $band
   * @return \Illuminate\Http\Response
   */
  /**
   * @response {
   * "status": "SUCCESS",
   * "server_message": "BAND_UPDATED",
   * "user_message": "Your band has been updated."
   * }
   * @response 404 {
   * "message": "No query results for model [\App\User]"
   * }
   */
  public function update(StoreBand $request, Band $band) {
    $user = Auth::user();
    $userID = $user->id;
    $userRole = $user->role;
    $agentBandID = null;
    
    if($userRole == "AGENT")
    {
      $agentBandID = LinkAgentBand::where('agent_id', $userID)
      ->where('band_id', $band->id)
      ->select('id')->first();
    }
    if ($band->createdBy->id == $userID || $userRole === "ADMIN" || ($userRole === "AGENT" && $agentBandID != null)) {
      try {
        $validated = $request->validated();
        $oldFeatureSongIds = $band->featuredSongs()->pluck('id')->toArray();
        $oldSocialLinkIds = $band->socialLinks()->pluck('id')->toArray();
        $stateIds = array_column($validated['willing_to_travel'], 'id');
        $gigIds = array_column($validated['preferred_gig_types'], 'id');
        $band->willingToTravel()->sync($stateIds);
        $band->preferredGigTypes()->sync($gigIds);
        if (isset($request['featured_songs'])) {
          $featureSongIds = array_column($validated['featured_songs'], 'id');
          $this->updateOneToManyRelation($validated['featured_songs'], $band, 'featuredSongs');
        }
        if (isset($request['social_links'])) {
          $socialLinkIds = array_column($validated['social_links'], 'id');
          $this->updateOneToManyRelation($validated['social_links'], $band, 'socialLinks');
        }
        if (isset($request['photo']) && $request['photo'] !== null) {
          $band->photo()->associate($validated['photo']['id']);
        }
        if (isset($request['header_photo']) && $request['header_photo'] !== null) {
          $band->headerPhoto()->associate($validated['header_photo']['id']);
        }
        if (isset($request['hospitality_and_production_rider']) && $request['hospitality_and_production_rider'] !== null) {
          $band->hospitalityAndProductionRider()->associate($validated['hospitality_and_production_rider']['id']);
        }
        if (isset($request['genres'])) {
          $genreIds = array_column($validated['genres'], 'id');
          $band->genres()->sync($genreIds);
        }
        $band->state()->associate($validated['state']['id']);
        $band->update($validated);
        if ($userRole === "ADMIN") {
          $user = User::find($band->createdBy->id);
        }
        $user->phone_number = $request['phone_number'];
        if (isset($request['user_photo']) && $request['user_photo'] !== null) {
          $user->photo()->associate($request['user_photo']['id']);
        }
        $user->save();
        $elasticIndex = $band->load('willingToTravel', 'genres');
        unset($elasticIndex['created_by'], $elasticIndex['createdBy']);
        $elasticIndex->updateIndex();
        
        $newBand = $band->load('createdBy', 'photo', 'headerPhoto', 'willingToTravel', 'genres', 'featuredSongs', 'socialLinks', 'preferredGigTypes', 'hospitalityAndProductionRider', 'state');
        return response()->formatted(200, "BAND_UPDATED", "band", $newBand, "item");
      } catch (\Exception $e) {
        return response()->formatted(500, "ERROR", "band", $e->getMessage(), "");
      }
    } else {
      return response()->formatted(400, "UNAUTHORIZED", "band", "", "");
    }
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Band  $band
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request) {
    $id = is_numeric($request->route('band')) ? $request->route('band') : 0;
    $user = Auth::user();
    $bandExist = Band::where('id', $id)->WhereHas('createdBy', function ($query) use ($user) {
      $query->where('role', "ADMIN")->orWhere('created_by', $user->id);
    })->first();
    if ($bandExist !== null) {
      $bandreq = Band::findOrFail($id)->load('createdBy', 'photo', 'headerPhoto', 'willingToTravel', 'genres', 'featuredSongs', 'socialLinks', 'preferredGigTypes', 'hospitalityAndProductionRider', 'state');
      $bandExist->delete();
      $bandreq->removeFromIndex();
      return response()->formatted(200, "BAND_DELETED", "band", $bandreq, "item");
    } else {
      return response()->formatted(400, "UNAUTHORIZED", "band", "", "");
    }
  }
  /**
   * create, update and delete one to many relations.
   *
   * @param  Array  $newData
   * @param  Illuminate\Database\Eloquent\Model  $model
   * @param  String  $relationName
   * @return Boolean
   */
  private function updateOneToManyRelation($newData, $model, $relationName) {
    $oldDataIds = $model[$relationName]->pluck('id')->toArray();
    $newDataIds = array_column($newData, 'id');
    $dataToDelete = array_diff($oldDataIds, $newDataIds);
    foreach ($dataToDelete as $deleteId) {
      $model[$relationName]->find($deleteId)->delete();
    }
    foreach ($newData as $object) {
      if (isset($object['id'])) {
        $model[$relationName]->find($object['id'])->update($object);
      } else {
        $model->$relationName()->create($object);
      }
    }
    return true;
  }
  public function filter(Request $requestRaw) {
    $user = Auth::user();
    $userID = $user->id;
    $request = $requestRaw->input('filter');
    $band = Band::with('createdBy', 'genres', 'photo', 'headerPhoto', 'hospitalityAndProductionRider', 'state');
    if (isset($request['keyword'])) {
      $band->where(function ($query) use ($request) {
        $query->where('name', 'like', '%' . $request['keyword'] . '%')->orWhere('location', 'like', '%' . $request['keyword'] . '%');
      });
    }
    if (isset($request['genres'])) {
      $filtered = [];
      foreach ($request['genres'] as $genre) {
        $filtered[] = $genre["id"];
      }
      if (count($filtered)) {
        $band->whereHas('genres', function ($query) use ($filtered) {
          return $query->whereIn('id', $filtered);
        })->get();
      }
    }
    if (isset($request['price_from'])) {
      $band->where('price_from', '>=', $request['price_from']);
    }
    if (isset($request['price_to'])) {
      $band->where('price_to', '<=', $request['price_to']);
    }
    if (isset($request['date_from'])) {
      $band->whereDate('created_at', '>=', date("Y-m-d H:i:s", $request['date_from']));
    }
    if (isset($request['date_to'])) {
      $band->whereDate('created_at', '<=', date("Y-m-d H:i:s", $request['date_to']));
    }
    if (isset($request['size'])) {
      $band->where('size', $request['size']);
    }
    if (isset($request['location'])) {
      $band->where('location', $request['location']);
    }
    if ($requestRaw->input('items_per_page')) {
      $num = $requestRaw->input('items_per_page');
    } else {
      $num = 10;
    }
    $requestSort = $requestRaw->input(('sort'));
    if (isset($requestSort['by'])) {
      $by = $requestSort['by'];
      if ($by == "DATE") {
        $by = "CREATED_AT";
      } else if ($by == "PRICE") {
        $by = "PRICE_FROM";
      }
    } else {
      $by = "ID";
    }
    if (isset($requestSort['dir'])) {
      $dir = $requestSort['dir'];
    } else {
      $dir = "DESC";
    }
    try {
      $bands = $band->select('id', 'name', 'photo_id', 'header_photo_id', 'price_from', 'price_to', 'created_by', 'rating', 'size')->withCount(['favorite as isFavorite' => function (Builder $query) use ($userID) { //return "isFavorite" true if this band is marked as favorite for the user
        $query->where("user_id", $userID);
      },
      ])->orderBy($by, $dir)->paginate(abs($num));
      return response()->formatted(200, "BAND_DETAILS", "band", $bands, "items");
    } catch (\Exception $e) {
      return response()->formatted(500, "ERROR", "band", Log::error($e), "");
    }
  }
  public function list_my_bands(Request $requestRaw) {
    $request = $requestRaw->input('filter');
    $band = Band::with('genres', 'photo', 'headerPhoto', 'createdBy', 'preferredGigTypes', 'socialLinks', 'featuredSongs', 'willingToTravel', 'hospitalityAndProductionRider', 'state');
    $user = Auth::user();
    $userId = $user->id;
    if (isset($userId)) {
      $band->where('created_by', $userId);
    }
    if (isset($request['keyword'])) {
      $band->where(function ($query) use ($request) {
        $query->where('name', 'like', '%' . $request['keyword'] . '%')->orWhere('location', 'like', '%' . $request['keyword'] . '%');
      });
    }
    if (isset($request['genres'])) {
      $filtered = [];
      foreach ($request['genres'] as $genre) {
        $filtered[] = $genre["id"];
      }
      if (count($filtered)) {
        $band->whereHas('genres', function ($query) use ($filtered) {
          return $query->whereIn('id', $filtered);
        })->get();
      }
    }
    if (isset($request['price_from'])) {
      $band->where('price_from', '>=', $request['price_from']);
    }
    if (isset($request['price_to'])) {
      $band->where('price_to', '<=', $request['price_to']);
    }
    if (isset($request['date_from'])) {
      $band->whereDate('created_at', '>=', date("Y-m-d H:i:s", $request['date_from']));
    }
    if (isset($request['date_to'])) {
      $band->whereDate('created_at', '<=', date("Y-m-d H:i:s", $request['date_to']));
    }
    if (isset($request['size'])) {
      $band->where('size', $request['size']);
    }
    if (isset($request['location'])) {
      $band->where('location', $request['location']);
    }
    if ($requestRaw->input('items_per_page')) {
      $num = $requestRaw->input('items_per_page');
    } else {
      $num = 10;
    }
    $requestSort = $requestRaw->input(('sort'));
    if (isset($requestSort['by'])) {
      $by = $requestSort['by'];
      if ($by == "DATE") {
        $by = "CREATED_AT";
      } else if ($by == "PRICE") {
        $by = "PRICE_FROM";
      }
    } else {
      $by = "ID";
    }
    if (isset($requestSort['dir'])) {
      $dir = $requestSort['dir'];
    } else {
      $dir = "DESC";
    }
    try {
      $bands = $band->withCount(['favorite as isFavorite' => function (Builder $query) use ($userId) { //return "isFavorite" true if this band is marked as favorite for the user
        $query->where("user_id", $userId);
      },
      ])->orderBy($by, $dir)->paginate(abs($num));
      return response()->formatted(200, "BAND_DETAILS", "band", $bands, "items");
    } catch (\Exception $e) {
      return response()->formatted(500, "ERROR", "band", Log::error($e), "");
    }
  }
  /**
   * @response {
   * "status": "SUCCESS",
   * "server_message": "FAVORITE_ADDED",
   * "user_message": "Band added to favorite successfully."
   * }
   * @response 404 {
   * "message": "No query results for model [\App\User]"
   * }
   */
  public function favorite(Request $request) { //add band to favorite list
    $validator = Validator::make($request->all(), ['band' => 'required', 'band.id' => 'required']);
    if ($validator->fails()) {
      return response()->formatted(401, "INVALID", "band", $validator->errors(), "error");
    }
    $user = Auth::user();
    $userID = $user->id;
    $favoriteId = $request['band.id'];
    $band = Band::with('favorite')->where('id', $favoriteId)->whereHas('favorite', function ($query) use ($userID) {
      $query->where('users.id', $userID);
    })->first();
    if ($band == null) {
      try {
        $user->favorite()->attach($favoriteId);
        return response()->formatted(200, "FAVORITE_ADDED", "band", "", "");
      } catch (\Exception $e) {
        return response()->formatted(500, "FAVORITE_NOT_ADDED", "band", Log::error($e), "error");
      }
    } else {
      return response()->formatted(200, "FAVORITE_ALREADY_ADDED", "band", "", "");
    }
  }
  public function list_favorite(Request $request) {
    $user = Auth::user();
    $userID = $user->id;
    try {
      $favoriteBand = Band::whereHas('favorite', function ($query) use ($userID) {
        $query->where('users.id', $userID);
      })->get();
      return response()->formatted(200, "FAVORITE_BANDS_LIST", "band", $favoriteBand, "items");
    } catch (\Exception $e) {
      return response()->formatted(500, "ERROR", "band", Log::error($e), "");
    }
  }
  /**
   * @response {
   * "status": "SUCCESS",
   * "server_message": "FAVORITE_REMOVED",
   * "user_message": "Band removed from favorite successfully."
   * }
   * @response 404 {
   * "message": "No query results for model [\App\User]"
   * }
   */
  public function remove_favorite(Request $request) {
    $validator = Validator::make($request->all(), ['band' => 'required', 'band.id' => 'required']);
    if ($validator->fails()) {
      return response()->formatted(401, "INVALID", "band", $validator->errors(), "error");
    }
    $user = Auth::user();
    $favoriteId = $request['band.id'];
    try {
      $user->favorite()->detach($favoriteId);
      return response()->formatted(200, "FAVORITE_REMOVED", "band", "", "");
    } catch (\Exception $e) {
      return response()->formatted(500, "FAVORITE_NOT_REMOVED", "band", Log::error($e), "error");
    }
  }
  //ELASTIC SEARCH
  public function search(Request $request) {
    $validator = Validator::make($request->all(), ['sort.by' => 'sometimes|in:PRICE,RATING,SIZE', 'sort.dir' => 'sometimes|in:ASC,DESC', 'filter.size' => 'integer|min:1|nullable']);
    if ($validator->fails()) {
      return response()->formatted(400, "INVALID", "band", $validator->errors(), "error");
    }
    $user = Auth::user();
    if ($user == null) {
      $userID = null;
    } else {
      $userID = $user->id;
    }
    $text = $request['text'];
    $num = $request['items_per_page'];
    $requestSort = $request->input(('sort'));
    $requestFilter = $request->input(('filter'));
    $by = "RATING";
    if (isset($requestSort['by'])) {
      $by = $requestSort['by'];
    }
    $dir = "DESC";
    if (isset($requestSort['dir'])) {
      $dir = $requestSort['dir'];
    }
    if ($text !== null) {
      if (is_numeric($text)) {
        $bands = Band::searchByQuery(['multi_match' => ['type' => 'cross_fields', 'query' => $text, 'fields' => ['name', 'genres.title', 'preferred_gig_types.title', 'willing_to_travel.title', 'size'], 'lenient' => true, 'fuzzy_transpositions' => true]], null, 'id.*', 1000, null);
      } else {
        if (strlen($text) < 3) {
          $bandQuery = Band::where('name', 'like', '%' . $text . '%');
          if (strlen($text) == 2) {
            $bandQuery->orWhereHas('willingToTravel', function ($query) use ($text) {
              $query->where('states.title', 'like', '%' . $text . '%');
            });
          }
          $bands = $bandQuery->select('id')->get();
        } else {
          $bands = Band::searchByQuery(['query_string' => ['query' => '*' . $text . '*', 'fields' => ['name^4', 'genres.title^2', 'preferred_gig_types.title^1', 'willing_to_travel.title^3'], 'fuzziness' => '2', 'lenient' => true, 'fuzzy_transpositions' => true]], null, 'id.*', 1000, null);
        }
      }
      $bandsArr = $bands->toArray();
      $bandsIds = array_column($bandsArr, "id");
      $ids_ordered = implode(',', $bandsIds);
      $BandsResult = Band::with('genres', 'photo', 'headerPhoto', 'createdBy', 'preferredGigTypes', 'willingToTravel', 'request', 'hospitalityAndProductionRider', 'state', 'socialLinks', 'featuredSongs')
        ->whereNotIn('status', ['DECLINED', 'INACTIVE', 'PENDING_APPROVAL', 'MISSING_PROFILE', 'MISSING_PAYMENT'])
        ->whereIn('id', $bandsIds)->withCount(['favorite as isFavorite' => function (Builder $query) use ($userID) { //return "isFavorite" true if this band is marked as favorite for the user
        $query->where("user_id", $userID);
      },
      ])->orderByRaw("FIELD(id, $ids_ordered)"); //Order the bands by array order coming from elasticsearch. Order by Field only supported in SQL
    } else {
      $BandsResult = Band::with('genres', 'photo', 'headerPhoto', 'createdBy', 'preferredGigTypes', 'willingToTravel', 'request', 'hospitalityAndProductionRider', 'state', 'socialLinks', 'featuredSongs')->withCount(['favorite as isFavorite' => function (Builder $query) use ($userID) { //return "isFavorite" true if this band is marked as favorite for the user
        $query->where("user_id", $userID);
      },
      ])->whereNotIn('status', ['DECLINED', 'INACTIVE', 'PENDING_APPROVAL', 'MISSING_PROFILE', 'MISSING_PAYMENT']);
    }
    try {
      if (isset($requestFilter['size'])) {
        $BandsResult->where('size', '<=', $requestFilter['size']);
      }
      if (isset($requestFilter['price_from'])) {
        $BandsResult->where('price_from', '>=', $requestFilter['price_from']);
      }
      if (isset($requestFilter['price_to'])) {
        $BandsResult->where('price_to', '<=', $requestFilter['price_to']);
      }
      if (isset($requestFilter['genres'])) {
        $filtered = [];
        foreach ($requestFilter['genres'] as $genre) {
          $filtered[] = $genre["id"];
        }
        if (count($filtered)) {
          $BandsResult->whereHas('genres', function ($query) use ($filtered) {
            return $query->whereIn('id', $filtered);
          });
        }
      }
      if (isset($requestFilter['location'])) {
        $state = $requestFilter['location'];
        $stateID = $state['id'];
        $BandsResult->whereHas('willingToTravel', function ($query) use ($stateID) {
          return $query->where('id', $stateID);
        });
      }
      if (isset($requestFilter['favorite'])) {
        if ($requestFilter['favorite'] == true) {
          $BandsResult->whereHas('favorite', function ($query) use ($userID) {
            $query->where('users.id', $userID);
          });
        }
      }
      if ($by == 'PRICE' && $dir == 'DESC') {
        $by = 'PRICE_TO';
      } else if ($by == 'PRICE' && $dir == 'ASC') {
        $by = 'PRICE_FROM';
      }
      $Results = $BandsResult->orderBy('isFeatured', 'DESC')
        ->orderBy($by, $dir)->paginate(abs($num));
      return response()->formatted(200, "BAND_DETAILS", "band", $Results, "items");
    } catch (\Exception $e) {
      return response()->formatted(500, "ERROR", "band", Log::error($e), "");
    }
  }
  public function reIndex() {
    Band::createIndex($shards = null, $replicas = null);
    Band::reindex();
    $bands = Band::with('genres', 'preferredGigTypes', 'willingToTravel')->select('id', 'name', 'size', 'location')->get();
    foreach ($bands as $value) {
      $value->addToIndex();
    }
    return "indexed successfully";
  }

  public function price_list() {
    $maxPrice = Band::select('price_to')->max('price_to');
    $rangeArray = range(0, $maxPrice, 100);
    for ($i = 0; $i < 5; $i++) {
      if (isset($rangeArray[$i]) && isset($rangeArray[$i + 1])) {
        $new_array[] = array("price_from" => $rangeArray[$i], "price_to" => $rangeArray[$i + 1], "title" => '$' . $rangeArray[$i] . ' - ' . '$' . $rangeArray[$i + 1]);
      } else {
        break;
      }
    }
    $new_array[] = array("price_from" => $rangeArray[$i], "price_to" => null, "title" => '$' . $rangeArray[$i] . ' - More');
    return response()->formatted(200, "PRICE_LIST", "band", $new_array, "items");
  }

  public function add_featured(Request $request) {
    $validator = Validator::make($request->all(), ['band' => 'required', 'band.id' => 'required']);
    if ($validator->fails()) {
      return response()->formatted(401, "INVALID", "band", $validator->errors(), "error");
    }
    $user = Auth::user();
    $featuredId = $request['band.id'];
    $band = Band::where('id', $featuredId)->first();
    if ($band !== null) {
      if ($band->isFeatured == false) {
        try {
          $band->isFeatured = true;
          $band->save();
          return response()->formatted(200, "FEATURED_ADDED", "band", "", "");
        } catch (\Exception $e) {
          return response()->formatted(500, "NO_FEATURED_ADDED", "band", Log::error($e), "error");
        }
      } else {
        return response()->formatted(200, "ALREADY_FEATURED", "band", "", "");
      }
    } else {
      return response()->formatted(400, "NO_BANDS_FOUND", "band", "", "");
    }
  }

  public function remove_featured(Request $request) {
    $validator = Validator::make($request->all(), ['band' => 'required', 'band.id' => 'required']);
    if ($validator->fails()) {
      return response()->formatted(401, "INVALID", "band", $validator->errors(), "error");
    }
    $featuredId = $request['band.id'];
    $band = Band::where('id', $featuredId)->first();
    if ($band !== null) {
      if ($band->isFeatured == true) {
        try {
          $band->isFeatured = false;
          $band->save();
          return response()->formatted(200, "FEATURED_REMOVED", "band", "", "");
        } catch (\Exception $e) {
          return response()->formatted(500, "NO_FEATURED_REMOVED", "band", Log::error($e), "error");
        }
      } else {
        return response()->formatted(200, "ALREADY_NOT_FEATURED", "band", "", "");
      }
    } else {
      return response()->formatted(400, "NO_BANDS_FOUND", "band", "", "");
    }
  }

  public function list_featured(Request $request) {
    if ($request->input('items_per_page')) {
      $num = $request->input('items_per_page');
    } else {
      $num = 10;
    }
    $requestSort = $request->input(('sort'));
    if (isset($requestSort['by'])) {
      $by = $requestSort['by'];
    } else {
      $by = "RATING";
    }
    if (isset($requestSort['dir'])) {
      $dir = $requestSort['dir'];
    } else {
      $dir = "DESC";
    }
    try {
      $featuredBand = Band::with('genres', 'photo', 'headerPhoto', 'createdBy', 'preferredGigTypes', 'willingToTravel', 'request', 'hospitalityAndProductionRider', 'state', 'socialLinks', 'featuredSongs')
        ->where('isFeatured', true)->orderBy($by, $dir)->paginate(abs($num));
      return response()->formatted(200, "FEATURED_LIST", "band", $featuredBand, "items");
    } catch (\Exception $e) {
      return response()->formatted(500, "ERROR", "band", Log::error($e), "");
    }
  }

  public function listPendingBands(Request $request) {
    if (Auth::user()->role === "ADMIN") {
      $num = 10;
      if ($request->input('items_per_page')) {
        $num = $request->input('items_per_page');
      }
      $requestSort = $request->input(('sort'));
      $by = "ID";
      if (isset($requestSort['by'])) {
        $by = $requestSort['by'];
      }
      $dir = "DESC";
      if (isset($requestSort['dir'])) {
        $dir = $requestSort['dir'];
      }
      try {
        $bands = Band::with('createdBy', 'photo', 'headerPhoto', 'willingToTravel', 'genres', 'featuredSongs', 'socialLinks', 'preferredGigTypes', 'hospitalityAndProductionRider', 'state');
        if (isset($request['pending']) && $request['pending'] == true) {
          $bands->where('status', 'PENDING_APPROVAL');
        }
        $list = $bands->orderBy($by, $dir)->paginate(abs($num));
        return response()->formatted(200, "BAND_DETAILS", "band", $list, "items");
      } catch (\Exception $e) {
        return response()->formatted(500, "ERROR", "band", Log::error($e), "");
      }
    } else {
      return response()->formatted(400, "UNAUTHORIZED", "band", "", "");
    }
  }

  public function changeBandStatus(Request $request) {
    $id = is_numeric($request->route('band')) ? $request->route('band') : 0;
    $band = Band::with('createdBy', 'photo', 'headerPhoto', 'willingToTravel', 'genres', 'featuredSongs', 'socialLinks', 'preferredGigTypes', 'hospitalityAndProductionRider', 'state')
      ->where('id', $id)->first();
    $validator = Validator::make($request->all(), [
      'status' => 'required|in:approved,declined,inactive,active',
      'reason' => 'required_if:status,declined',
    ]);

    if ($validator->fails()) {
      return response()->formatted(400, "INVALID", "band", $validator->errors(), "error");
    }
    try {
      if ($user = Auth::user()->role === "ADMIN") {
        if ($band !== null && $band->status !== strtoupper($request['status'])) {
          $band->status = strtoupper($request['status']);
          $band->save();
          if ($band->status === 'APPROVED') {
            $user = User::where('id', $band->createdBy->id)->first();
            $user->status = 'APPROVED';
            $user->save();
            $talentPushToken = PushToken::where('created_by', $user->id)->pluck("push_token")->toArray();
            GetUserGeneralNotificationType($user, $user->email, null, "TALENT", $band, "APPROVAL", null, $talentPushToken, $band->id);
          } else if ($band->status === 'DECLINED') {
            $reason = $request['reason'];
            $rejection = [
              'band' => $band,
              'reason' => $reason,
            ];
            \Mail::to($band->createdBy->email)->send(new DeclineMail($rejection));
          }
          return response()->formatted(200, "STATUS_UPDATED", "band", $band, "item");
        } else {
          return response()->formatted(400, "STATUS_NOT_UPDATED", "band", "", "");
        }
      } else {
        return response()->formatted(400, "UNAUTHORIZED", "band", "", "");
      }
    } catch (\Exception $e) {
      return response()->formatted(500, "ERROR", "band", Log::error($e), "");
    }
  }
  public function bandWithFavorites(Request $request) {
    $id = is_numeric($request->route('band')) ? $request->route('band') : 0;
    $userID = Auth::user()->id;
    $bandWithfavorites = Band::with('createdBy', 'photo', 'headerPhoto', 'willingToTravel', 'genres', 'featuredSongs', 'socialLinks', 'preferredGigTypes', 'hospitalityAndProductionRider', 'state')
      ->where('id', $id)
      ->withCount(['favorite as isFavorite' => function (Builder $query) use ($userID) { //return "isFavorite" true if this band is marked as favorite for the user
        $query->where("user_id", $userID);
      },
      ])->first();
    return response()->formatted(200, "BAND_DETAILS", "band", $bandWithfavorites, "item");
  }

  // GET LIST OF LOGGED IN AGENT'S BAND LIST
  public function list_agent_bands(Request $request) {
    $userID = Auth::user()->id;
    try {
      $agentBand = LinkAgentBand::with('agentBand', 'agentBand.photo', 'createdBy') 
      ->where(function ($query) use ($userID) {
        $query->where('agent_id', $userID);
      })->where(function ($query) {
          $query->where('request_status', 'ACCEPTED_BY_AGENT')
                ->orWhere('request_status', 'ACCEPTED_BY_TALENT');
      })->get();
      return response()->formatted(200, "AGENT_BAND_LIST", "band", $agentBand, "items");
    } catch (\Exception $e) {
      return response()->formatted(500, "ERROR", "band", Log::error($e), "");
    }
  }
}
