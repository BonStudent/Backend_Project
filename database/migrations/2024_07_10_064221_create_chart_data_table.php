<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartDataTable extends Migration
{
    public function up()
    {
        Schema::create('chart_data', function (Blueprint $table) {
            $table->id();
            $table->string('year')->unique();
            $table->text('bar_data');
            $table->text('pie_data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chart_data');
    }
};