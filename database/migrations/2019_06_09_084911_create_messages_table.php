<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('messages', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->string('subject', 150)->nullable();
      $table->text('comment');
      $table->dateTime('date');
      $table->unsignedBigInteger('created_by');
      $table->unsignedBigInteger('event_request_id');
      $table->unsignedBigInteger('reply_to');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('event_request_id')->references('id')->on('request_bands')->onDelete('cascade');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('messages', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
      $table->dropforeign(['event_request_id']);
    });
    Schema::dropIfExists('messages');
  }
}
