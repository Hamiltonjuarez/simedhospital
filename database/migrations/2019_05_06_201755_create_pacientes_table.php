<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 64);
            $table->string('apellidos', 64);
            $table->date('nacimiento');
            $table->string('telefono', 12)->nullable();
            $table->string('email', 120)->unique()->nullable();
            $table->string('sexo', 1);
            $table->string('civil', 32)->nullable();
            $table->string('codigo', 64)->nullable();
            $table->string('dui', 64)->nullable();
            $table->string('photo_extension')->nullable();
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->string('estatura')->nullable();
            $table->string('peso')->nullable();
            $table->string('presion')->nullable();
            $table->text('notas')->nullable();
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
        Schema::dropIfExists('pacientes');
    }
}
