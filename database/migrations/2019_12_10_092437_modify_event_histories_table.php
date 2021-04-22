<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEventHistoriesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('event_histories', function (Blueprint $table) {
      $table->string('role', 10);
      $table->unsignedBigInteger('request_id')->nullable();
      $table->foreign('request_id')->references('id')->on('request_bands')->onDelete('cascade');
      $table->string('value', 50);

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('event_histories', function (Blueprint $table) {
      $table->dropColumn('role');
      $table->dropColumn('value');
      $table->dropForeign(['request_id']);
      $table->dropColumn('request_id');
    });
  }
}
