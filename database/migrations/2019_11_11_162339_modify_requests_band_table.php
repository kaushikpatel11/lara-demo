<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRequestsBandTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('request_bands', function (Blueprint $table) {
      $table->dropForeign(['photo_id']);
      $table->dropColumn('photo_id');
      $table->dropColumn('title');
      $table->dropColumn('date');
      $table->dropColumn('location');
      $table->dropColumn('number_of_attendees');
      $table->dropColumn('currency');
      $table->dropColumn('start_time');
      $table->dropColumn('end_time');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    //
  }
}
