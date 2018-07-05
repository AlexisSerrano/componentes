<?php

use Illuminate\Database\Seeder;

class personaMoralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persona_moral')->insert([
            [ 
                'id' => 1,
                'nombre' => 'ABOGADOS & ASOCIADOS',
                'fechaCreacion' => '1900-01-01',
                'rfc' => 'ROTF250715225'
            ],
            [ 
                'id' => 2,
                'nombre' => 'SISTEMAS EMPRESARIALES THINK_CENTRE',
                'fechaCreacion' => '1990-01-01',
                'rfc' => 'TICS900101PIA'
            ],

            [ 
                'id' => 3,
                'nombre' => 'QUALITY AND KNOWLEDGE',
                'fechaCreacion' => '1990-01-01',
                'rfc' => 'TICS900100TRHJ'
            ],

            [ 
                'id' => 4,
                'nombre' => 'EMPRESA TRANSNACIONAL',
                'fechaCreacion' => '1990-01-01',
                'rfc' => 'TAFS567800SWER'
            ],
	    ]);

    }
}
