<?php
//namespace fge\apis\migrations;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sistema')->unsigned();
            $table->integer('tipo')->unsigned();
            $table->text('validaciones');                 
            
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
        Schema::dropIfExists('validaciones');
    }
}