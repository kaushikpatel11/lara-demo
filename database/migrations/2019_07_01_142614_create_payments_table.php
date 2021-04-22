<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('payments', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('method_id');
      $table->foreign('method_id')->references('method_id')->on('payment_method')->onDelete('cascade');
      $table->unsignedDecimal('amount', 9, 2);
      $table->unsignedBigInteger('request_band_id');
      $table->foreign('request_band_id')->references('id')->on('request_bands')->onDelete('cascade');
      $table->text('response')->nullable();
      $table->text('description')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('payments', function (Blueprint $table) {
      $table->dropforeign(['method_id']);
      $table->dropforeign(['request_band_id']);
    });
    Schema::dropIfExists('payments');
  }
}
