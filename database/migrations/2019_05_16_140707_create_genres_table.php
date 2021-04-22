<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenresTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('genres', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('title', 30);
      $table->timestamps();
      $table->unsignedBigInteger('created_by');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('genres', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
    });
    Schema::dropIfExists('genres');
  }
}
