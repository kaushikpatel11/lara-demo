<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('abouts', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->string('page_name', 20)->nullable();
      $table->string('title', 100)->nullable();
      $table->string('subtitle', 255)->nullable();
      $table->text('body')->nullable();
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
    Schema::table('abouts', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
    });
    Schema::dropIfExists('abouts');
  }
}
