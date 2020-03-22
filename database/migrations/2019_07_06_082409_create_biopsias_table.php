<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiopsiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biopsias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('precioBiopsia',8,2);
            $table->enum('status', ['cancelado', 'no-cancelado'])->default('no-cancelado');
            $table->unsignedBigInteger('procedimiento_id');
            $table->foreign('procedimiento_id')->references('id')->on('procedimientos')->onDelete('cascade');
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
        Schema::dropIfExists('biopsias');
    }
}
