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
            ]
	    ]);
    }
}
