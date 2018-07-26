<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariablesPersonaMoralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables_persona_moral', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPersona')->unsigned();
            $table->string('telefono',15)->nullable()->default("0");
            $table->string('nombreRep',100)->nullable()->default("SIN INFORMACION");
            $table->string('primerApRep',100)->nullable()->default("SIN INFORMACION");
            $table->string('segundoApRep',100)->nullable()->default("SIN INFORMACION");
            $table->integer('docIdentificacion')->nullable()->unsigned()->default(14);
            $table->string('numDocIdentificacion',50)->nullable()->default("SIN INFORMACION");
            $table->integer('idDomicilio')->nullable()->unsigned()->default(1);
            $table->integer('idNotificacion')->nullable()->unsigned()->default(1);
            $table->timestamps();
            
            $table->foreign('docIdentificacion')->references('id')->on('cat_identificacion')->onDelete('restrict');
            $table->foreign('idPersona')->references('id')->on('persona_moral')->onDelete('cascade');
            $table->foreign('idNotificacion')->references('id')->on('notificacion')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variables_persona_moral');
    }
}
