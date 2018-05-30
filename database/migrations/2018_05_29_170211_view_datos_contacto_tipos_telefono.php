<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewDatosContactoTiposTelefono extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('create OR REPLACE view datos_contacto_tipos_telefono as select id,tipo from datos_contacto_tipos where sub="telefono" and habilitado=true;');
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
