<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookerTypesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('booker_types', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('type', 25);
      $table->timestamps();
      $table->unsignedBigInteger('created_by');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
    });

    Schema::table('users', function (Blueprint $table) {
      $table->foreign('booker_type_id')->references('id')->on('booker_types');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('users', function (Blueprint $table) {
      $table->dropforeign(['booker_type_id']);
    });
    Schema::table('booker_types', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
    });
    Schema::dropIfExists('booker_types');
  }
}
