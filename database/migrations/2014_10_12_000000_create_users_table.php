<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('email')->unique();
      $table->string('username', 65)->unique();
      $table->string('password');
      $table->char('api_token', 60)->unique()->nullable();
      $table->enum('status', ['NOT_VIRIFIED', 'VIRIFIED', 'ACTIVE', 'BLOCKED', 'PENDING', 'APPROVED', 'DECLINED']);
      $table->string('fname', 35);
      $table->string('lname', 35);
      $table->enum('role', ['BOOKER', 'TALENT', 'ADMIN']);
      $table->timestamp('email_verified_at')->nullable();
      $table->timestamps();
      $table->boolean('verified')->default(false);
      $table->float('api-version')->nullable();
      $table->float('app-version')->nullable();
      $table->enum('device-type', ['IOS', 'ANDROID'])->nullable();
      $table->timestamp('last_login')->nullable();
      $table->string('university', 50)->nullable();
      $table->string('phone_number', 15)->nullable();
      $table->unsignedSmallInteger('events_from')->nullable();
      $table->unsignedSmallInteger('events_to')->nullable();
      $table->text('doc_info')->nullable();
      $table->unsignedBigInteger('photo_id')->nullable();
      $table->unsignedBigInteger('booker_type_id')->nullable();
      $table->unsignedBigInteger('role_id')->nullable();
      $table->string('temp_email')->nullable();
      $table->enum('temp_status', ['NOT_VIRIFIED', 'VIRIFIED', 'SWAPPED'])->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('users');
  }
}
