<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBandsStatusTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    DB::statement("ALTER TABLE bands MODIFY status ENUM('ACTIVE','INACTIVE','PENDING_APPROVAL','APPROVED','DECLINED','MISSING_PROFILE','MISSING_PAYMENT') NOT NULL");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    DB::statement("ALTER TABLE bands MODIFY status ENUM('ACTIVE','INACTIVE','PENDING_APPROVAL','APPROVED','DECLINED') NOT NULL");
  }
}
