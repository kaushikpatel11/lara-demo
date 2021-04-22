<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreviusStatusAndUpdatetimeInRequestBand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_bands', function (Blueprint $table) {            
            $table->enum('previous_status', ['OPEN', 'ACCEPTED_BY_TALENT', 'REJECTED_BY_TALENT', 'CANCELED_BY_TALENT', 'CANCELED_BY_BOOKER', 'PENDING_DEPOSIT', 'PENDING_REMAINDER', 'PENDING_FULL_PAYMENT', 'COMPLETED', 'APPROVED']);
            $table->dateTime('previous_status_time')->useCurrent();
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
            $table->dropColumn('previous_status');
            $table->dropColumn('previous_status_time');
        });
    }
}
