<?php

use Illuminate\Database\Seeder;

class DomicilioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domicilio')->insert([
            [ 
                'idEstado' => 30,
                'idMunicipio' => 2493,
                'idLocalidad' => 108971,
                'idColonia' => 39615,
                'calle' => 'SIN INFORMACIÓN',
                'numExterno' => 0,
                'numInterno' => 0
            ]
	    ]);
    }
}
