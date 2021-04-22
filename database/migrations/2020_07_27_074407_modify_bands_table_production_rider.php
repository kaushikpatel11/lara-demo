<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBandsTableProductionRider extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('bands', function (Blueprint $table) {
      $table->dropforeign(['production_writer_id']);
      $table->dropColumn('production_writer_id');
      $table->unsignedBigInteger('hospitality_and_production_rider_id')->nullable();
      $table->foreign('hospitality_and_production_rider_id')->references('id')->on('media_uploads')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('bands', function (Blueprint $table) {
      $table->dropforeign(['hospitality_and_production_rider_id']);
      $table->dropColumn('hospitality_and_production_rider_id');
      $table->unsignedBigInteger('production_writer_id')->nullable();
      $table->foreign('production_writer_id')->references('id')->on('media_uploads')->onDelete('cascade');
    });
  }
}
