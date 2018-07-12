<?php

use Illuminate\Database\Seeder;

class denuncianteFisicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('extra_denunciante_fisico')->insert([
            [ 
            'id' => 1, 
            'idVariablesPersona' => 2,            
            'idAbogado' => 1,
            'resguardarIdentidad' => 2,             
            'victima'=> 1
            ]
        ]);
    }
}
