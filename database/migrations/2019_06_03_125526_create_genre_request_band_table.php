<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreRequestBandTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('genre_request_band', function (Blueprint $table) {
      $table->unsignedBigInteger('request_band_id');
      $table->unsignedBigInteger('genre_id');
      $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
      $table->foreign('request_band_id')->references('id')->on('request_bands')->onDelete('cascade');
      $table->primary(['request_band_id', 'genre_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('genre_request_band', function (Blueprint $table) {
      $table->dropforeign(['genre_id']);
      $table->dropforeign(['request_band_id']);
    });
    Schema::dropIfExists('genre_request_band');
  }
}
