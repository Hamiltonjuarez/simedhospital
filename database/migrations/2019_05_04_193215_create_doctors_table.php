<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombreDoctor');
            $table->string('apellidosDoctor');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('slogan',130)->nullable();
            $table->string('facebook',75)->nullable();
            $table->string('tituloDoctor', 64);
            $table->string('direccion', 180);
            $table->string('telefono', 64);
            $table->string('logo', 64);
            $table->string('correo', 64)->nullable();
            $table->date('nacimiento')->nullable();

            //$table->string('PaginaWeb')->nulleable();
            //$table->string('imagenDoctor')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
