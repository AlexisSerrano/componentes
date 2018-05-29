<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomiciliosNotificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicilios_notificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idvar_persona')->unsigned();
            $table->string('correo',200)->nullable()->default("SIN INFORMACION");
            $table->string('telefono',15)->nullable()->default("SIN INFORMACION");
            $table->string('fax',15)->nullable()->default("SIN INFORMACION");
            $table->integer('idEstado')->unsigned()->default(33);
            $table->integer('idMunicipio')->unsigned()->default(2497);
            $table->integer('idLocalidad')->unsigned()->default(27592);
            $table->integer('idColonia')->unsigned()->default(8982);
            $table->string('calle', 100)->default("SIN INFORMACION");
            $table->string('numExterno', 10)->default('S/N');
            $table->string('numInterno', 10)->default('S/N');
            $table->boolean('esEmpresa')->nullable()->default(false);
            
            $table->foreign('idEstado')->references('id')->on('cat_estado')->onDelete('cascade');
            $table->foreign('idMunicipio')->references('id')->on('cat_municipio')->onDelete('cascade');
            $table->foreign('idLocalidad')->references('id')->on('cat_localidad')->onDelete('cascade');
            $table->foreign('idColonia')->references('id')->on('cat_colonia')->onDelete('cascade');

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
        Schema::dropIfExists('domicilios_notificaciones');
    }
}
