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
                'idVariablesPersona' => 1,
                'cedulaProf' => 'NHR5D6DFH',
                'sector' => 'Público',
                'correo'=>'correo@gmail.com',
                'tipo'=>'Civil'
            ]
	    ]);
    }
}
