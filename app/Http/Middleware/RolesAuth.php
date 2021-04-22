<?php

namespace App\Http\Middleware;
use App\Role;
use App\Permission;
use Closure;

class RolesAuth {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) { //get role id
    $roleID = auth()->user()->role_id;
    // get requested action
    // $actionName = class_basename($request->route()->getActionname());
    // explode action to retrieve method and controller from it
    $explode = explode('@', class_basename($request->route()->getActionname()));
    $method = end($explode);
    $controller = "App\Http\Controllers\\" . $explode[0];
    //query permission table to check if requested action is permitted or not
    $find = Permission::where("controller", $controller)
      ->where("method", $method)
      ->whereHas('roles', function ($query) use ($roleID) {
        $query->where('role_id', $roleID);
      })->first();
    if ($find !== null) {
      return $next($request);
    }
    return response('Unauthorized Action', 403);
  }
}