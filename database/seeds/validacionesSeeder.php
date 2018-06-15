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
        DB::table('validaciones')->insert([
            [
                "sistema"=>"uat",
                "tipo"=>"autoridad",
                "validaciones"=>'{
                    "nombres": "required",
                    "primerAp": "",
                    "segundoAp": "",
                    "telefono":"numeric",
                    "fechaNacimiento": "required",
                    "idEstadoOrigen": "required",
                    "idMunicipioOrigen": "required",
                    "sexo": "required",
                    "curp": "length:18",
                    "rfc": "length:10",
                    "homo": "length:3",
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
                    "telefono":"numeric",
                    "fechaNacimiento": "required",
                    "idEstadoOrigen": "required",
                    "idMunicipioOrigen": "required",
                    "sexo": "required",
                    "curp": "length:18",
                    "rfc": "length:10",
                    "homo": "length:3",
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
                    "telefono":"numeric",
                    "fechaNacimiento": "required",
                    "idEstadoOrigen": "required",
                    "idMunicipioOrigen": "required",
                    "sexo": "required",
                    "curp": "length:18",
                    "rfc": "length:10",
                    "homo": "length:3",
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
                    "telefono":"numeric",
                    "fechaNacimiento": "required",
                    "idEstadoOrigen": "required",
                    "idMunicipioOrigen": "required",
                    "sexo": "required",
                    "curp": "length:18",
                    "rfc": "length:10",
                    "homo": "length:3",
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
            ],
            [
                "sistema"=>"uat",
                "tipo"=>"denunciantemoral",
                "validaciones"=>'{
                    "nombres": "required",
                    "fecha_alta": "required",
                    "rfc": "required",
                    "homo": "required",
                    "representante_legal": "required"
               }'
            ],
            [
                "sistema"=>"uat",
                "tipo"=>"denunciadomoral",
                "validaciones"=>'{
                    "nombres": "required",
                    "fecha_alta": "required",
                    "rfc": "required",
                    "homo": "required",
                    "representante_legal": "required"
               }'
            ]
        ]);
    }
}
