<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelcomeScreensTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('welcome_screens', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->string('title', 30);
      $table->unsignedBigInteger('photo_id')->nullable();
      $table->string('subtitle', 30);
      $table->string('text');
      $table->enum('role', ['BOOKER', 'TALENT']);
      $table->unsignedBigInteger('created_by');
      $table->foreign('photo_id')->references('id')->on('media_uploads')->onDelete('cascade');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('welcome_screens', function (Blueprint $table) {
      $table->dropforeign(['photo_id']);
      $table->dropforeign(['created_by']);
    });
    Schema::dropIfExists('welcome_screens');
  }
}
