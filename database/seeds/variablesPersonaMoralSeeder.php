<?php

use Illuminate\Database\Seeder;

class variablesPersonaMoralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variables_persona_moral')->insert([
            [ 
                'idPersona' => 1,
                'telefono' => '5588945876',
                'representanteLegal' => 'SIN INFORMACION',
                'idDomicilio'=>'1',
                'idNotificacion'=>'1'
            ]
	    ]);

    }
}
