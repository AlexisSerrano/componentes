<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAparicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apariciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idvar_persona')->unsigned();
            $table->integer('id_carpeta')->unsigned();
            $table->integer('id_sistema')->unsigned();
            $table->integer('id_involucrado')->unsigned();
            $table->dateTime('fecha');
            $table->integer('nuc')->unsigned();

            $table->foreign('idvar_persona')->references('id')->on('variables_persona')->onDelete('cascade');
            //$table->foreign('id_carpeta')->references('id')->on('carpeta')->onDelete('cascade');
            $table->foreign('id_sistema')->references('id')->on('sistemas')->onDelete('cascade');
            $table->foreign('id_involucrado')->references('id')->on('involucrados')->onDelete('cascade');
            
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
        Schema::dropIfExists('apariciones');
    }
}
