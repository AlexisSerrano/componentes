<?php

use Illuminate\Database\Seeder;

class VariablesPersonaFisicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variables_persona_fisica')->insert([
            [ 
                'id' => 1, 
                'idPersona' => 1,
                'edad' => '1',
                'telefono' => '',
                'motivoEstancia' => '',
                'idOcupacion' => 2941,
                'idEstadoCivil' => 7,
                'idEscolaridad' => 14,
                'idReligion' => 29,
                'idDomicilio' => 0,
                'docIdentificacion' => '',
                'idInterprete' => 0,
                'numDocIdentificacion' => '',
                'idDomicilioTrabajo' => 0,
                'alias' => ''
            ]
	    ]);
    }
}