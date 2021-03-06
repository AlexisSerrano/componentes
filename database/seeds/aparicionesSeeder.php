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
                'idCarpeta'=>'1',
                'carpeta' => 'UIPJ/D17/VER1/22/1/2018',
                'sistema' => 'UAT',
                'tipoInvolucrado' => 'ABOGADO',
                'nuc' => 'AZ09-1A2B3C-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 1,
                'activo' => 1
            ],
            [
                'id' => 2,
                'idVarPersona' => 3,
                'idCarpeta'=>'1',
                'carpeta' => 'UIPJ/D17/VER1/22/1/2018',
                'sistema' => 'UAT',
                'tipoInvolucrado' => 'ABOGADO',
                'nuc' => 'OA03-3Z6H3Q-19',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 2,
                'activo' => 1
            ],
            [
                'id' => 3,
                'idVarPersona' => 4,
                'idCarpeta'=>'3',
                'carpeta' => 'UIPJ/D64/VER78/12/7/2018',
                'sistema' => 'UAT',
                'tipoInvolucrado' => 'AUTORIDAD',
                'nuc' => '8SH4-76RHX5-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 3,
                'activo' => 1
            ],
            
            [
                'id' => 4,
                'idVarPersona' => 2,
                'idCarpeta'=>'4',
                'carpeta' => 'UIPJ/F49/VER79/05/08/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'ABOGADO',
                'nuc' => '78DH-J48ASY-19',
                'esEmpresa' => 1,
                'idTipoDeterminacion' => 2,
                'activo' => 1
            ],                     
            [
                'id' => 6,
                'idVarPersona' => 2,
                'idCarpeta'=>'5',
                'carpeta' => 'UIPJ/D74/VER3/07/09/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIANTE',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 2,
                'activo' => 1
            ],
            [
                'id' => 7,
                'idVarPersona' => 2,
                'idCarpeta'=>'6',
                'carpeta' => 'UIPJ/D34/VER1/18/01/2019',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 3,
                'activo' => 1
            ],
            [
                'id' => 8,
                'idVarPersona' => 2,
                'idCarpeta'=>'7',
                'carpeta' => 'UIPJ/T78/VER4/22/08/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'AUTORIDAD',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 4,
                'activo' => 1
            ],
            [
                'id' => 9,
                'idVarPersona' => 2,
                'idCarpeta'=>'8',
                'carpeta' => 'UIPJ/T78/VER4/21/02/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 5,
                'activo' => 1
            ],
            [
                'id' => 10,
                'idVarPersona' => 2,
                'idCarpeta'=>'9',
                'carpeta' => 'UIPJ/T48/VER4/01/08/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIANTE',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 6,
                'activo' => 1
            ],

            [
                'id' => 11,
                'idVarPersona' => 2,
                'idCarpeta'=>'10',
                'carpeta' => 'UIPJ/T84/VER17/08/29/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 0,
                'idTipoDeterminacion' => 7,
                'activo' => 1
            ],
            [
                'id' => 12,
                'idVarPersona' => 2,
                'idCarpeta'=>'11',
                'carpeta' => 'UIPJ/T80/VER19/12/09/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => 'OS84-4Q8G3D-18',
                'esEmpresa' => 1,
                'idTipoDeterminacion' => 3,
                'activo' => 1
            ],
            [
                'id' => 13,
                'idVarPersona' => 2,
                'idCarpeta'=>'12',
                'carpeta' => 'UIPJ/Y80/VER18/11/15/2018',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'CONOCIDO',
                'nuc' => 'OS84-4Q84SD-18',
                'esEmpresa' => 1,
                'idTipoDeterminacion' => 4,
                'activo' => 1
            ],
            [
                'id' => 14,
                'idVarPersona' => 2,
                'idCarpeta'=>'13',
                'carpeta' => 'UIPJ/P80/ACT18/10/19/2017',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIANTE',
                'nuc' => 'OS84-4Q84SD-18',
                'esEmpresa' => 1,
                'idTipoDeterminacion' => 5,
                'activo' => 1
            ],
            [
                'id' => 15,
                'idVarPersona' => 2,
                'idCarpeta'=>'14',
                'carpeta' => 'UIPJ/P18/XAL18/04/07/2019',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => 'OS84-4Q84SD-18',
                'esEmpresa' => 1,
                'idTipoDeterminacion' => 6,
                'activo' => 1
            ],
            [
                'id' => 16,
                'idVarPersona' => 2,
                'idCarpeta'=>'15',
                'carpeta' => 'UIPJ/E18/VER18/09/17/2017',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'CONOCIDO',
                'nuc' => 'OS84-4Q84SD-18',
                'esEmpresa' => 1,
                'idTipoDeterminacion' => 7,
                'activo' => 1
            ],
            [
                'id' => 17,
                'idVarPersona' => 2,
                'idCarpeta'=>'16',
                'carpeta' => 'UIPJ/F09/TUX47/11/29/2017',
                'sistema' => 'UIPJ',
                'tipoInvolucrado' => 'DENUNCIADO',
                'nuc' => '78DH-J48ASY-19',
                'esEmpresa' => 1,
                'idTipoDeterminacion' => 1,
                'activo' => 1
            ]
            
        ]);
    }
}
