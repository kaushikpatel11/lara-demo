<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationUserTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('notification_user', function (Blueprint $table) {
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('notification_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
      $table->primary(['user_id', 'notification_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('notification_user', function (Blueprint $table) {
      $table->dropforeign(['user_id']);
      $table->dropforeign(['notification_id']);
    });
    Schema::dropIfExists('notification_user');
  }
}
