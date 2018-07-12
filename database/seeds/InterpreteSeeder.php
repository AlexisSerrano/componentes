<?php

use Illuminate\Database\Seeder;

class InterpreteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_interprete')->insert([
            ['id'=>  1,'nombre' => 'SIN INFORMACION','dependencia' => 'SIN INFORMACION']
        ]);
    }
}
