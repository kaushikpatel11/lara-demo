<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('addresses', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->string('street', 255);
      $table->string('city', 50);
      $table->unsignedBigInteger('zip');
      $table->char('number')->nullable();
      $table->unsignedBigInteger('state_id');
      $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade')->nullable();
      $table->unsignedBigInteger('created_by');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->nullable();

    });
    Schema::table('stripes', function (Blueprint $table) {
      $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
    });

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('stripes', function (Blueprint $table) {
      $table->dropforeign(['address_id']);
    });
    Schema::table('addresses', function (Blueprint $table) {
      $table->dropforeign(['state_id']);
      $table->dropforeign(['created_by']);
    });
    Schema::dropIfExists('addresses');
  }
}
