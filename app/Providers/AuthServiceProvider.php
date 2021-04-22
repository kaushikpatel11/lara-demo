<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
 /**
  * The policy mappings for the application.
  *
  * @var array
  */
 protected $policies = [
  // 'App\Model' => 'App\Policies\ModelPolicy',
 ];

 /**
  * Register any authentication / authorization services.
  *
  * @return void
  */
 public function boot()
 {
  $this->registerPolicies();

  Auth::viaRequest('token', function ($request) {
   return User::whereNotNull('api_token')->where('api_token', $request->header('token'))->first();
  });

 }
}
