<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionalNotificationsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('promotional_notifications', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->string('title', 150)->nullable();
      $table->text('description')->nullable();
      $table->unsignedBigInteger('created_by');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
      $table->unsignedBigInteger('photo_id')->nullable();
      $table->foreign('photo_id')->references('id')->on('media_uploads')->onDelete('cascade');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('promotional_notifications');
  }
}
