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
            $table->integer('idCarpeta');
            $table->string('carpeta',25)->nullable();
            $table->string('sistema',20);
            $table->string('tipoInvolucrado',20);
            $table->string('nuc',50);
            $table->boolean('esEmpresa')->nullable()->default(false);
            $table->tinyInteger('activo')->default(1);
            $table->integer('idTipoDeterminacion')->unsigned()->default(1);
            //$table->integer('idStatusCarpeta')->unsigned();         
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idTipoDeterminacion')->references('id')->on('cat_tipo_determinacion')->onDelete('restrict');
            /*$table->foreign('idStatusCarpeta')->references('id')->on('idStatusCarpeta')->onDelete('cascade');*/
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
