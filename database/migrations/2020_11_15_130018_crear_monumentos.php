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
        Schema::create('monumentos', function (Blueprint $table) {
            $table->increments('id_monumento');
            $table->unsignedInteger('id_pais');
            $table->unsignedInteger('id_estado');
            $table->unsignedInteger('id_ciudad');
            $table->string('nombre_monumento', 75);
            $table->string('descripcion_monumento', 300);
            $table->string('anio_monumento', 5);
            $table->unsignedInteger('tipo_monumento');
            $table->string('modelado_3d_hp', 250)->nullable();
            $table->string('modelado_3d_lp', 250)->nullable();
            $table->double('latitud_monumento');
            $table->double('longitud_monumento');
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('monumentos');
    }
};
