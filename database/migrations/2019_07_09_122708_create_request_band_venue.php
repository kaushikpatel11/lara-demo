<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestBandVenue extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('request_band_venue', function (Blueprint $table) {
      $table->unsignedBigInteger('request_band_id');
      $table->unsignedBigInteger('venue_id');
      $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
      $table->foreign('request_band_id')->references('id')->on('request_bands')->onDelete('cascade');
      $table->primary(['request_band_id', 'venue_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('request_band_venue', function (Blueprint $table) {
      $table->dropforeign(['venue_id']);
      $table->dropforeign(['request_band_id']);
    });
    Schema::dropIfExists('request_band_venue');
  }
}
