<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBandProductionEquipmentTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('band_production_equipment', function (Blueprint $table) {
      $table->unsignedBigInteger('band_id');
      $table->unsignedBigInteger('equipment_id');
      $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
      $table->foreign('equipment_id')->references('id')->on('production_equipment')->onDelete('cascade');
      $table->primary(['equipment_id', 'band_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('band_production_equipment', function (Blueprint $table) {
      $table->dropforeign(['band_id']);
      $table->dropforeign(['equipment_id']);
    });
    Schema::dropIfExists('band_production_equipment');
  }
}
