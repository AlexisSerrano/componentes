<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ligadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ligados')->insert([
            ["idcomponente"=>1,"idsistema"=>1,"idinvolucrado"=>1,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false,'.
                    '"number":true'.
                    '"number":true'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true,'.
                    '"phone":true'.
                    '"phone":true'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false,'.
                    '"phone":true'.
                    '"phone":true'.
                '}}'.
            '}'],
            ["idcomponente"=>1,"idsistema"=>1,"idinvolucrado"=>4,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false'.
                    '"number":true'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true'.
                    '"phone":true'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false'.
                    '"phone":true'.
                '}}'.
            '}'],
            ["idcomponente"=>1,"idsistema"=>1,"idinvolucrado"=>5,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"sexo":{"rules":{'.
                    '"required":true,'.
                '}},'.
                '"edad":{"rules":{'.
                    '"required":false'.
                    '"number":true'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true'.
                    '"phone":true'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false'.
                    '"phone":true'.
                '}}'.
            '}'],
            ["idcomponente"=>1,"idsistema"=>1,"idinvolucrado"=>6,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false'.
                    '"number":true'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true'.
                    '"phone":true'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false'.
                    '"phone":true'.
                '}}'.
            '}'],
            ["idcomponente"=>1,"idsistema"=>1,"idinvolucrado"=>7,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true'.
                    '"phone":true'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"edad":{"rules":{'.
                    '"required":false'.
                    '"number":true'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false'.
                    '"phone":true'.
                '}}'.
            '}'],
            ["idcomponente"=>1,"idsistema"=>2,"idinvolucrado"=>8,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false'.
                    '"number":true'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true'.
                    '"phone":true'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false'.
                    '"phone":true'.
                '}}'.
            '}'],
            ["idcomponente"=>1,"idsistema"=>2,"idinvolucrado"=>9,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false'.
                    '"number":true'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true'.
                    '"phone":true'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false'.
                    '"phone":true'.
                '}}'.
            '}'],
            ["idcomponente"=>1,"idsistema"=>2,"idinvolucrado"=>12,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false'.
                    '"number":true'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true'.
                    '"phone":true'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false'.
                    '"phone":true'.
                '}}'.
            '}'],
            ["idcomponente"=>1,"idsistema"=>2,"idinvolucrado"=>7,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":false,'.
                    '"curp":false'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false'.
                    '"number":true'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"sexo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true'.
                    '"phone":true'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false'.
                    '"phone":true'.
                '}}'.
            '}'
            ],
            ["idcomponente"=>1,"idsistema"=>2,"idinvolucrado"=>5,"config"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"segundoAp":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '}},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '}},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":false,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"sexo":{"rules":{'.
                    '"required":true,'.
                '}},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefono":{"rules":{'.
                    '"required":true'.
                    '"phone":true'.
                '}},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idOcupacion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idReligion":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '}},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"edad":{"rules":{'.
                    '"required":false'.
                    '"number":true'.
                '}},'.
                '"alias":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"lugarTrabajo":{"rules":{'.
                    '"required":false'.
                '}},'.
                '"telefonoTrabajo":{"rules":{'.
                    '"required":false'.
                    '"phone":true'.
                '}}'.
            '}'],
        ]);
    }
}
