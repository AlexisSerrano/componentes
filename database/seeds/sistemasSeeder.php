<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class sistemasSeeder extends Seeder
{
    public function run()
    {
        DB::table('sistemas')->insert([
            ['id'=>1,'nombre'=>'UIPJ','descripcion'=>'Unidad de investigación de la procuraduria'],
            ['id'=>2,'nombre'=>'UAT(Unidad de Atención temprana)','descripcion'=>'Sistema orientado a atender de forma temprana las denuncias de las personas'],
            ['id'=>3,'nombre'=>'VRR(Vehículos Robados y Recuperados)','descripcion'=>'Sistema enfocado a atender asuntos con vehículos '],
            ['id'=>4,'nombre'=>'Periciales','descripcion'=>'Ssitema periciales'],
            ['id'=>5,'nombre'=>'Desaparecidos','descripcion'=>'Sistema orientado a las personas que se encuentran en paradero desconocido']
        ]);
    }
}
