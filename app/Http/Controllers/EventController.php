<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventHistory;
use App\RequestBand;
use App\Http\Requests\StoreEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Mail\EventDetailsUpdated;
use App\LinkAgentBand;
use App\Message;

use DB;
use Validator;
use App\User;

/**
 * @group  Events
 *
 */

class EventController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
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
   * "server_message": "EVENT_CREATED",
   * "user_message": "Your event has been created."
   * }
   * @response 404 {
   * "message": "No query results for model [\App\User]"
   * }
   */
  public function store(StoreEvent $request) {
    $userRole = Auth::user()->role;
    $userId = Auth::user()->id;
    $title = $request['title'];
    if ($userRole === "BOOKER" || $userRole === "ADMIN") {
      $existEvents = Event::where(['created_by'=> $userId, 'title' => $title])->first();
      if ($existEvents !== null) {
        return response()->formatted(400, "ALREADY_EXIST", "event", "", "");
      }
      $validated = $request->validated();
      $length = $request['desired_set_length'];
      $start = $request['start_time'];
      $date = $request['date'];
      $bandId = $request['band.id'];
      $start_total = date('Y-m-d H:i:s', strtotime($start, strtotime($date)));
      $end_total = date('Y-m-d H:i:s', strtotime($length . " minutes", strtotime($start_total)));
      $today = date("Y-m-d");
      $diff = abs(strtotime($today) - strtotime($date));
      //if ($diff / 60 / 60 / 24 < 10) {
      if ($diff / 60 / 60 / 24 < 3) {
        return response()->formatted(400, "LATE_EVENT", "event", "", "");
      }
      $event = new Event;
      $event->fill($validated);
      $event->createdBy()->associate(Auth::id());
      if ($request['photo'] && $request['photo'] !== null) {
        $event->photo()->associate($validated['photo']['id']);
      };
      if ($request['state'] && $request['state'] !== null) {
        $event->state()->associate($validated['state']['id']);
      };
      if ($request['event_type'] && $request['event_type'] !== null) {
        $event->eventType()->associate($validated['event_type']['id']);
      }
      $input = $request->all();
      $event->start_time = date('H:i:s', strtotime($start)); //retrieve date and assign the start time to it and store into start time.
      $event->end_time = date('H:i:s', strtotime($length . " minutes", strtotime($event->start_time))); // increment the start time with the desired length and store it in the end time
      $event->desired_set_length = $request['desired_set_length'];
      $event->save();
      $venueIds = array_column($validated['venue_description'], 'id');
      $event->venueDescription()->attach($venueIds);
      $newEvent = $event->load('createdBy', 'photo', 'state', 'eventType', 'venueDescription');
      UpdateHistory($newEvent->created_at, $newEvent->title . ' created.', null, null, $newEvent->id, Auth::id(), null, 'BOOKER');
      return response()->formatted(200, "EVENT_CREATED", "event", $newEvent, "item");
    } else {
      return response()->formatted(400, "UNAUTHORIZED", "event", "", "");
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Event  $event
   * @return \Illuminate\Http\Response
   */
  public function show(Event $event) {
    $eveentWithRelations = $event->load('createdBy', 'photo', 'state', 'eventType', 'venueDescription');
    return response()->formatted(200, "EVENT_LIST", "event", $eveentWithRelations, "item");

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Event  $event
   * @return \Illuminate\Http\Response
   */
  /**
   * @response {
   * "status": "SUCCESS",
   * "server_message": "EVENT_UPDATED",
   * "user_message": "Your event has been updated."
   * }
   * @response 404 {
   * "message": "No query results for model [\App\User]"
   * }
   */
  public function update(StoreEvent $request) {
    $id = is_numeric($request->route('event')) ? $request->route('event') : 0;
    $event = Event::with('createdBy', 'photo', 'state', 'eventType', 'venueDescription', 'request.createdBy')
      ->where('id', $id)->first();
    if ($event !== null && $event->createdBy->id === Auth::user()->id) {
      $length = $request['desired_set_length'];
      $start = $request['start_time'];
      $date = $request['date'];
      $start_total = date('Y-m-d H:i:s', strtotime($start, strtotime($date)));
      $end_total = date('Y-m-d H:i:s', strtotime($length . " minutes", strtotime($start_total)));
      $validated = $request->validated();
      $event->fill($validated);
      if (isset($request['photo'])) {
        $event->photo()->associate($validated['photo']['id']);
      };
      if (isset($request['state'])) {
        $event->state()->associate($validated['state']['id']);
      };
      if (isset($request['event_type'])) {
        $event->eventType()->associate($validated['event_type']['id']);
      };
      $event->start_time = date('H:i:s', strtotime($start)); //retrieve date and assign the start time to it and store into start time.
      $event->end_time = date('Y-m-d H:i:s', strtotime($length . " minutes", strtotime($event->start_time))); // increment the start time with the desired length and store it in the end time
      $event->desired_set_length = $request['desired_set_length'];
      $venueIds = array_column($validated['venue_description'], 'id');
      $event->venueDescription()->sync($venueIds);
      $event->update();
      $this->notifyUsers($id, $event);
      $listEvent = $event->load('createdBy', 'photo', 'state', 'eventType', 'venueDescription');
      return response()->formatted(200, "EVENT_UPDATED", "event", $listEvent, "item");
    } else {
      return response()->formatted(400, $event == null ? "NO_EVENTS_FOUND" : "UNAUTHORIZED", "event", "", "");
    }
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Event  $event
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request) {
    $id = is_numeric($request->route('event')) ? $request->route('event') : 0;
    $event = event::where('id', $id)->first();
    if ($event !== null && $event->createdBy->id === Auth::user()->id) {
      $eventreq = Event::findOrFail($event)->load('createdBy', 'photo', 'state', 'eventType', 'venueDescription');
      $event->delete();
      return response()->formatted(200, "EVENT_DELETED", "event", $event, "item");
    } else {
      return response()->formatted(400, $event == null ? "NO_EVENTS_FOUND" : "UNAUTHORIZED", "event", "", "");
    }
  }

  public function filter(Request $requestRaw) {
    $event = Event::with('createdBy', 'photo', 'state', 'eventType', 'venueDescription');
    $request = $requestRaw->input('filter');

    if (isset($request['keyword'])) {
      $event->where(function ($query) use ($request) {
        $query->where('title', 'like', '%' . $request['keyword'] . '%')
          ->orWhere('description', 'like', '%' . $request['keyword'] . '%');
      });
    }

    if (isset($request['date_from'])) {
      $event->whereDate('date', '>=', $request['date_from']);
    }
    if (isset($request['date_to'])) {
      $event->whereDate('date', '<=', $request['date_to']);
    }

    if (isset($request['location'])) {
      $event->where('location', 'like', '%' . $request['location'] . '%');
    }

    if ($requestRaw->input('items_per_page')) {
      $num = $requestRaw->input('items_per_page');
    } else {
      $num = 10;
    }

    $requestSort = $requestRaw->input(('sort'));
    if (isset($requestSort['by'])) {
      $by = $requestSort['by'];
      if ($by == "NAME") {
        $by = "TITLE";
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
      $events = $event->select('id', 'title', 'date', 'description', 'created_by', 'photo_id', 'location', 'start_time', 'end_time', 'state_id', 'event_type_id', 'number_of_attendees', 'desired_set_length', 'venueDescription')
        ->orderBy($by, $dir)
        ->paginate(abs($num));
      return response()->formatted(200, "EVENTS_LIST", "event", $events, 'items');
    } catch (\Exception $e) {
      return response()->formatted(500, "INVALID", "event", Log::error($e), "error");
    }
  }

  public function list_my_events(Request $requestRaw) {
    $user = Auth::user();
    $userId = $user->id;
    $event = Event::with('createdBy', 'photo', 'state', 'eventType', 'venueDescription');
    if (isset($requestRaw['text'])) {
      $event->where('title', 'like', '%' . $requestRaw['text'] . '%');
    }
    if ($requestRaw->input('items_per_page')) {
      $num = $requestRaw->input('items_per_page');
    } else {
      $num = 10;
    }
    $requestSort = $requestRaw->input(('sort'));
    if (isset($requestSort['by'])) {
      $by = $requestSort['by'];
      if ($by == "NAME") {
        $by = "TITLE";
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
      $events = $event->where('created_by', $userId)
        ->where('date', '>=', Carbon::now()->toDateString())
        ->orderBy($by, $dir)
        ->paginate(abs($num));
      return response()->formatted(200, "YOUR_EVENTS_LIST", "event", $events, 'items');
    } catch (\Exception $e) {
      return response()->formatted(500, "INVALID", "event", Log::error($e), "error");
    }
  }

  public function duplicate_event(Request $request) {
    $user = Auth::user();
    $event = Event::with('createdBy', 'photo', 'state', 'eventType', 'venueDescription')
      ->where('id', $request['event']['id'])
      ->where('created_by', $user->id)
      ->first();
    if ($event !== null) {
      try {
        $duplicateEvent = $event->replicate();
        $duplicateEvent->save();
        return response()->formatted(200, "EVENT_DUPLICATED", "event", $duplicateEvent, "item");
      } catch (\Exception $e) {
        return response()->formatted(500, "INVALID", "event", Log::error($e), "error");
      }
    } else {
      return response()->formatted(400, "NO_EVENTS_FOUND", "event", "", "");
    }
  }

  public function past_events(Request $requestRaw) {
    $user = Auth::user();
    $userId = $user->id;
    $event = Event::with('createdBy', 'photo', 'state', 'eventType', 'venueDescription');
    if (isset($requestRaw['text'])) {
      $event->where('title', 'like', '%' . $requestRaw['text'] . '%');
    }
    if ($requestRaw->input('items_per_page')) {
      $num = $requestRaw->input('items_per_page');
    } else {
      $num = 10;
    }
    $requestSort = $requestRaw->input(('sort'));
    $by = "DATE";
    if (isset($requestSort['by'])) {
      $by = $requestSort['by'];
      if ($by == "NAME") {
        $by = "TITLE";
      }
    }
    $dir = "DESC";
    if (isset($requestSort['dir'])) {
      $dir = $requestSort['dir'];
    }
    try {
      $events = $event->where('created_by', $userId)
        ->where('date', '<', Carbon::now()->toDateString())
        ->orderBy($by, $dir)
        ->paginate(abs($num));
      return response()->formatted(200, "YOUR_PAST_EVENTS_LIST", "event", $events, 'items');
    } catch (\Exception $e) {
      return response()->formatted(500, "INVALID", "event", Log::error($e), "error");
    }
  }

  public function listEventHistory(Request $request) {
    $eventId = is_numeric($request->route('event')) ? $request->route('event') : 0;
    $eventHistory = EventHistory::with('createdBy', 'request', 'event', 'request.band')
      ->Where('event_id', $eventId)
      ->orderBy('date', 'ASC')
      ->get();
    $userId = Auth::user()->id;
    if (!empty($eventHistory[0]) && ($eventHistory[0]->event->createdBy->id === $userId || $eventHistory[0]->request->band->createdBy->id === $userId)) {
      $actions = [];
      foreach ($eventHistory as $event) {
        switch ($event["value"]) {
        case 'ACCEPTED_BY_TALENT':
          $event["value"] = "accepted";
          break;
        case 'REJECTED_BY_TALENT':
          $event["value"] = "rejected";
          break;
        case 'CANCELED_BY_TALENT':
          $event["value"] = "canceled";
          break;
        case 'CANCELED_BY_BOOKER':
          $event["value"] = "cancelled by you.";
          break;
        case 'PENDING_DEPOSIT':
          $event["value"] = "is pending for deposit.";
          break;
        case 'PENDING_REMAINDER':
          $event["value"] = "is pending for remainder.";
          break;
        case 'PENDING_FULL_PAYMENT':
          $event["value"] = "is pending for full payment.";
          break;
        case 'DEPOSIT_PAID':
          $event["value"] = "deposit paid.";
          break;
        case 'REMAINDER_PAID':
          $event["value"] = "remainder paid.";
          break;
        case 'FULL_PAYMENT_PAID':
          $event["value"] = "full payment paid.";
          break;
        default:
          $event["value"] = $event["value"];
        }
        switch ($event["action"]) {
        case 'REQUEST_SENT':
          $event["action"] = $event['request']->band->name . " request sent.";
          break;
        case 'STATUS_UPDATED':
          $event["action"] = $event['request']->band->name . " request " . $event["value"];
          break;
        default:
          $event["action"] = $event["action"];
        }
        $actions[] = $event;
      }
      return response()->formatted(200, "EVENTS_HISTORY", "event", $actions, "items");
    } else {
      return response()->formatted(400, empty($eventHistory[0]) ? "NO_EVENTS_FOUND" : "UNAUTHORIZED", "event", "", "");

    }
  }

  public function listTalentEventHistory(Request $request) {
    $requestId = is_numeric($request->route('event')) ? $request->route('event') : 0;


    //CHECK IF AGENT USER THEN USE TALENTUSER ID. --- START ------
    $user = Auth::user();
    $userId = $user->id;
    $userRole = $user->role;

    if($userRole == "AGENT")
    {
      $talentUserId = null;
      $bandRequestData = RequestBand::with('event.photo', 'createdBy', 'band.createdBy', 'payments', 'band.photo')->where('id', $requestId)->find($requestId);
        $bandId = $bandRequestData->band->id;
        //var_dump($bandId);
      $agentBand = LinkAgentBand::with('agentBand')
      ->where('agent_id', $userId)
        ->where('band_id', $bandId)->get();

        foreach ($agentBand as $value) {
          $talentUserId = $value->agentBand->createdBy->id;
        }
        $user = User::whereNotNull('api_token')->where('id', $talentUserId)->first(); 
        $userRole = "TALENT";
        $userId = $user->id;
        //var_dump($user);
        //exit;
    }
    //CHECK IF AGENT USER THEN USE TALENTUSER ID. --- end ------


    $eventHistory = EventHistory::with('createdBy', 'request', 'event', 'request.band')
      ->Where('request_id', $requestId)
      ->orderBy('date', 'ASC')
      ->get();
   
    if (!empty($eventHistory[0]) && ($eventHistory[0]->event->createdBy->id === $userId || $eventHistory[0]->request->band->createdBy->id === $userId)) {
      $actions = [];
      foreach ($eventHistory as $event) {
        switch ($event["value"]) {
        case 'ACCEPTED_BY_TALENT':
          $event["value"] = "accepted";
          break;
        case 'REJECTED_BY_TALENT':
          $event["value"] = "rejected";
          break;
        case 'CANCELED_BY_TALENT':
          $event["value"] = "canceled";
          break;
        case 'CANCELED_BY_BOOKER':
          $event["value"] = "are canceled by Booker for";
          break;
        case 'PENDING_DEPOSIT':
          $event["value"] = "are pending for deposit for ";
          break;
        case 'PENDING_REMAINDER':
          $event["value"] = "are pending for remainder for ";
          break;
        case 'PENDING_FULL_PAYMENT':
          $event["value"] = "are pending for full payment for ";
          break;
        case 'DEPOSIT_PAID':
          $event["value"] = "received the deposit amount for ";
          break;
        case 'REMAINDER_PAID':
          $event["value"] = "received the remainder amount for ";
          break;
        case 'FULL_PAYMENT_PAID':
          $event["value"] = "received the full payment amount for ";
          break;
        default:
          $event["value"] = $event["value"];
        }
        switch ($event["action"]) {
        case 'REQUEST_SENT':
          $event["action"] = $event['createdBy']->fname . " " . $event['createdBy']->lname . " sent you a booking request.";
          break;
        case 'STATUS_UPDATED':
          $event["action"] = "You " . $event['value'] . " the " . $event['createdBy']->fname . " " . $event['createdBy']->lname . "'s booking request.";
          break;
        default:
          $event["action"] = $event["action"];
        }
        $actions[] = $event;

      }
      return response()->formatted(200, "EVENTS_HISTORY", "event", $actions, "items");
    } else {
      return response()->formatted(400, empty($eventHistory[0]) ? "NO_EVENTS_FOUND" : "UNAUTHORIZED", "event", "", "");
    }
  }

  public function notifyUsers($eventId, $event) {
    $requests = RequestBand::with('band.createdBy')
      ->whereHas('event', function ($query) use ($eventId) {
        $query->where('id', $eventId);
      })->whereNotIn('status', ['REJECTED_BY_TALENT', 'CANCELED_BY_TALENT', 'CANCELED_BY_BOOKER'])->get();
    $talentEmails = $requests->pluck("band.createdBy.email")->toArray();
    $distinctEmails = array_unique($talentEmails);
    \Mail::to($distinctEmails)->send(new EventDetailsUpdated($event));
  }

  //for calender
  public function request_widget_list(Request $request){
    $user = Auth::user();
    $userId = $user->id;   
    $userRole = $user->role; 
    if($userRole == "AGENT"){  

      $agentBandList=LinkAgentBand::select('band_id')->where(function($q){
        $q->where('request_status','ACCEPTED_BY_AGENT');
        $q->orwhere('request_status','ACCEPTED_BY_TALENT');
      })
      ->where('agent_id',$userId)
      ->groupby('band_id')
      ->get()->pluck('band_id');


      $event_status_array=array();
      $return_total_budget=0;
      $return_total_count=0;
      $return_array=array();
      

      if(!$agentBandList->isEmpty()){

            $all_events = DB::table('request_bands')
              ->select('status',DB::raw('
                count(*) as total,
                sum(production_budget)+sum(talent_budget) as total_budget'                 
                ))
              ->wherein('band_id',$agentBandList)
              ->groupBy('status')                
              ->get();       


        if(!$all_events->isEmpty()):
          $total_cancel_budget=0;                   
          $key_wise=array();
          $all_events_modified=array();

          foreach($all_events as $all_event){
            $key_wise[$all_event->status]=$all_event;
          }                 
          
          $all_events_modified=generate_array_for_request_widget_agent($key_wise);                         

            foreach($all_events_modified as $all_event){             
              
              $temp=array(
                'status'=>$all_event->status,
                'count'=>$all_event->total,
                'budget_display'=>currency_abbreviation_convert($all_event->total_budget),
                'budget'=>$all_event->total_budget
              );       
              
              if($all_event->status != "CANCELED_BY_BOOKER" &&  $all_event->status != "CANCELED_BY_TALENT"){
                  $return_total_count=$return_total_count+$all_event->total;              
                  $return_total_budget=$return_total_budget+$all_event->total_budget;    
              }              

              switch ($all_event->status) {
                case "OPEN":
                  $temp['display_staus']='Requested';
                  break;
                case "ACCEPTED_BY_TALENT":              
                  $temp['display_staus']='Pending Contract';
                  break;

                case "PENDING_DEPOSIT" :                  
                case "PENDING_REMAINDER":              
                  $temp['display_staus']='Pending Deposit';
                  break;

                case "APPROVED":              
                  $temp['display_staus']='Paid in Full';
                  break;
                case "COMPLETED":              
                  $temp['display_staus']='Completed';
                  break;

                case "REJECTED_BY_TALENT":              
                  $temp['display_staus']='Rejected';
                  break;

                case "CANCELED_BY_BOOKER":         
                  $temp['display_staus']='Canceled by Booker';
                  break;

                case "CANCELED_BY_TALENT":              
                  $temp['display_staus']='Canceled by Band';
                  break;

                case "PENDING_FULL_PAYMENT":              
                  $temp['display_staus']='Pending Remainder';
                  break;                                        
              } 
              $event_status_array[]=$temp;
            }      
            
            $return_array['list']=$event_status_array;
            $return_array['total_budget']=currency_abbreviation_convert($return_total_budget);
            $return_array['total_request']=currency_abbreviation_convert($return_total_count);
            
            return response()->formatted(200, '', "event", $return_array, "items");

          else: //when band have no any events
            

            $key_wise=generate_array_for_request_widget_agent([],true); 
        
            foreach($key_wise as $all_event){             
                  
              $temp=array(
                'status'=>$all_event->status,
                'count'=>$all_event->total,
                'budget_display'=>currency_abbreviation_convert($all_event->total_budget),
                'budget'=>$all_event->total_budget
              );       
              
              if($all_event->status != "CANCELED_BY_BOOKER" &&  $all_event->status != "CANCELED_BY_TALENT"){
                  $return_total_count=$return_total_count+$all_event->total;              
                  $return_total_budget=$return_total_budget+$all_event->total_budget;    
              }              
    
              switch ($all_event->status) {
                case "OPEN":
                  $temp['display_staus']='Requested';
                  break;
                case "ACCEPTED_BY_TALENT":              
                  $temp['display_staus']='Pending Contract';
                  break;
    
                case "PENDING_DEPOSIT" :                  
                case "PENDING_REMAINDER":              
                  $temp['display_staus']='Pending Deposit';
                  break;
    
                case "APPROVED":              
                  $temp['display_staus']='Paid in Full';
                  break;
                case "COMPLETED":              
                  $temp['display_staus']='Completed';
                  break;
    
                case "REJECTED_BY_TALENT":              
                  $temp['display_staus']='Rejected';
                  break;
    
                case "CANCELED_BY_BOOKER":         
                  $temp['display_staus']='Canceled by Booker';
                  break;
    
                case "CANCELED_BY_TALENT":              
                  $temp['display_staus']='Canceled by Band';
                  break;
    
                case "PENDING_FULL_PAYMENT":              
                  $temp['display_staus']='Pending Remainder';
                  break;                                        
              } 
              $event_status_array[]=$temp;
            } 
    
    
            $return_array['list']=$event_status_array;
            $return_array['total_budget']=currency_abbreviation_convert(0);
            $return_array['total_request']=currency_abbreviation_convert(0);
            return response()->formatted(200,'', "event", $return_array, "items");


            
      endif;


      }else{

          

        $key_wise=generate_array_for_request_widget_agent([],true); 
        
        foreach($key_wise as $all_event){             
              
          $temp=array(
            'status'=>$all_event->status,
            'count'=>$all_event->total,
            'budget_display'=>currency_abbreviation_convert($all_event->total_budget),
            'budget'=>$all_event->total_budget
          );       
          
          if($all_event->status != "CANCELED_BY_BOOKER" &&  $all_event->status != "CANCELED_BY_TALENT"){
              $return_total_count=$return_total_count+$all_event->total;              
              $return_total_budget=$return_total_budget+$all_event->total_budget;    
          }              

          switch ($all_event->status) {
            case "OPEN":
              $temp['display_staus']='Requested';
              break;
            case "ACCEPTED_BY_TALENT":              
              $temp['display_staus']='Pending Contract';
              break;

            case "PENDING_DEPOSIT" :                  
            case "PENDING_REMAINDER":              
              $temp['display_staus']='Pending Deposit';
              break;

            case "APPROVED":              
              $temp['display_staus']='Paid in Full';
              break;
            case "COMPLETED":              
              $temp['display_staus']='Completed';
              break;

            case "REJECTED_BY_TALENT":              
              $temp['display_staus']='Rejected';
              break;

            case "CANCELED_BY_BOOKER":         
              $temp['display_staus']='Canceled by Booker';
              break;

            case "CANCELED_BY_TALENT":              
              $temp['display_staus']='Canceled by Band';
              break;

            case "PENDING_FULL_PAYMENT":              
              $temp['display_staus']='Pending Remainder';
              break;                                        
          } 
          $event_status_array[]=$temp;
        } 


        $return_array['list']=$event_status_array;
        $return_array['total_budget']=currency_abbreviation_convert(0);
        $return_array['total_request']=currency_abbreviation_convert(0);
        return response()->formatted(200,'', "event", $return_array, "items");
         
      } 
    
    }else{
      return response()->formatted(400, 'UNAUTHORIZED', "event", [], "items");
    }    
  }

  public function request_widget_event_list(Request $request){
    $user = Auth::user();
    $userId = $user->id;
    $userRole = $user->role; 
    if($userRole == "AGENT"){  
       $request_status[]=$request->route('request_status');     

      $agentBandList=LinkAgentBand::select('band_id')->where(function($q){
        $q->where('request_status','ACCEPTED_BY_AGENT');
        $q->orwhere('request_status','ACCEPTED_BY_TALENT');
      })
      ->where('agent_id',$userId)
      ->groupby('band_id')
      ->get()->pluck('band_id');           

      if(!$agentBandList->isEmpty()){

        if($request->route('request_status') == 'PENDING_DEPOSIT'){
          $request_status[]='PENDING_REMAINDER';
        }       
        
       $band_and_event=RequestBand::with('event','band')
        ->wherein('band_id',$agentBandList)
        ->wherein('status',$request_status)
        ->get();                      

        return response()->formatted(200, 'EVENT_LIST', "event",$band_and_event, "items");
      }               
        return response()->formatted(200, 'EVENT_LIST', "event",[], "items");
    }else{
        return response()->formatted(400, 'UNAUTHORIZED', "event", [], "items");
    }
  }

  public function request_widget_band_request_list(Request $request){
    $user = Auth::user();
    $userId = $user->id;
    $userRole = $user->role; 
    $return_array=array();

    if($userRole =='AGENT'){

      if ($request->input('items_per_page')) {
        $num = $request->input('items_per_page');
      } else {
        $num = 10;
      }

        $agentBandList=LinkAgentBand::with('agentBand')              
        ->where(function($q){
          $q->where('request_status','ACCEPTED_BY_AGENT');
          $q->ORwhere('request_status','ACCEPTED_BY_TALENT');          
        })     
        ->where('agent_id',$userId)        
        ->get()->pluck('band_id');

      if(!$agentBandList->isEmpty()){
        $return_array=RequestBand::with('event','band','band.photo','band.createdBy','event.createdBy')
        ->whereIn('band_id',$agentBandList)
        ->where(function($q){
          $q->where("status","OPEN");
        })->orderBy('id','DESC')
        ->paginate($num)->all();        

        $return_array=collect($return_array);
          $return_array->map(function($array){
            return $array->agent_last_seen_request = strtotime($array->agent_last_seen_request);          
          });

          $all_request_band_id_comma='';
          foreach($agentBandList as $single_band_id){
            $all_request_band_id_comma=$all_request_band_id_comma.''.$single_band_id.',';
          }
          $all_request_b_id_comma = rtrim($all_request_band_id_comma, ", ");        

          //get count of request latest request
          $all_events_total_messages=DB::select("SELECT count(1) as total_request 
              FROM `request_bands`         
            WHERE band_id IN($all_request_b_id_comma) 
              AND created_at >= agent_last_seen_request AND status='OPEN'  "); 

            $return_array=array(
              'total_request'=>$all_events_total_messages[0]->total_request,
              'data' =>$return_array
            );

          return response()->formatted(200, 'AGENT_REQUEST_LIST', "event",$return_array, "items");
      }
      return response()->formatted(200, 'AGENT_REQUEST_LIST', "event",[], "items");

    }else{
      return response()->formatted(400, 'UNAUTHORIZED', "event",[], "items");
    }
  }

  public function widget_band_status_update_list(Request $request){
    $user = Auth::user();
    $userId = $user->id;
    $userRole = $user->role;   

    if($userRole =='AGENT'){

      if ($request->input('items_per_page')) {
        $num = $request->input('items_per_page');
      } else {
          $num = 10;
      }

      $agentBandList=LinkAgentBand::with('agentBand')              
      ->where(function($q){
        $q->where('request_status','ACCEPTED_BY_AGENT');
        $q->Orwhere('request_status','ACCEPTED_BY_TALENT');
      })   
        ->where('agent_id',$userId)
        ->get()->pluck('band_id');

        $return_array=array();
        $return=[
          'total_new_request' => 0,
          'data' => []  
        ];
        if(!$agentBandList->isEmpty()){
          $return_array=RequestBand::select('agent_last_seen_request','previous_status','status','previous_status_time','id','event_id','band_id')->with('event:title,date,start_time,created_by,id','band:id,name,photo_id,created_by','band.photo','band.createdBy','event.createdBy')
          ->whereIn('band_id',$agentBandList)
          ->where('status','<>','OPEN')          
          ->orderBy('previous_status_time','DESC')          
          ->paginate($num)->all(); 


          $return_array=collect($return_array)->map(function($array){
             $array->previous_status_time=strtotime($array->previous_status_time);
             $array->agent_last_seen_request=strtotime($array->agent_last_seen_request);
            return $array;
          });


          $all_request_band_id_comma='';
          foreach($agentBandList as $single_band_id){
            $all_request_band_id_comma=$all_request_band_id_comma.''.$single_band_id.',';
          }
          $all_request_b_id_comma = rtrim($all_request_band_id_comma, ", ");


         $total_q="select COUNT(1) AS total_new_request from `request_bands` where `band_id` in ($all_request_b_id_comma) and `previous_status_time` > agent_last_seen_request limit 1";      
         $total_new_request=DB::select($total_q);

          // $total_new_request=RequestBand::select(DB::raw('COUNT(1) AS total_new_request'))
          // ->whereIn('band_id1',$agentBandList)                    
          // ->where("previous_status_time" ,'>', 'agent_last_seen_request')          
          // ->first();  
          // die;

          $return=[
            'total_new_request' => $total_new_request[0]->total_new_request,
            'data' => $return_array  
          ];

        }      

      return response()->formatted(200, 'AGENT_REQUEST_LIST', "event",$return, "items");
    }else{
      return response()->formatted(400, 'UNAUTHORIZED', "event",[], "items");
    }   
  }

  public function widget_messages_list(Request $request){    
    
    $user = Auth::user();
    $userId = $user->id;
    $userRole = $user->role;       
    $return_array=array();
    $return_final=array();
    if($userRole =='AGENT'){

      if ($request->input('items_per_page')) {
        $num = $request->input('items_per_page');
      } else {
          $num = 10;
      }

      if($request->input('page')) {
        $page = $request->input('page');                
        if($page!=0){
          $page=($page*$num);
        }
      } else {
        $page = 0;
      }                    

      $agent_bands=LinkAgentBand::
      where('agent_id',$userId)
      ->where(function($q){
        $q->where('request_status','ACCEPTED_BY_AGENT');
        $q->Orwhere('request_status','ACCEPTED_BY_TALENT');
      })
      ->get()
      ->pluck('band_id');      
      
      

      if(!$agent_bands->isEmpty()){
        $all_request_id=RequestBand::whereIn('band_id',$agent_bands)->get()->pluck('id');   //get agent bands       

        if(!$all_request_id->isEmpty()){            
            $all_request_id_comma='';
            foreach($all_request_id as $single_id){
              $all_request_id_comma=$all_request_id_comma.''.$single_id.',';
            }
            $all_request_id_comma = rtrim($all_request_id_comma, ", ");

            $message_data=DB::select("SELECT created_by,created_at,message_text,event_request_id 
            FROM `messages`WHERE event_request_id IN($all_request_id_comma) AND id IN(SELECT max(`id`) FROM `messages` GROUP BY `event_request_id`)
            ORDER BY `id` DESC LIMIT $page,$num "); //get last agent chat's using band request's id        

            //
            // $all_events_total_messages=DB::select("SELECT count(1) as total_message 
            //   FROM `messages` 
            //   join request_bands on request_bands.id=messages.event_request_id
            
            // WHERE messages.event_request_id IN($all_request_id_comma) where  total_message.created_at > request_bands.agent_last_seen "); 

            $total_unread_messages=0;
            if(count($message_data)>0){

                  foreach($message_data as $messages){                
                    $chat_list=RequestBand::
                    //select('id','created_by','event_id','band_id')
                    with('event:id,title,created_by','band:id,name,photo_id,created_by','band.photo','band.createdBy','event.createdBy')
                    ->where('id',$messages->event_request_id)  
                    ->whereIn('band_id',$agent_bands)      
                    ->first();  

                      if($chat_list){
                        $temp=[];
                        
                          $temp['message_text']=$messages->message_text;
                          $temp['message_time']=strtotime($messages->created_at);
                          $temp['data']=$chat_list;                 

                          if(($messages->created_by != $userId) && strtotime($messages->created_at) > $chat_list['agent_last_seen']){ //check message is unread or not
                          $temp['is_unread_message']=true;  
                          $total_unread_messages++;                
                        }else{
                          $temp['is_unread_message']=false;
                        }            
                        $return_array[]=$temp;
                    }            
                  }        
            }

            $return_final['messages']=$return_array;
            $return_final['total_unread_message']=$total_unread_messages;
            return response()->formatted(200, 'AGENT_REQUEST_LIST', "event",$return_final, "items");

      }else{
        return response()->formatted(200, 'AGENT_REQUEST_LIST', "event",[], "items");
      }    

    }

      return response()->formatted(200, 'AGENT_REQUEST_LIST', "event",[], "items");
    }else{
      return response()->formatted(400, 'UNAUTHORIZED', "event",[], "items");
    }
    
  }
}