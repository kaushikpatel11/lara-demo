<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run()
 {
  DB::table('users')->insert([
   [
    'fname'             => Str::random(10),
    'lname'             => Str::random(10),
    'status'            => 'ACTIVE',
    'role'              => 'TALENT',
    'email'             => 'test1@tescsssddxt.com',
    'password'          => bcrypt('secret'),
    'verified'          => 1,
    'email_verified_at' => date("Y-m-d H:i:s"),
    'created_at'        => date("Y-m-d H:i:s"),
    'updated_at'        => date("Y-m-d H:i:s"),
   ], [
    'fname'             => Str::random(10),
    'lname'             => Str::random(10),
    'status'            => 'ACTIVE',
    'role'              => 'BOOKER',
    'email'             => 'test2@tefffxxst.com',
    'password'          => bcrypt('secret'),
    'verified'          => 1,
    'email_verified_at' => date("Y-m-d H:i:s"),
    'created_at'        => date("Y-m-d H:i:s"),
    'updated_at'        => date("Y-m-d H:i:s"),
   ],
  ]);
 }
}
