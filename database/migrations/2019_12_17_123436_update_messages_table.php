<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMessagesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    //
    Schema::table('messages', function (Blueprint $table) {
      $table->dropColumn('date');
      $table->dropColumn('subject');
      $table->renameColumn('comment', 'message_text');
      $table->renameColumn('reply_to', 'parent_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('messages', function (Blueprint $table) {
      $table->string('date');
      $table->string('subject');
      $table->renameColumn('message_text', 'comment');
      $table->renameColumn('parent_id', 'reply_to');
    });
  }
}
