<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('events', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title', 100);
      $table->date('date');
      $table->unsignedBigInteger('photo_id')->nullable();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->unsignedBigInteger('created_by');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('photo_id')->references('id')->on('media_uploads')->onDelete('cascade');
      $table->enum('status', ['ACTIVE', 'INACTIVE']);

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('events', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
      $table->dropforeign(['photo_id']);
    });
    Schema::dropIfExists('events');
  }
}
