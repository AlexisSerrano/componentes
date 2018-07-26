<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaMoralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_moral', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->date('fechaCreacion')->nullable()->default(null);
            $table->string('rfc', 20)->nullable()->default(null);
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
        Schema::dropIfExists('persona_moral');
    }
}
