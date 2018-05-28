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
            $table->string('telefono',15)->nullable()->default("SIN INFORMACION");
            $table->string('representanteLegal',100)->nullable()->default("SIN INFORMACION");
            $table->timestamps();
            $table->foreign('idPersona')->references('id')->on('persona_moral')->onDelete('cascade');
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
