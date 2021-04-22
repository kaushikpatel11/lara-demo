<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('stripes', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->char('stripe_id');
      $table->char('card_id')->unique()->nullable();
      $table->unsignedSmallInteger('last_4_digits')->nullable();
      $table->integer('exp_month')->nullable();
      $table->integer('exp_year')->nullable();
      $table->char('driver_license')->nullable();
      $table->unsignedBigInteger('address_id')->nullable();
      $table->string('brand', 50)->nullable();
      $table->string('username', 150)->nullable();
      $table->string('type', 10)->nullable();

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('stripes');
  }
}
