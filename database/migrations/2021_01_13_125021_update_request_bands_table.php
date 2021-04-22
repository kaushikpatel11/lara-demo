<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRequestBandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_bands', function (Blueprint $table) {
            $table->bigInteger('agent_last_seen')->nullable()->after('booker_last_seen');
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
            $table->dropColumn('agent_last_seen');
          });
    }
}
