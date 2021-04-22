<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySocialAndFeaturedTables extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('social_links', function (Blueprint $table) {
      $table->boolean('isVisible')->default(true);
    });
    Schema::table('featured_songs', function (Blueprint $table) {
      $table->boolean('isVisible')->default(true);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('social_links', function (Blueprint $table) {
      $table->dropColumn('isVisible');
    });
    Schema::table('featured_songs', function (Blueprint $table) {
      $table->dropColumn('isVisible');
    });
  }
}
