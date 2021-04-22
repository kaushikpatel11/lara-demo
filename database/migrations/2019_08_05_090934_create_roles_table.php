<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('roles', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name');
      $table->string('description')->nullable();
      $table->timestamps();
    });

    Schema::table('users', function (Blueprint $table) {
      $table->foreign('role_id')->references('id')->on('roles');
    });

    DB::table('roles')->insert(
      array(
        array(
          'name' => 'BOOKER',
        ),
        array(
          'name' => 'TALENT',
        ),
      )
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('users', function (Blueprint $table) {
      $table->dropforeign(['role_id']);
    });
    Schema::dropIfExists('roles');
  }
}
