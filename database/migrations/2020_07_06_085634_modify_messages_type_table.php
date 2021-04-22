<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyMessagesTypeTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('messages', function (Blueprint $table) {
      $table->enum('message_type', ['PAY_DEPOSIT', 'PAY_REMAINDER', 'PAY_FULL_PAYMENT', 'NO_ACTION'])->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('messages', function (Blueprint $table) {
      $table->dropColumn('message_type');
    });
  }
}
