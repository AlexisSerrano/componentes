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
            $table->string('telefono',15)->nullable()->default("0");
            $table->string('motivoEstancia',200)->nullable()->default("SIN INFORMACION");
            $table->integer('idOcupacion')->nullable()->unsigned()->default(2941);
            $table->integer('idEstadoCivil')->nullable()->unsigned()->default(7);
            $table->integer('idEscolaridad')->nullable()->unsigned()->default(14);
            $table->integer('idReligion')->nullable()->unsigned()->default(29);
            $table->integer('docIdentificacion')->nullable()->unsigned()->default(14);
            $table->integer('idInterprete')->nullable()->unsigned()->default(1);
            $table->string('numDocIdentificacion',50)->nullable()->default("SIN INFORMACION");
            // $table->string('lugarTrabajo',50)->default("SIN INFORMACION");
            // $table->string('telefonoTrabajo',15)->default("SIN INFORMACION");
            $table->integer('idDomicilio')->nullable()->unsigned()->default(1);
            // $table->integer('idDomicilioTrabajo')->nullable()->unsigned()->default(1);
            $table->integer('idTrabajo')->nullable()->unsigned()->default(1);
            $table->integer('idNotificacion')->nullable()->unsigned()->default(1);

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('idPersona')->references('id')->on('persona_fisica')->onDelete('cascade');
            $table->foreign('idOcupacion')->references('id')->on('cat_ocupacion')->onDelete('restrict');
            $table->foreign('idEstadoCivil')->references('id')->on('cat_estado_civil')->onDelete('restrict');
            $table->foreign('idEscolaridad')->references('id')->on('cat_escolaridad')->onDelete('restrict');
            $table->foreign('idReligion')->references('id')->on('cat_religion')->onDelete('restrict');
            $table->foreign('docIdentificacion')->references('id')->on('cat_identificacion')->onDelete('restrict');
            $table->foreign('idDomicilio')->references('id')->on('domicilio')->onDelete('restrict');
            //$table->foreign('idDomicilioTrabajo')->references('id')->on('domicilio')->onDelete('restrict');
            $table->foreign('idNotificacion')->references('id')->on('notificacion')->onDelete('restrict');
            $table->foreign('idTrabajo')->references('id')->on('trabajo')->onDelete('restrict');
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
