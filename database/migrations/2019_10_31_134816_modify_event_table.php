<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEventTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('events', function (Blueprint $table) {
      $table->string('location', 255);
      $table->string('start_time', 20)->nullable();
      $table->string('end_time', 20)->nullable();
      $table->unsignedBigInteger('state_id')->nullable();
      $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
      $table->unsignedBigInteger('event_type_id')->nullable();
      $table->foreign('event_type_id')->references('id')->on('gigs')->onDelete('cascade');
      $table->unsignedBigInteger('number_of_attendees')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('events', function (Blueprint $table) {
      $table->dropforeign(['state_id']);
      $table->dropforeign(['event_type_id']);

      $table->dropColumn('location');
      $table->dropColumn('start_time');
      $table->dropColumn('end_time');
      $table->dropColumn('state_id');
      $table->dropColumn('event_type_id');
      $table->dropColumn('number_of_attendees');
    });
  }
}
