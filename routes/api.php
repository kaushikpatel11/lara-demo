<?php

// header("Access-Control-Allow-Origin: " . env('ALLOW_ORIGIN'));
header('Access-Control-Allow-Origin: *');

header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, token, Origin, Push-Token");

use Illuminate\Http\Request;
use App\Band;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */




Route::group(['middleware' => ['auth:api', 'log:api']], function () {
  // ->middleware(['middleware' =>'permission'])

  //Dashboard api
  Route::prefix('/calender')->group(function(){
    Route::get('/request_widget_list', 'EventController@request_widget_list');
    Route::get('/request_widget_event_list/{request_status}', 'EventController@request_widget_event_list');
    Route::get('/request_widget_band_request_list', 'EventController@request_widget_band_request_list');
    Route::get('/widget_band_status_update_list', 'EventController@widget_band_status_update_list');
    Route::get('/widget_messages_list', 'EventController@widget_messages_list');
    
  });


  //bands api
  Route::post('/bands/list', 'BandController@filter');
  Route::post('/my-bands/list', 'BandController@list_my_bands');
  Route::post('/agent-bands/list', 'BandController@list_agent_bands');
  Route::post('/pending-bands/list', 'BandController@listPendingBands');
  Route::post('/band/update-status/{band}', 'BandController@changeBandStatus');
  Route::get('band-favorite/{band}', 'BandController@bandWithFavorites');
  Route::resource('/bands', 'BandController')->except(['index', 'create', 'edit']);
  //event api
  Route::post('/events/list', 'EventController@filter');
  Route::post('/my-events/list', 'EventController@list_my_events');
  Route::post('/events/duplicate', 'EventController@duplicate_event');
  Route::post('/past-events/list', 'EventController@past_events');
  Route::post('/event/history/{event}', 'EventController@listEventHistory');
  Route::post('/talent-event/history/{event}', 'EventController@listTalentEventHistory');
  Route::resource('/events', 'EventController')->except(['index', 'create', 'edit']);
  //media upload api
  Route::post('/media/upload', 'UploadController@uploadImage');
  Route::post('/media/upload-file', 'UploadController@uploadFile');
  Route::post('/media/upload-product-file', 'UploadController@uploadProductFile');
  

});


});
//UN-AUTH API
