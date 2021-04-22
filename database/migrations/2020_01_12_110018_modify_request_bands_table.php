<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRequestBandsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('request_bands', function (Blueprint $table) {
      $table->bigInteger('last_message_time')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('request_bands', function (Blueprint $table) {
      $table->dropColumn('last_message_time');
    });
  }
}
