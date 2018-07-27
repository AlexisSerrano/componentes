<?php

use Illuminate\Database\Seeder;

class PersonaFisicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persona_fisica')->insert([
            [ 
                'id' => 1, 
                'nombres' => 'QUIEN RESULTE RESPONSABLE',
                'primerAp' => '',
                'segundoAp' => '',
                'fechaNacimiento' => '1900-01-01',
                'rfc' => '',
                'curp' => '',
                'sexo' => 3,
                'idNacionalidad' => 132,
                'idEtnia' => 13,
                'idLengua' => 69,
                'idMunicipioOrigen' => 2496
            ],
            [ 
                'id' => 2, 
                'nombres' => 'JUAN ALBERTO',
                'primerAp' => 'BARRERA',
                'segundoAp' => 'GARCÍA',
                'fechaNacimiento' => '1980-01-01',
                'rfc' => 'BAGJ800101UA1',
                'curp' => 'BAGJ800101HVZRRN02',
                'sexo' => 1,
                'idNacionalidad' => 1,
                'idEtnia' => 1,
                'idLengua' => 7,
                'idMunicipioOrigen' => 8
            ],
            [ 
                'id' => 3, 
                'nombres' => 'PEDRO',
                'primerAp' => 'GONZÁLES',
                'segundoAp' => 'ALVARADO',
                'fechaNacimiento' => '1980-01-01',
                'rfc' => 'GOAP800101UI0',
                'curp' => 'GOAP800101HVZNLD01',
                'sexo' => 1,
                'idNacionalidad' => 1,
                'idEtnia' => 1,
                'idLengua' => 7,
                'idMunicipioOrigen' => 8
            ],
            [ 
                'id' => 4, 
                'nombres' => 'SUSANA',
                'primerAp' => 'ANDRADE',
                'segundoAp' => 'MORA',
                'fechaNacimiento' => '1980-01-01',
                'rfc' => 'AAMS800101DX8',
                'sexo' => 2,
                'curp' => 'AAMS800101HVZNRS01',
                'idNacionalidad' => 1,
                'idEtnia' => 1,
                'idLengua' => 7,
                'idMunicipioOrigen' => 8
            ],
            [ 
                'id' => 5, 
                'nombres' => 'ADRIAN',
                'primerAp' => 'GUEVARA',
                'segundoAp' => 'QUIJANO',
                'fechaNacimiento' => '1980-01-01',
                'rfc' => 'JORF450926H',
                'sexo' => 1,
                'curp' => 'JORF450926HSWITM95',
                'idNacionalidad' => 1,
                'idEtnia' => 1,
                'idLengua' => 7,
                'idMunicipioOrigen' => 8
            ]
	    ]);
    }
}