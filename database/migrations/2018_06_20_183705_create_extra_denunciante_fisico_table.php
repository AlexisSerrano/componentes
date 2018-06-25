<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraDenuncianteFisicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_denunciante_fisico', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idVariablesPersona')->unsigned();
            //$table->integer('idNotificacion')->unsigned()->index()->nullable();
            $table->integer('idAbogado')->unsigned()->index()->nullable();
            $table->string('resguardarIdentidad')->nullable();
            $table->boolean('victima')->default(true);
            // $table->string('narracion',2000)->default("SIN INFORMACION");
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('idVariablesPersona')->references('id')->on('variables_persona_fisica')->onDelete('cascade');
            //$table->foreign('idNotificacion')->references('id')->on('notificacion')->onDelete('cascade');
            $table->foreign('idAbogado')->references('id')->on('extra_abogado')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_denunciante_fisico');
    }
}
