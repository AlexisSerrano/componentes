<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class validacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1,1,4  = Victima u ofendido (UIPJ)           1,2,4  = Victima u ofendico (UAT)
        //1,1,10 = comparecencia COMPLETO (UIPJ)       1,2,1 = coparecencia COMPLETO (UAT)
        //1,1,11 = conocido PARCIAL (UIPJ)             1,2,2 = conocido PARCIAL (UAT)
        //1,1,12 = QRR NULL (UIPJ)                     1,2,3 = QRR NULL (UAT)
        DB::table('validaciones')->insert([
            //VICTIMA U OFENDIDO UIPJ
            ["sistema"=>1,"tipo"=>4,"validaciones"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '},"default":"WILBERT"},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '},"default":"BURGOS"},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '},"default":"MORALES"},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '},"default":"BUMW9503306M6"},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '},"default":"BUMW950330HVZRRL03"},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false,'.
                    '"number":true'.
                '},"default":23},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":30},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '},"default":87},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '},"default":70},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '},"default":"TRABAJO"},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '},"default":2300},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '},"default":8},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '},"default":1234567890},'.
                '"alias":{"rules":{'.
                    '"required":false'.
                '},"default":"WIL"},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '},"default":1}'.
            '}'],
            //COMPARECENCIA UIPJ
            ["idsistema"=>1,"idinvolucrado"=>10,"validaciones"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '},"default":"WILBERT"},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '},"default":"BURGOS"},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '},"default":"MORALES"},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '},"default":"BUMW9503306M6"},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '},"default":"BUMW950330HVZRRL03"},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false,'.
                    '"number":true'.
                '},"default":23},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":30},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '},"default":87},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '},"default":3},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '},"default":70},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '},"default":"TRABAJO"},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '},"default":2300},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '},"default":8},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '},"default":1234567890},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '},"default":"MUÑECO"},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '},"default":1}'.
            '}'],
            //CONOCIDO UIPJ
            ["idsistema"=>1,"idinvolucrado"=>11,"validaciones"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '},"default":"WILBERT"},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '},"default":"BURGOS"},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '},"default":"MORALES"},'.
                '"rfc":{"rules":{'.
                    '"required":false,'.
                    '"rfc":true'.
                '},"default":"BUMW9503306M6"},'.
                '"curp":{"rules":{'.
                    '"required":false,'.
                    '"curp":true'.
                '},"default":"BUMW950330HVZRRL03"},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":false,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false,'.
                    '"number":true'.
                '},"default":23},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":30},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":87},'.
                '"sexo":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '},"default":70},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":false'.
                '},"default":"TRABAJO"},'.
                '"idOcupacion":{"rules":{'.
                    '"required":false'.
                '},"default":2300},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idReligion":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":false'.
                '},"default":8},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":false'.
                '},"default":1234567890},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '},"default":"WIL"},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '},"default":1}'.
            '}'],
            //QRR UIPJ
            ["idsistema"=>1,"idinvolucrado"=>12,"validaciones"=>
            '{'.
                '"nombres":{"default":"QUIEN RESULTE RESPONSABLE","rules":{'.
                    '"required":false'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":false'.
                '},"default":"BURGOS"},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '},"default":"MORALES"},'.
                '"rfc":{"rules":{'.
                    '"required":false,'.
                    '"rfc":true'.
                '},"default":"BUMW9503306M6"},'.
                '"curp":{"rules":{'.
                    '"required":false,'.
                    '"curp":true'.
                '},"default":"BUMW950330HVZRRL03"},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":false,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false,'.
                    '"number":true'.
                '},"default":23},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":30},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":87},'.
                '"sexo":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '},"default":70},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":false'.
                '},"default":"TRABAJO"},'.
                '"idOcupacion":{"rules":{'.
                    '"required":false'.
                '},"default":2300},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idReligion":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":false'.
                '},"default":8},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":false'.
                '},"default":1234567890},'.
                '"alias":{"rules":{'.
                    '"required":false'.
                '},"default":"WIL"},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '},"default":1}'.
            '}'],
            //VICTIMA U OFENDIDO UAT
            ["idsistema"=>2,"idinvolucrado"=>4,"validaciones"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '},"default":"WILBERT"},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '},"default":"BURGOS"},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '},"default":"MORALES"},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '},"default":"BUMW9503306M6"},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '},"default":"BUMW950330HVZRRL03"},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false,'.
                    '"number":true'.
                '},"default":23},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":30},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '},"default":87},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '},"default":70},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '},"default":"TRABAJO"},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '},"default":2300},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '},"default":8},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '},"default":1234567890},'.
                '"alias":{"rules":{'.
                    '"required":false'.
                '},"default":"WIL"},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '},"default":1}'.
            '}'],
            //COMPARECENCIA UAT
            ["idsistema"=>2,"idinvolucrado"=>1,"validaciones"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '},"default":"WILBERT"},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '},"default":"BURGOS"},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '},"default":"MORALES"},'.
                '"rfc":{"rules":{'.
                    '"required":true,'.
                    '"rfc":true'.
                '},"default":"BUMW9503306M6"},'.
                '"curp":{"rules":{'.
                    '"required":true,'.
                    '"curp":true'.
                '},"default":"BUMW950330HVZRRL03"},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":true,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false,'.
                    '"number":true'.
                '},"default":23},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":30},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":true'.
                '},"default":87},'.
                '"sexo":{"rules":{'.
                    '"required":true'.
                '},"default":3},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '},"default":70},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":true'.
                '},"default":"TRABAJO"},'.
                '"idOcupacion":{"rules":{'.
                    '"required":true'.
                '},"default":2300},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idReligion":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":true'.
                '},"default":8},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":true'.
                '},"default":1},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":true'.
                '},"default":1234567890},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '},"default":"MUÑECO"},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '},"default":1}'.
            '}'],
            //CONOCIDO UAT
            ["idsistema"=>2,"idinvolucrado"=>2,"validaciones"=>
            '{'.
                '"nombres":{"rules":{'.
                    '"required":true'.
                '},"default":"WILBERT"},'.
                '"primerAp":{"rules":{'.
                    '"required":true'.
                '},"default":"BURGOS"},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '},"default":"MORALES"},'.
                '"rfc":{"rules":{'.
                    '"required":false,'.
                    '"rfc":true'.
                '},"default":"BUMW9503306M6"},'.
                '"curp":{"rules":{'.
                    '"required":false,'.
                    '"curp":true'.
                '},"default":"BUMW950330HVZRRL03"},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":false,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false,'.
                    '"number":true'.
                '},"default":23},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":30},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":87},'.
                '"sexo":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '},"default":70},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":false'.
                '},"default":"TRABAJO"},'.
                '"idOcupacion":{"rules":{'.
                    '"required":false'.
                '},"default":2300},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idReligion":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":false'.
                '},"default":8},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":false'.
                '},"default":1234567890},'.
                '"alias":{"rules":{'.
                    '"required":true'.
                '},"default":"WIL"},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '},"default":1}'.
            '}'],
            //QRR UAT
            ["idsistema"=>2,"idinvolucrado"=>3,"validaciones"=>
            '{'.
                '"nombres":{"default":"QUIEN RESULTE RESPONSABLE","rules":{'.
                    '"required":false'.
                '}},'.
                '"primerAp":{"rules":{'.
                    '"required":false'.
                '},"default":"BURGOS"},'.
                '"segundoAp":{"rules":{'.
                    '"required":false'.
                '},"default":"MORALES"},'.
                '"rfc":{"rules":{'.
                    '"required":false,'.
                    '"rfc":true'.
                '},"default":"BUMW9503306M6"},'.
                '"curp":{"rules":{'.
                    '"required":false,'.
                    '"curp":true'.
                '},"default":"BUMW950330HVZRRL03"},'.
                '"fechaNacimiento":{"rules":{'.
                    '"required":false,'.
                    '"date":true'.
                '},"default":"1990-01-01"},'.
                '"edad":{"rules":{'.
                    '"required":false,'.
                    '"number":true'.
                '},"default":23},'.
                '"idNacionalidad":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEdoOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":30},'.
                '"idMunicipioOrigen":{"rules":{'.
                    '"required":false'.
                '},"default":87},'.
                '"sexo":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEtnia":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idLengua":{"rules":{'.
                    '"required":false'.
                '},"default":70},'.
                '"motivoEstancia":{"rules":{'.
                    '"required":false'.
                '},"default":"TRABAJO"},'.
                '"idOcupacion":{"rules":{'.
                    '"required":false'.
                '},"default":2300},'.
                '"idEstadoCivil":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idReligion":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"idEscolaridad":{"rules":{'.
                    '"required":false'.
                '},"default":8},'.
                '"docIdentificacion":{"rules":{'.
                    '"required":false'.
                '},"default":1},'.
                '"numDocIdentificacion":{"rules":{'.
                    '"required":false'.
                '},"default":1234567890},'.
                '"alias":{"rules":{'.
                    '"required":false'.
                '},"default":"WIL"},'.
                '"idInterprete":{"rules":{'.
                    '"required":false'.
                '},"default":1}'.
            '}'],
        ]);
    }
}