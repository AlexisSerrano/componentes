<?php

use Illuminate\Database\Seeder;

class denunciadoFisicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('extra_denunciado_fisico')->insert([
            [ 
            'id' => 1, 
            'idVariablesPersona' => 2,
            'idPuesto' => 8,
            'senasPartic' => 'Estatura 1.64',
            'ingreso' => 124,
            'periodoIngreso' => 'FEBRERO-AGOSTO 2018',
            'residenciaAnterior' => 'PUEBLA, VERACRUZ',
            'idAbogado' => 1,
            'personasBajoSuGuarda' => 5,
            'perseguidoPenalmente' => 0,
            'vestimenta' => 'ROPA SPORT',
            ]
        ]);
    }
}
