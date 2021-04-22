<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('terms', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('page_name', 20)->nullable();
      $table->text('body')->nullable();
      $table->unsignedBigInteger('created_by');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('terms', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
    });
    Schema::dropIfExists('terms');
  }
}
