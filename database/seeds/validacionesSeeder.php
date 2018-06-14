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
            [
                "sistema"=>"uat",
                "tipo"=>"autoridad",
                "validaciones"=>'{
                    "nombres": "required",
                    "primerAp": "",
                    "segundoAp": "",
                    "telefono":"",
                    "fechaNacimiento": "required",
                    "idEstadoOrigen": "required",
                    "idMunicipioOrigen": "required",
                    "sexo": "required",
                    "curp": "",
                    "rfc": "",
                    "homo": "",
                    "idNacionalidad": "",
                    "idEtnia": "",
                    "idLengua": "",
                    "idOcupacion": "",
                    "idEstadoCivil": "",
                    "idReligion": "",
                    "idEscolaridad": "",
                    "docIdentificacion": "",
                    "numDocIdentificacion": "",
                    "edad": "oculto",
                    "alias": "oculto",
                    "idInterprete": "oculto",
                    "motivoEstancia": "oculto"
               }'
            ],
            [
                "sistema"=>"uat",
                "tipo"=>"abogado",
                "validaciones"=>'{
                    "nombres": "required",
                    "primerAp": "",
                    "segundoAp": "",
                    "telefono":"",
                    "fechaNacimiento": "required",
                    "idEstadoOrigen": "required",
                    "idMunicipioOrigen": "required",
                    "sexo": "required",
                    "curp": "",
                    "rfc": "",
                    "homo": "",
                    "idNacionalidad": "oculto",
                    "idEtnia": "oculto",
                    "idLengua": "oculto",
                    "idOcupacion": "oculto",
                    "idEstadoCivil": "",
                    "idReligion": "oculto",
                    "idEscolaridad": "oculto",
                    "docIdentificacion": "oculto",
                    "numDocIdentificacion": "oculto",
                    "edad": "oculto",
                    "alias": "oculto",
                    "idInterprete": "oculto",
                    "motivoEstancia": "oculto"
               }'
            ],
            [
                "sistema"=>"uat",
                "tipo"=>"conocido",
                "validaciones"=>'{
                    "nombres": "",
                    "primerAp": "",
                    "segundoAp": "",
                    "telefono":"oculto",
                    "fechaNacimiento": "oculto",
                    "idEstadoOrigen": "oculto",
                    "idMunicipioOrigen": "oculto",
                    "sexo": "oculto",
                    "curp": "oculto",
                    "rfc": "oculto",
                    "homo": "oculto",
                    "idNacionalidad": "oculto",
                    "idEtnia": "oculto",
                    "idLengua": "oculto",
                    "idOcupacion": "oculto",
                    "idEstadoCivil": "oculto",
                    "idReligion": "oculto",
                    "idEscolaridad": "oculto",
                    "docIdentificacion": "oculto",
                    "numDocIdentificacion": "oculto",
                    "edad": "oculto",
                    "alias": "",
                    "idInterprete": "oculto",
                    "motivoEstancia": "oculto"
               }'
            ],
            [
                "sistema"=>"uat",
                "tipo"=>"denunciado",
                "validaciones"=>'{
                    "nombres": "required",
                    "primerAp": "",
                    "segundoAp": "",
                    "telefono":"",
                    "fechaNacimiento": "required",
                    "idEstadoOrigen": "required",
                    "idMunicipioOrigen": "required",
                    "sexo": "required",
                    "curp": "",
                    "rfc": "",
                    "homo": "",
                    "idNacionalidad": "",
                    "idEtnia": "",
                    "idLengua": "",
                    "idOcupacion": "",
                    "idEstadoCivil": "",
                    "idReligion": "",
                    "idEscolaridad": "",
                    "docIdentificacion": "",
                    "numDocIdentificacion": "",
                    "edad": "oculto",
                    "alias": "oculto",
                    "idInterprete": "oculto",
                    "motivoEstancia": "oculto"
               }'
            ],
            [
                "sistema"=>"uat",
                "tipo"=>"denunciante",
                "validaciones"=>'{
                    "nombres": "required",
                    "primerAp": "",
                    "segundoAp": "",
                    "telefono":"",
                    "fechaNacimiento": "required",
                    "idEstadoOrigen": "required",
                    "idMunicipioOrigen": "required",
                    "sexo": "required",
                    "curp": "",
                    "rfc": "",
                    "homo": "",
                    "idNacionalidad": "",
                    "idEtnia": "",
                    "idLengua": "",
                    "idOcupacion": "",
                    "idEstadoCivil": "",
                    "idReligion": "",
                    "idEscolaridad": "",
                    "docIdentificacion": "",
                    "numDocIdentificacion": "",
                    "edad": "oculto",
                    "alias": "oculto",
                    "idInterprete": "oculto",
                    "motivoEstancia": "oculto"
               }'
            ],
            [
                "sistema"=>"uat",
                "tipo"=>"qrr",
                "validaciones"=>'{
                    "nombres": "oculto",
                    "primerAp": "oculto",
                    "segundoAp": "oculto",
                    "telefono":"oculto",
                    "fechaNacimiento": "oculto",
                    "idEstadoOrigen": "oculto",
                    "idMunicipioOrigen": "oculto",
                    "sexo": "oculto",
                    "curp": "oculto",
                    "rfc": "oculto",
                    "homo": "oculto",
                    "idNacionalidad": "oculto",
                    "idEtnia": "oculto",
                    "idLengua": "oculto",
                    "idOcupacion": "oculto",
                    "idEstadoCivil": "oculto",
                    "idReligion": "oculto",
                    "idEscolaridad": "oculto",
                    "docIdentificacion": "oculto",
                    "numDocIdentificacion": "oculto",
                    "edad": "oculto",
                    "alias": "oculto",
                    "idInterprete": "oculto",
                    "motivoEstancia": "oculto"
               }'
            ]
        ]);
    }
}
