<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VariablesPersonaFisica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables_persona_fisica', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPersona')->unsigned();
            $table->integer('edad')->nullable();
            $table->string('telefono',15)->nullable()->default("SIN INFORMACION");
            $table->string('motivoEstancia',200)->nullable()->default("SIN INFORMACION");
            $table->integer('idOcupacion')->nullable()->unsigned()->default(2941);
            $table->integer('idEstadoCivil')->nullable()->unsigned()->default(7);
            $table->integer('idEscolaridad')->nullable()->unsigned()->default(14);
            $table->integer('idReligion')->nullable()->unsigned()->default(29);
            $table->integer('idDomicilio')->nullable()->unsigned()->default(0);
            $table->string('docIdentificacion',50)->nullable()->default("SIN INFORMACION");
            $table->integer('idInterprete')->nullable()->unsigned()->default(0);
            $table->string('numDocIdentificacion',50)->nullable()->default("SIN INFORMACION");
            $table->integer('idDomicilioTrabajo')->nullable()->unsigned()->default(1);
            $table->string('alias',100)->nullable()->default("SIN INFORMACION");

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('idPersona')->references('id')->on('persona_fisica')->onDelete('cascade');
            $table->foreign('idOcupacion')->references('id')->on('cat_ocupacion')->onDelete('cascade');
            $table->foreign('idEstadoCivil')->references('id')->on('cat_estado_civil')->onDelete('cascade');
            $table->foreign('idEscolaridad')->references('id')->on('cat_escolaridad')->onDelete('cascade');
            $table->foreign('idReligion')->references('id')->on('cat_religion')->onDelete('cascade');
            // $table->foreign('idDomicilio')->references('id')->on('domicilios')->onDelete('cascade');
            // $table->foreign('idDomicilioTrabajo')->references('id')->on('domicilios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variables_persona_fisica');
    }
}
