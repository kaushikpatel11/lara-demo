<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBandGigTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('band_gig', function (Blueprint $table) {
      $table->unsignedBigInteger('band_id');
      $table->unsignedBigInteger('gig_id');
      $table->foreign('gig_id')->references('id')->on('gigs')->onDelete('cascade');
      $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
      $table->primary(['band_id', 'gig_id']);

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('band_gig', function (Blueprint $table) {
      $table->dropforeign(['gig_id']);
      $table->dropforeign(['band_id']);
    });
    Schema::dropIfExists('band_gig');
  }
}
