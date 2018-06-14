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
                'idNacionalidad' => 132,
                'idEtnia' => 13,
                'idLengua' => 69,
                'idMunicipioOrigen' => 2496
            ]
	    ]);
    }
}