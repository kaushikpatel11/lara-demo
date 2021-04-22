<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessagesLastSeen extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('request_bands', function (Blueprint $table) {
      $table->bigInteger('talent_last_seen')->nullable();
      $table->bigInteger('booker_last_seen')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('request_bands', function (Blueprint $table) {
      $table->dropColumn('talent_last_seen');
      $table->dropColumn('booker_last_seen');
    });
  }
}
