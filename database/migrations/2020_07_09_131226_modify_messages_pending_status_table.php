<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyMessagesPendingStatusTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    DB::statement("ALTER TABLE messages MODIFY message_type ENUM('PAY_DEPOSIT', 'PAY_REMAINDER', 'PAY_FULL_PAYMENT', 'NO_ACTION', 'PAYMENT_DECLINED')");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    DB::statement("ALTER TABLE messages MODIFY message_type ENUM('PAY_DEPOSIT', 'PAY_REMAINDER', 'PAY_FULL_PAYMENT', 'NO_ACTION')");
  }
}
