<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertNewRoleRecord extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    DB::table('roles')->insert(
      array(
        array(
          'name' => 'AGENT',
        ),
      )
    );
  }
}