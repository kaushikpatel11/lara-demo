<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('payment_method', function (Blueprint $table) {
      $table->bigIncrements('method_id');
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('stripe_id')->unique();
      $table->foreign('stripe_id')->references('id')->on('stripes')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

    });
  }

/**
 * Reverse the migrations.
 *
 * @return void
 */
  public function down() {
    Schema::table('payment_method', function (Blueprint $table) {
      $table->dropforeign(['stripe_id']);
      $table->dropforeign(['user_id']);
    });
    Schema::dropIfExists('payment_method');
  }
}
