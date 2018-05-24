<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewPersonaCompletaActual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('create OR REPLACE view persona_completa_actual as select * from variables_persona vp1 inner join vpersona_actual vp2 on vp1.id=vp2.id inner join personas p  on  p.id = vp1.idPersona;');
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
