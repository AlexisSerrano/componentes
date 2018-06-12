<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonaFisica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_fisica', function (Blueprint $table) {
            $table->increments('id');
             $table->string('nombres', 50)->nullable();
             $table->string('primerAp', 50)->nullable();
             $table->string('segundoAp', 50)->nullable();
             $table->dateTime('fechaNacimiento')->nullable()->default("1900-01-01");
             $table->string('rfc', 20)->nullable()->default("AAAA000101");
             //$table->string('curp', 20)->unique()->nullable();
             $table->string('curp', 20)->nullable();
             $table->string('sexo', 20)->nullable()->default("SIN INFORMACION");
             $table->integer('idNacionalidad')->nullable()->unsigned()->default(132);
             $table->integer('idEtnia')->nullable()->unsigned()->default(13);
             $table->integer('idLengua')->nullable()->unsigned()->default(69);
             $table->integer('idMunicipioOrigen')->nullable()->unsigned()->default(2496);

             $table->foreign('idNacionalidad')->references('id')->on('cat_nacionalidad')->onDelete('cascade');
             $table->foreign('idEtnia')->references('id')->on('cat_etnia')->onDelete('cascade');
             $table->foreign('idLengua')->references('id')->on('cat_lengua')->onDelete('cascade');
             $table->foreign('idMunicipioOrigen')->references('id')->on('cat_municipio')->onDelete('cascade');

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
        Schema::dropIfExists('persona_fisica');
    }
}