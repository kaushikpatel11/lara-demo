<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHowItWorksTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('how_it_works', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->string('page_name', 20)->nullable();
      $table->string('title', 30)->nullable();
      $table->string('subtitle', 100)->nullable();
      $table->text('body')->nullable();
      $table->enum('role', ['BOOKER', 'TALENT']);
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
    Schema::table('how_it_works', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
    });
    Schema::dropIfExists('how_it_works');}
}
