<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyStripeTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('stripes', function (Blueprint $table) {
      $table->string('account_type', 25)->nullable();
      $table->string('bank_name', 50)->nullable();
      $table->dropColumn('driver_license');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('stripes', function (Blueprint $table) {
      $table->dropColumn('account_type');
      $table->dropColumn('bank_name');
      $table->string('driver_license');
    });
  }
}
