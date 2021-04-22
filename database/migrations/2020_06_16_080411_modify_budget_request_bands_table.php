<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBudgetRequestBandsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('request_bands', function (Blueprint $table) {
      $table->unsignedDecimal('production_budget', 10, 2);
      $table->dropColumn('budget');
      $table->unsignedDecimal('talent_budget', 10, 2);

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('request_bands', function (Blueprint $table) {
      $table->dropColumn('production_budget');
      $table->dropColumn('talent_budget');
      $table->unsignedDecimal('budget', 10, 2);
    });
  }
}
