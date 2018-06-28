<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BitacoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('bitacora', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sistema',10)->notnull();
            $table->string('usuario',100)->notnull();
            $table->string('tabla',50)->notnull();
            $table->string('operacion',15)->notnull();//INSERT, UPDATE, DELETE
            $table->integer('id_afectado')->nullable();            
            $table->text('antes')->nullable();
            $table->text('despues')->nullable();
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
        Schema::dropIfExists('bitacora');
    }
}
