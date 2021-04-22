<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestBandsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('request_bands', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->unsignedBigInteger('created_by')->nullable();
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
      $table->enum('status', ['OPEN', 'ACCEPTED_BY_TALENT', 'REJECTED_BY_TALENT', 'CANCELED_BY_TALENT', 'CANCELED_BY_BOOKER', 'PENDING_DEPOSIT', 'PENDING_REMAINDER', 'PENDING_FULL_PAYMENT', 'COMPLETED', 'APPROVED']);
      $table->unsignedBigInteger('event_id')->nullable();
      $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
      $table->unsignedBigInteger('band_id')->nullable();
      $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
      $table->string('title', 50);
      $table->date('date');
      $table->string('location', 255);
      $table->unsignedBigInteger('photo_id')->nullable();
      $table->foreign('photo_id')->references('id')->on('media_uploads')->onDelete('cascade');
      $table->unsignedBigInteger('number_of_attendees')->nullable();
      $table->unsignedDecimal('budget', 10, 2);
      $table->char('currency', 50);
      $table->dateTime('start_time');
      $table->dateTime('end_time');
      $table->text('notes')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('request_bands', function (Blueprint $table) {
      $table->dropforeign(['created_by']);
      $table->dropforeign(['event_id']);
      $table->dropforeign(['band_id']);
    });
    Schema::dropIfExists('request_bands');
  }
}
