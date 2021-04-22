<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('reviews', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->text('demo_review')->nullable();
      $table->date('date');
      $table->string('location', 150)->nullable();
      $table->unsignedDecimal('demo_rating', 2, 1)->nullable();
      $table->unsignedBigInteger('band_id');
      $table->unsignedBigInteger('event_id');
      $table->unsignedBigInteger('created_by');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
      $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
      $table->text('user_review')->nullable()->change();
      $table->string('role', 10)->nullable();
      $table->unsignedDecimal('user_rating', 2, 1)->nullable();
      $table->boolean('isSeen')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('reviews', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
      $table->dropforeign(['band_id']);
      $table->dropforeign(['event_id']);
    });
    Schema::dropIfExists('reviews');
  }
}
