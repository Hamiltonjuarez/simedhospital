<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('procedimiento_tipo_id');
            $table->bigInteger('plantilla');
            $table->text('descripcion')->nullable();
            $table->text('contenido');
            $table->decimal('precioProcedimiento', 8, 2);
            $table->enum('status', ['cancelado', 'no-cancelado'])->default('no-cancelado');
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
        Schema::dropIfExists('procedimientos');
    }
}
