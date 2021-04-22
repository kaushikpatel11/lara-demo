<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoggersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('loggers', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->text('time');
      $table->unsignedDecimal('duration', 4, 3);
      $table->char('ip_address', 20);
      $table->string('url', 255);
      $table->string('method', 10);
      $table->text('input');
      $table->text('output');
      $table->text('headers');
      $table->string('device_type', 20)->nullable();
      $table->string('app_version', 10)->nullable();
      $table->string('api_version', 10)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('loggers');
  }
}
