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
            ['sub'=>'red','tipo'=>'linkedin'],
            ['sub'=>'red','tipo'=>'facebook'],
            ['sub'=>'red','tipo'=>'twitrer'],
            ['sub'=>'telefono','tipo'=>'casa'],
            ['sub'=>'telefono','tipo'=>'trabajo'],
            ['sub'=>'telefono','tipo'=>'mobil'],
            ['sub'=>'telefono','tipo'=>'fax'],
            ['sub'=>'correo','tipo'=>'personal'],
            ['sub'=>'correo','tipo'=>'laboral']
        ]);
    }
}
