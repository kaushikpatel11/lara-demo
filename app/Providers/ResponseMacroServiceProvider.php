<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider {
  /**
   * Register services.
   *
   * @return void
   */
  public function register() {
    //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot() {
    /**
     * Formating response json.
     *
     * @param Integer $code
     * @param String $serverMessage
     * @param String $localizationLocation
     * @param \Illuminate\Pagination\LengthAwarePaginator|Array|Object $items //Paging element NOT SimplePaging element
     * @param String|NULL $label //Mandatory in case of $items wasn't paging Object
     * @return Response
     */
    Response::macro('formatted', function ($code, $serverMessage, $localizationLocation, $items, $label = null) {
      if ($code >= 200 && $code < 300) {
        $status = "SUCCESS";
      } else {
        $status = "ERROR";
      }
      $userMessage = __($localizationLocation . "." . $serverMessage);
      if ($userMessage == ($localizationLocation . "." . $serverMessage)) {
        $userMessage = $localizationLocation;
      }
      $response = [
        "status" => $status,
        "server_message" => $serverMessage,
        "user_message" => $userMessage,
      ];
      if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator) {
        $response["page"] = $items->currentPage();
        $response["items_per_page"] = $items->perPage();
        $response["total_items"] = $items->total();
        $response["items"] = $items->items();
      } elseif (isset($label)) {
        $response[$label] = $items;
      } else {
        abort(500, "Please provide either FULL paging instant (not simple paging instant) in 'items' or anything else but with LABEL");
      }
      return Response::json($response, $code);
    });
  }
}
