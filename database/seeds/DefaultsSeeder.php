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
                'correo' => '',
                'telefono' => 'SIN INFORMACIÓN'
            ]
        ]);

        DB::table('persona_fisica')->insert([
            [ 
                'id' => 2,
                'nombres' => 'NOMBRE_001',
                'primerAp' => 'PRIMER_APELLIDO_001',
                'segundoAp' => 'SEGUNDO_APELLIDO_001',
                'fechaNacimiento' => '1900-01-01',
                'rfc' => 'FORT740247H228',
                'curp' => 'FORT740247HEZPMR95',
                'sexo' => 1,
                'idNacionalidad' => 132,
                'idEtnia' => 13,
                'idLengua' => 69,
                'idMunicipioOrigen' => 2496
            ]
        ]);

    }
}
