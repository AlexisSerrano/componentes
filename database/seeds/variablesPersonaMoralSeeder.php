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
                'id' => 1,
                'idPersona' => 1,
                'telefono' => '5588945876',
                'nombreRep' => 'SIN INFORMACION',
                'primerApRep' => 'SIN INFORMACION',
                'segundoApRep' => 'SIN INFORMACION',
                'idDomicilio'=>'1',
                'idNotificacion'=>'1'
            ],
            
            [ 
                'id' => 2,
                'idPersona' => 2,
                'telefono' => '0182001585',
                'nombreRep' => 'INGENIERO ROBERTO',
                'primerApRep' => 'SIN INFORMACION',
                'segundoApRep' => 'SIN INFORMACION',
                'idDomicilio'=>1,
                'idNotificacion'=>1
            ],
            [ 
                'id' => 3,
                'idPersona' => 3,
                'telefono' => '55887492',
                'nombreRep' => 'LICENCIADA MARIANA',
                'primerApRep' => 'SIN INFORMACION',
                'segundoApRep' => 'SIN INFORMACION',
                'idDomicilio'=>1,
                'idNotificacion'=>1
            ],
            [ 
                'id' => 4,
                'idPersona' => 4,
                'telefono' => '88996647525',
                'nombreRep' => 'LICENCIADO GUSTAVO',
                'primerApRep' => 'SIN INFORMACION',
                'segundoApRep' => 'SIN INFORMACION',
                'idDomicilio'=>1,
                'idNotificacion'=>1
            ],

	    ]);

    }
}
