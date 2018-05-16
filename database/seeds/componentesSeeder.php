<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class componentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('componentes')->insert([
            ['id'=>1,'nombre'=>'Persona','descripcion'=>'Componente que registra los datos generales de una persona'],
            ['id'=>2,'nombre'=>'Domicilio','descripcion'=>'Componente que registra los datos correspondientes a un domicilio'],
            ['id'=>3,'nombre'=>'Codigo QR','descripcion'=>'Componente utilizado para generar códigos QR'],
            ['id'=>4,'nombre'=>'DataTable','descripcion'=>'Componente que recupera datos de una DB para posteriormente presentarlos en una tabla'],
            ['id'=>5,'nombre'=>'OpenStreetMap','descripcion'=>'Componente para mostrar mapas interactivos mediante un OpenLayer'],
        ]);
    }
}
