<?php
//namespace fge\apis\migrations;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idsistema')->unsigned();
            $table->integer('idcomponente')->unsigned();
            $table->integer('idinvolucrado')->unsigned();
            $table->text('config');                 
            
            $table->foreign('idsistema')->references('id')->on('sistemas')->onDelete('cascade');
            $table->foreign('idcomponente')->references('id')->on('componentes')->onDelete('cascade');
            $table->foreign('idinvolucrado')->references('id')->on('involucrados')->onDelete('cascade');
            
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
        Schema::dropIfExists('ligados');
    }
}
