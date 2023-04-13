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
        Schema::create('interacciones', function (Blueprint $table) {
            $table->increments('id_interacciones');
            $table->unsignedInteger('id_usuario');
            $table->unsignedInteger('id_monumentos');
            $table->unsignedInteger('tipo_comentario');
            $table->string('visto');
            $table->string('consultado');
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
        //
    }
};
