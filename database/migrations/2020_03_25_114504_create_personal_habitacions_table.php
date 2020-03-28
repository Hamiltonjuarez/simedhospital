<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_habitacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cargo',64);
            $table->unsignedBigInteger('personal_id');
            $table->unsignedBigInteger('habitacion_id');
            
            $table->timestamps();

            $table->foreign('personal_id')->references('id')->on('personals')->onDelete('cascade');
            $table->foreign('habitacion_id')->references('id')->on('habitaciones_areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_habitacions');
    }
}
