<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBandStateTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('band_state', function (Blueprint $table) {
      $table->unsignedBigInteger('band_id');
      $table->unsignedBigInteger('state_id');
      $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
      $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
      $table->primary(['band_id', 'state_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('band_state', function (Blueprint $table) {
      $table->dropforeign(['state_id']);
      $table->dropforeign(['band_id']);
    });
    Schema::dropIfExists('band_state');
  }
}
