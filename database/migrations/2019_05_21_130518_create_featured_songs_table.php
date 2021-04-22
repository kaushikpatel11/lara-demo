<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturedSongsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('featured_songs', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name', 150);
      $table->string('url', 255);
      $table->unsignedBigInteger('band_id');
      $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('featured_songs', function (Blueprint $table) {
      $table->dropforeign(['band_id']);
    });
    Schema::dropIfExists('featured_songs');
  }
}
