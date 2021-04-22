<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendFaqMaxLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('faqs', function ($table) {
            $table->string('question', 1000)->change();
            $table->string('answer', 1000)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('faqs', function ($table) {
            $table->string('question', 255)->change();
            $table->string('answer', 255)->change();
        });
    }
}
