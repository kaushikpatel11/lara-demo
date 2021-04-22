<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasonfordeclineToRequestBandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_bands', function (Blueprint $table) {
            $table->string('reason_for_decline')->default('')->after('status');
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
            $table->dropColumn('reason_for_decline');
        });
    }
}
