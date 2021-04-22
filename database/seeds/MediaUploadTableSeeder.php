<?php

use Illuminate\Database\Seeder;

class MediaUploadTableSeeder extends Seeder
{
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run()
 {
  DB::table('media_uploads')->insert([
   [
    'url'        => "https://s3.us-east-2.amazonaws.com/fyb-dev/II2A8wICypVEe9d02zIdDrxHTMozR7LSOMkfmCOu.jpeg",
    'server'     => 2,
    'created_at' => date("Y-m-d H:i:s"),
    'updated_at' => date("Y-m-d H:i:s"),
    'created_by'=> 1,
   ], [
    'url'        => "https://s3.us-east-2.amazonaws.com/fyb-dev/0BAxAcB4H9TKPWHgnb9Vz9RJqupG1J3YCSDfd2p8.jpeg",
    'server'     => 2,
    'created_at' => date("Y-m-d H:i:s"),
    'updated_at' => date("Y-m-d H:i:s"),
    'created_by'=> 1,
   ],
  ]);
 }
}
