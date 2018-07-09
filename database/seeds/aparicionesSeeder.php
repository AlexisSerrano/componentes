<?php

use Illuminate\Database\Seeder;

class aparicionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apariciones')->insert([
            [
                'id' => 1,
                'idVarPersona' => 2,
                'idCarpeta' => 'UIPJ/D17/VER1/22/1/2018',
                'sistema' => 'UAT',
                'tipoInvolucrado' => 'DENUNCIANTE',
                'nuc' => 'AZ09-1A2B3C-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 1
            ],
            [
                'id' => 2,
                'idVarPersona' => 3,
                'idCarpeta' => 'UIPJ/D42/VER0/19/8/2018',
                'sistema' => 'UAT',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => 'OA03-3Z6H3Q-19',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 2
            ],
            [
                'id' => 3,
                'idVarPersona' => 4,
                'idCarpeta' => 'UIPJ/D64/VER78/12/7/2018',
                'sistema' => 'UAT',
                'tipoInvolucrado' => 'AUTORIDAD',
                'nuc' => '8SH4-76RHX5-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 3
            ],
            
            [
                'id' => 4,
                'idVarPersona' => 2,
                'idCarpeta' => 'UIPJ/F49/VER79/05/08/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'CONOCIDO',
                'nuc' => '78DH-J48ASY-19',
                'esEmpresa' => 1,
                'idTipoDeterminacion' => 4
            ],
           
            [
                'id' => 5,
                'idVarPersona' => 3,
                'idCarpeta' => 'UIPJ/D70/VER1/01/07/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'CONOCIDO',
                'nuc' => '78DH-J48ASY-19',
                'esEmpresa' => 1,
                'idTipoDeterminacion' => 5
            ],
            [
                'id' => 6,
                'idVarPersona' => 2,
                'idCarpeta' => 'UIPJ/D74/VER3/07/09/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIANTE',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 2
            ],
            [
                'id' => 7,
                'idVarPersona' => 2,
                'idCarpeta' => 'UIPJ/D34/VER1/18/01/2019',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 3
            ],
            [
                'id' => 8,
                'idVarPersona' => 2,
                'idCarpeta' => 'UIPJ/T78/VER4/22/08/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'AUTORIDAD',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 4
            ],
            [
                'id' => 9,
                'idVarPersona' => 2,
                'idCarpeta' => 'UIPJ/T78/VER4/21/02/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 5
            ],
            [
                'id' => 10,
                'idVarPersona' => 2,
                'idCarpeta' => 'UIPJ/T48/VER4/01/08/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIANTE',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 6
            ],

            [
                'id' => 11,
                'idVarPersona' => 2,
                'idCarpeta' => 'UIPJ/T84/VER17/08/29/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 7
            ],
            
            
        ]);
    }
}
