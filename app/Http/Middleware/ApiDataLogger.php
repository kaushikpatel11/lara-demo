<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Closure;

class ApiDataLogger {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    return $next($request);
  }

  public function terminate($request, $response) {
    if (env('API_DATALOGGER', true)) { //checks if API_DATALOGGER is true in .env file
      $endTime = microtime(true); // get the response end time in order to get the duration
      $headers = serialize($request->headers->all()); // get all the headers and serialize them to be aple to insert to database column
      $device = $request->header('Device-type');
      $appVersion = $request->header('App-version');
      $apiVersion = $request->header('Api-version');
      DB::table('loggers')->insert([ //insert the below data into loggers table in the database
        ['time' => gmdate("F j, Y, g:i a"),
          'duration' => number_format($endTime - LARAVEL_START, 3),
          'ip_address' => $request->ip(),
          'url' => $request->fullUrl(),
          'method' => $request->method(),
          'input' => $request->getContent(),
          'output' => $response->getContent(),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
          'headers' => $headers,
          'device_type' => $device,
          'app_version' => $appVersion,
          'api_version' => $apiVersion,
        ],
      ]);

    }
  }
}
