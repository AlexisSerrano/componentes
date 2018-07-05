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
                'edad' => 12,
                'telefono' => '2255874958',
                'motivoEstancia' => '',
                'idOcupacion' => 2941,
                'idEstadoCivil' => 7,
                'idEscolaridad' => 14,
                'idReligion' => 29,
                'idDomicilio' => 1,
                'docIdentificacion' => 14,
                'idInterprete' => 0,
                'numDocIdentificacion' => '',
                'idTrabajo' => 1,
                'idNotificacion' => 1
            ],
            [ 
                'id' => 2, 
                'idPersona' => 2,
                'edad' => 38,
                'telefono' => '5544789568',
                'motivoEstancia' => 'DENUNCIA CIUDADANA',
                'idOcupacion' => 12,
                'idEstadoCivil' => 2,
                'idEscolaridad' => 6,
                'idReligion' => 3,
                'idDomicilio' => 1,
                'docIdentificacion' => 11,
                'idInterprete' => 1,
                'numDocIdentificacion' => 'SDHJ45GH',
                'idTrabajo' => 1,
                'idNotificacion' => 1
            ],
            [ 
                'id' => 3, 
                'idPersona' => 3,
                'edad' => 38,
                'telefono' => '8844751469',
                'motivoEstancia' => 'TRAMITE DE CONSTANCIA',
                'idOcupacion' => 12,
                'idEstadoCivil' => 2,
                'idEscolaridad' => 6,
                'idReligion' => 3,
                'idDomicilio' => 1,
                'docIdentificacion' => 11,
                'idInterprete' => 1,
                'numDocIdentificacion' => 'SDHJ45GH',
                'idTrabajo' => 1,
                'idNotificacion' => 1
            ],
            [ 
                'id' => 4, 
                'idPersona' => 4,
                'edad' => 38,
                'telefono' => '8844751258',
                'motivoEstancia' => 'DENUNCIA CIUDADANA',
                'idOcupacion' => 12,
                'idEstadoCivil' => 2,
                'idEscolaridad' => 6,
                'idReligion' => 3,
                'idDomicilio' => 1,
                'docIdentificacion' => 11,
                'idInterprete' => 1,
                'numDocIdentificacion' => '4589SDFJKER',
                'idTrabajo' => 1,
                'idNotificacion' => 1
            ]
	    ]);
    }
}