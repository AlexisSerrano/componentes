<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //[ 'id' => 1, 'nombre' => 'uat','descripcion' => 'sistema uat','api_token' => str_random(60),'activo' => 1],
            [ 
                'id' => 1, 
                'nombre' => 'uat',
                'descripcion' => 'sistema uat',
                'api_token' => 'w37JtBFJQLbu4ADSsoMHphddWAPneAcwZyZmXpauaAHGHNMvPTvluyQOWnBl',
                'activo' => 1
            ],
            [ '
                id' => 2, 
                'nombre' => 'uipj',
                'descripcion' => 'sistema uipj',
                'api_token' => 'NbjzQOmydIOJle5gjNsGj3ELVHuTHgQMsYJAczeQ0OnbO96vpTPtuybKYae3',
                'activo' => 1
            ],
            [ 
                'id' => 3, 
                'nombre' => 'comp',
                'descripcion' => 'componente',
                'api_token' => 'QK8aWfrWQh5iaZsxxJiLCsIVlJp9zokMMgGMhs2HwAcv1JxnEYYKh5lFfI8K',
                'activo' => 1
            ]            
	    ]);
    }
}
