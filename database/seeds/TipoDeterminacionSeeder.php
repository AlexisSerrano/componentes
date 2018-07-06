<?php

use Illuminate\Database\Seeder;

class TipoDeterminacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_tipo_determinacion')->insert([
            [ 'id' => 1, 'nombre' => 'INICIADA'],
            [ 'id' => 2, 'nombre' => 'ABSTENCION DE INVESTIGAR'],
            [ 'id' => 3, 'nombre' => 'ARCHIVO TEMPORAL'],
            [ 'id' => 4, 'nombre' => 'LA APLICACION DE UN CRITERIO DE OPORTUNIDAD'],
            [ 'id' => 5, 'nombre' => 'NO EJERCICIO DE LA ACCION PENAL'],
            [ 'id' => 6, 'nombre' => 'POR DETERMINAR'],
            [ 'id' => 7, 'nombre' => 'EJERCICIO DE LA ACCION PENAL']
	    ]);
    }
}
