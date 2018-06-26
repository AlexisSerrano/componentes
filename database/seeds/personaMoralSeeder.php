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
                'nombre' => 'Gente & Asociados',
                'fechaCreacion' => '1900-01-01',
                'rfc' => 'ROTF250715225'
            ]
	    ]);

    }
}
