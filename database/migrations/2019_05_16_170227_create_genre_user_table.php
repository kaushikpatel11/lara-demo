<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreUserTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('genre_user', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('genre_id');
      $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('genre_user', function (Blueprint $table) {
      $table->dropforeign(['genre_id']);
      $table->dropforeign(['user_id']);
    });
    Schema::dropIfExists('genre_user');
  }
}
