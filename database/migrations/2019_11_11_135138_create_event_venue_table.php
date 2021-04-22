<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventVenueTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('event_venue', function (Blueprint $table) {
      $table->unsignedBigInteger('event_id');
      $table->unsignedBigInteger('venue_id');
      $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
      $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
      $table->primary(['event_id', 'venue_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('event_venue', function (Blueprint $table) {
      $table->dropforeign(['venue_id']);
      $table->dropforeign(['event_id']);
    });
    Schema::dropIfExists('event_venue');
  }
}
