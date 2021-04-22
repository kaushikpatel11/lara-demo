<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRequestStatusToLinkAgentBandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('link_agent_bands', function (Blueprint $table) {
            DB::statement("ALTER TABLE link_agent_bands MODIFY request_status ENUM('SENT_BY_AGENT', 'SENT_BY_TALENT', 'ACCEPTED_BY_AGENT', 'ACCEPTED_BY_TALENT', 'REJECTED_BY_AGENT', 'REJECTED_BY_TALENT', 'REMOVED_BY_AGENT', 'REMOVED_BY_TALENT') NOT NULL");
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
            DB::statement("ALTER TABLE link_agent_bands MODIFY request_status ENUM('SENT_BY_AGENT', 'SENT_BY_TALENT', 'ACCEPTED_BY_AGENT', 'ACCEPTED_BY_TALENT', 'REJECTED_BY_AGENT', 'REJECTED_BY_TALENT') NOT NULL");
        });
    }
}
