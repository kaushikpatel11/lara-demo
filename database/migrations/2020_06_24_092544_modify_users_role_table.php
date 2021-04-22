<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersRoleTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    DB::statement("ALTER TABLE users MODIFY role ENUM('BOOKER', 'TALENT', 'ADMIN', 'demo') NOT NULL");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    DB::statement("ALTER TABLE users MODIFY role ENUM('BOOKER', 'TALENT', 'ADMIN') NOT NULL");
  }
}
