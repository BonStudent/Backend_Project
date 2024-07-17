<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MOEP', function (Blueprint $table) {
            $table->id();
            $table->string('applicant');
            $table->string('moep_no');
            $table->string('permit_no');
            $table->date('issued');
            $table->date('validated');
            $table->string('reportPDF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MOEP');
    }
};