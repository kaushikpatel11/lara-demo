<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaUploadsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('media_uploads', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('created_by');
      $table->char('path', 255);
      $table->integer('server');
      $table->timestamps();
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
    });

    Schema::table('users', function (Blueprint $table) {
      $table->foreign('photo_id')->references('id')->on('media_uploads');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('users', function (Blueprint $table) {
      $table->dropforeign(['photo_id']);
    });
    Schema::table('media_uploads', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
    });
    Schema::dropIfExists('media_uploads');
  }
}
