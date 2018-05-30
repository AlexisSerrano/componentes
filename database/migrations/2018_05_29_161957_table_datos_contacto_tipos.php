<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDatosContactoTipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('datos_contacto_tipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub',200)->nullable();
            $table->string('tipo',200)->nullable();
            $table->boolean('habilitado')->nullable()->default(true);
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
