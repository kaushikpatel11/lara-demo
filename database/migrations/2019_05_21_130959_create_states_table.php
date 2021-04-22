<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('states', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title', 30)->unique();
      $table->timestamps();
    });
    DB::table('states')->insert(
      array(
        array(
          'title' => 'Alabama',
        ),
        array(
          'title' => 'Alaska',
        ),
        array(
          'title' => 'Arizona',
        ),
        array(
          'title' => 'Arkansas',
        ),
        array(
          'title' => 'California',
        ),
        array(
          'title' => 'Colorado',
        ),
        array(
          'title' => 'Connecticut',
        ),
        array(
          'title' => 'Delaware',
        ),
        array(
          'title' => 'Florida',
        ),
        array(
          'title' => 'Georgia',
        ),
        array(
          'title' => 'Hawaii',
        ),
        array(
          'title' => 'Idaho',
        ),
        array(
          'title' => 'Illinois',
        ),
        array(
          'title' => 'Indiana',
        ),
        array(
          'title' => 'Iowa',
        ),
        array(
          'title' => 'Kansas',
        ),
        array(
          'title' => 'Kentucky',
        ),
        array(
          'title' => 'Louisiana',
        ),
        array(
          'title' => 'Maine',
        ),
        array(
          'title' => 'Maryland',
        ),
        array(
          'title' => 'Massachusetts',
        ),
        array(
          'title' => 'Michigan',
        ),
        array(
          'title' => 'Minnesota',
        ),
        array(
          'title' => 'Mississippi',
        ),
        array(
          'title' => 'Missouri',
        ),
        array(
          'title' => 'Montana',
        ),
        array(
          'title' => 'Nebraska',
        ),
        array(
          'title' => 'Nevada',
        ),
        array(
          'title' => 'New Hampshire',
        ),
        array(
          'title' => 'New Jersey',
        ),
        array(
          'title' => 'New Mexico',
        ),
        array(
          'title' => 'New York',
        ),
        array(
          'title' => 'North Carolina',
        ),
        array(
          'title' => 'North Dakota',
        ),
        array(
          'title' => 'Ohio',
        ),
        array(
          'title' => 'Oklahoma',
        ),
        array(
          'title' => 'Oregon',
        ),
        array(
          'title' => 'Pennsylvania',
        ),
        array(
          'title' => 'Rhode Island',
        ),
        array(
          'title' => 'South Carolina',
        ),
        array(
          'title' => 'South Dakota',
        ),
        array(
          'title' => 'Tennessee',
        ),
        array(
          'title' => 'Texas',
        ),
        array(
          'title' => 'Utah',
        ),
        array(
          'title' => 'Vermont',
        ),
        array(
          'title' => 'Virginia',
        ),
        array(
          'title' => 'Washington',
        ),
        array(
          'title' => 'West Virginia',
        ),
        array(
          'title' => 'Wisconsin',
        ),
        array(
          'title' => 'Wyoming',
        ),
      )
    );

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('states');
  }
}
