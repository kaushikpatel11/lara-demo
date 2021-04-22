<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventHistoriesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('event_histories', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('date');
      $table->string('action');
      $table->string('notes')->nullable();
      $table->unsignedBigInteger('event_id');
      $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
      $table->unsignedBigInteger('created_by');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('event_histories', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
      $table->dropforeign(['event_id']);

    });
    Schema::dropIfExists('event_histories');
  }
}
