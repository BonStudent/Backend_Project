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
        Schema::create('csag', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('area');
            $table->string('province');
            $table->string('city_municipality');
            $table->string('barangay');
            $table->string('sitio')->nullable();
            $table->string('river');
            $table->date('received');
            $table->date('released');
            $table->string('status');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('csag');
    }
};
