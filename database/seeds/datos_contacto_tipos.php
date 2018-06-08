<?php

use Illuminate\Database\Seeder;

class datos_contacto_tipos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('datos_contacto_tipos')->insert([
            ['sub'=>'red','tipo'=>'Linkedin'],
            ['sub'=>'red','tipo'=>'Facebook'],
            ['sub'=>'red','tipo'=>'Twitter'],
            ['sub'=>'telefono','tipo'=>'Casa'],
            ['sub'=>'telefono','tipo'=>'Trabajo'],
            ['sub'=>'telefono','tipo'=>'Movil'],
            ['sub'=>'telefono','tipo'=>'Fax'],
            ['sub'=>'correo','tipo'=>'Personal'],
            ['sub'=>'correo','tipo'=>'Laboral']
        ]);
    }
}
