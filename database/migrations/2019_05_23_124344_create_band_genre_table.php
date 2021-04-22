<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBandGenreTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('band_genre', function (Blueprint $table) {
      $table->unsignedBigInteger('band_id');
      $table->unsignedBigInteger('genre_id');
      $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
      $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
      $table->primary(['band_id', 'genre_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('band_genre', function (Blueprint $table) {
      $table->dropforeign(['genre_id']);
      $table->dropforeign(['band_id']);
    });
    Schema::dropIfExists('band_genre');
  }
}
