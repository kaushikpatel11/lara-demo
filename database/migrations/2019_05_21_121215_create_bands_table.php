<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBandsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('bands', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name', 100);
      $table->unsignedBigInteger('created_by');
      $table->unsignedBigInteger('photo_id')->nullable();
      $table->unsignedBigInteger('header_photo_id')->nullable();
      $table->string('location', 255);
      $table->unsignedTinyInteger('size');
      $table->Double('price_from', 9, 2);
      $table->Double('price_to', 9, 2);
      $table->text('bio')->nullable();
      $table->unsignedDecimal('rating', 2, 1)->nullable();
      $table->timestamps();
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('photo_id')->references('id')->on('media_uploads')->onDelete('cascade');
      $table->foreign('header_photo_id')->references('id')->on('media_uploads')->onDelete('cascade');
      $table->enum('status', ['ACTIVE', 'INACTIVE', 'PENDING_APPROVAL', 'APPROVED', 'DECLINED']);

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('bands', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
      $table->dropforeign(['photo_id']);
      $table->dropforeign(['header_photo_id']);
    });
    Schema::dropIfExists('bands');
  }
}
