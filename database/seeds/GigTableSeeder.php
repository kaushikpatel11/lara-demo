<?php

use Illuminate\Database\Seeder;

class GigTableSeeder extends Seeder
{
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run()
 {
  DB::table('gigs')->insert([
   [
    'title'      => "House Party",
    'created_at' => date("Y-m-d H:i:s"),
    'updated_at' => date("Y-m-d H:i:s"),
   ], [
    'title'      => "Theater",
    'created_at' => date("Y-m-d H:i:s"),
    'updated_at' => date("Y-m-d H:i:s"),
   ],
  ]);
 }
}
