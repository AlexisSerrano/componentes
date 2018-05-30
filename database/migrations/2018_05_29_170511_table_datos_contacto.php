<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDatosContacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('datos_contacto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPersona')->unsigned();
            $table->integer('iddatostipo')->unsigned();
            $table->string('valor',200)->nullable()->default("SIN INFORMACION");
            $table->boolean('habilitado')->nullable()->default(true);
            $table->foreign('iddatostipo')->references('id')->on('datos_contacto_tipos')->onDelete('cascade');
            $table->foreign('idPersona')->references('id')->on('personas')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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
}
