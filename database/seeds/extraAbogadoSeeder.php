<?php

use Illuminate\Database\Seeder;

class extraAbogadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('extra_abogado')->insert([
            [ 
                'id'=> 1,
                'idVariablesPersona' => 5,
                'cedulaProf' => 'NHR5D6DFH',
                'sector' => 'PÚBLICO',
                'correo'=>'CORREO@GMAIL.COM',
                'tipo'=>'CIVIL'
            ],
            [ 
                'id'=> 2,
                'idVariablesPersona' => 2,
                'cedulaProf' => 'DDK443',
                'sector' => 'PRIVADO',
                'correo'=>'CORREO@GMAIL.COM',
                'tipo'=>'OTRO1'
            ],
            [ 
                'id'=> 3,
                'idVariablesPersona' => 3,
                'cedulaProf' => 'KKOOPP009',
                'sector' => 'PÚBLICO',
                'correo'=>'CORREO@GMAIL.COM',
                'tipo'=>'OTRO2'
            ]
	    ]);
    }
}
