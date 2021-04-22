<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBandTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('bands', function (Blueprint $table) {
      $table->unsignedBigInteger('production_writer_id')->nullable();
      $table->foreign('production_writer_id')->references('id')->on('media_uploads')->onDelete('cascade');
      $table->boolean('isFeatured')->default(false);
      $table->unsignedBigInteger('state_id')->nullable();
      $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('bands', function (Blueprint $table) {
      $table->dropForeign(['production_writer_id']);
      $table->dropColumn('production_writer_id');
      $table->dropColumn('isFeatured');
      $table->dropforeign(['state_id']);
      $table->dropColumn('state_id');
    });
  }
}
