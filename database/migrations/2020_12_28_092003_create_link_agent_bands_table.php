<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkAgentBandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_agent_bands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('band_id');
            $table->enum('request_status', [ 'SENT_BY_AGENT', 'SENT_BY_TALENT', 'ACCEPTED_BY_AGENT', 'ACCEPTED_BY_TALENT', 'REJECTED_BY_AGENT', 'REJECTED_BY_TALENT']);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('link_agent_bands', function (Blueprint $table) {
            $table->dropforeign(['created_by']);
          });
          Schema::dropIfExists('link_agent_bands');    }
}
