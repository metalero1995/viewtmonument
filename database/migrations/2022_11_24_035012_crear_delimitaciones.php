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
        Schema::create('delimitaciones', function (Blueprint $table) {
            $table->increments('id_delimitacion');
            $table->unsignedInteger('id_ciudad');
            $table->double('latitud_delimitacion');
            $table->double('longitud_delimitacion');
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
        Schema::dropIfExists('delimitaciones');
    }
};
