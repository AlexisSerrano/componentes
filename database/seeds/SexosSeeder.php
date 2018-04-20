<?php

use Illuminate\Database\Seeder;

class SexosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sexos')->insert([
	        [ 'id' => 1, 'nombre' => 'Hombre'],
	        [ 'id' => 2, 'nombre' => 'Mujer']
	    ]);
    }
}
