<?php

use Illuminate\Database\Seeder;

class DefaultsSeeder extends Seeder
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
        
        DB::table('trabajo')->insert([
            [ 
                'idDomicilio' => 1,
                'lugar' => 'SIN INFORMACIÓN',
                'telefono' => 'SIN INFORMACIÓN'
            ]
        ]);
        
        DB::table('notificacion')->insert([
            [ 
                'idDomicilio' => 1,
                'correo' => 'SIN INFORMACIÓN',
                'telefono' => 'SIN INFORMACIÓN'
            ]
	    ]);
    }
}
