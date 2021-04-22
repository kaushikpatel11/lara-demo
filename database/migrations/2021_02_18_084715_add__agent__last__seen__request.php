<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgentLastSeenRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_bands', function (Blueprint $table) {                        
            $table->dateTime('agent_last_seen_request')->useCurrent();
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_bands', function (Blueprint $table) {                        
            $table->dropColumn('agent_last_seen_request');
        });
    }
}
