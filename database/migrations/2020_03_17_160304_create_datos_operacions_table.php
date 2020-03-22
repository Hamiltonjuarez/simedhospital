<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosOperacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_operacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('habitacion_id');
            $table->unsignedBigInteger('anestesiologo_id');
            $table->unsignedBigInteger('primer_id');
            $table->unsignedBigInteger('segundo_id');
            $table->unsignedBigInteger('instrumentalista');
            $table->unsignedBigInteger('circular');
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('personals')->onDelete('cascade');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('habitacion_id')->references('id')->on('personals')->onDelete('cascade');
            $table->foreign('anestesiologo_id')->references('id')->on('personals')->onDelete('cascade');
            $table->foreign('primer_id')->references('id')->on('personals')->onDelete('cascade');
            $table->foreign('segundo_id')->references('id')->on('personals')->onDelete('cascade');
            $table->foreign('instrumentalistar_id')->references('id')->on('personals')->onDelete('cascade');
            $table->foreign('circular')->references('id')->on('personals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_operacions');
    }
}
