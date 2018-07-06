<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
//      $this->call(UsersTableSeeder::class);
        $this->call(SexosSeeder::class);

        $this->call(EstadoSeeder::class);
        $this->call(MunicipioSeeder::class);
        
        $this->call(LocalidadesChiapasSeeder::class);
        $this->call(LocalidadesCDMXSeeder::class);
        $this->call(LocalidadesHidalgoSeeder::class);
        $this->call(LocalidadesOaxacaSeeder::class);
        $this->call(LocalidadesPueblaSeeder::class);
        $this->call(LocalidadesSanLuisPotosiSeeder::class);
        $this->call(LocalidadesTabascoSeeder::class);
        $this->call(LocalidadesTamaulipasSeeder::class);
        $this->call(LocalidadesVeracruzSeeder::class);
        // $this->call(LocalidadSeeder::class);
        // $this->call(LocalidadSeeder2::class);

        $this->call(EtniaSeeder::class);        
        $this->call(LenguaSeeder::class);        
        $this->call(NacionalidadSeeder::class);  

        $this->call(ColoniasHidalgoSeeder::class);
        $this->call(ColoniasOaxacaSeeder::class);
        $this->call(ColoniasPueblaSeeder::class);
        $this->call(ColoniasSanLuisPotosiSeeder::class);
        $this->call(ColoniasTabascoSeeder::class);
        $this->call(ColoniasTamaulipasSeeder::class);
        $this->call(ColoniasVeracruzSeeder::class);
        $this->call(ColoniasCDMXSeeder::class); 
        $this->call(ColoniasChiapasSeeder::class);

        $this->call(OcupacionSeeder::class); 
        $this->call(EstadoCivilSeeder::class); 
        $this->call(EscolaridadSeeder::class); 
        $this->call(ReligionSeeder::class); 
        
        $this->call(IdentificacionSeeder::class);
        
        $this->call(validacionesSeeder::class);

        $this->call(InterpreteSeeder::class);
        $this->call(DefaultsSeeder::class); 
        $this->call(PersonaFisicaSeeder::class);
        $this->call(VariablesPersonaFisicaSeeder::class);

        $this->call(UsersSeeder::class);
        $this->call(TipoDeterminacionSeeder::class);        
        $this->call(extraAbogadoSeeder::class);
        $this->call(personaMoralSeeder::class);
        $this->call(variablesPersonaMoralSeeder::class);
        $this->call(PuestosSeeder::class); 
        $this->call(aparicionesSeeder::class);
        $this->call(denunciadoFisicoSeeder::class);
        $this->call(denuncianteFisicoSeeder::class);
    }
}

