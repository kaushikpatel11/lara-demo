<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBenefitsRoleTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('benefits', function (Blueprint $table) {
      $table->enum('role', ['BOOKER', 'TALENT'])->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('benefits', function (Blueprint $table) {
      $table->dropColumn('role');
    });}
}
