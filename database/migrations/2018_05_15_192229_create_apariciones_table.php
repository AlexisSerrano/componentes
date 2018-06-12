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
            $table->integer('idVarPersona')->unsigned();
            $table->integer('idCarpeta')->unsigned();
            $table->string('sistema',20);
            $table->integer('tipoInvolucrado')->nullable()->unsigned();
            $table->timestamp('fechaCreacion')->useCurrent();
            $table->string('nuc');
            $table->boolean('esEmpresa')->nullable()->default(false);

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
