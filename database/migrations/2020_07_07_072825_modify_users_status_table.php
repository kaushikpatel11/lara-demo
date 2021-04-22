<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersStatusTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    DB::statement("ALTER TABLE users MODIFY status ENUM('NOT_VIRIFIED','VIRIFIED','ACTIVE','BLOCKED','PENDING','APPROVED','DECLINED','MISSING_PROFILE','MISSING_PAYMENT') NOT NULL");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    DB::statement("ALTER TABLE users MODIFY status ENUM('NOT_VIRIFIED','VIRIFIED','ACTIVE','BLOCKED','PENDING','APPROVED','DECLINED') NOT NULL");
  }
}
