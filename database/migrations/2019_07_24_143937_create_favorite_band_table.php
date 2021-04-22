<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteBandTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('favorite_band', function (Blueprint $table) {
      $table->unsignedBigInteger('band_id');
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
      $table->primary(['band_id', 'user_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('favorite_band', function (Blueprint $table) {
      $table->dropforeign(['user_id']);
      $table->dropforeign(['band_id']);
    });
    Schema::dropIfExists('favorite_band');
  }
}
