<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewPersonaCompletaActual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //DB::statement('create OR REPLACE view persona_completa_actual as select * from variables_persona vp1 inner join vpersona_actual vp2 on vp1.id=vp2.id inner join personas p  on  p.id = vp1.idPersona;');
        DB::statement('create OR REPLACE view persona_completa_actual as SELECT var.updated_at, per.nombres, per.primerAp,per.segundoAp,var.alias,per.fechaNacimiento,per.sexo,per.rfc,per.curp,per.idNacionalidad,nac.nombre nacionalidad,per.idEtnia,et.nombre etnia,
        per.idLengua, len.nombre lengua, edo.id idEstadoOrigen,edo.nombre estadoOrigen,per.idMunicipioOrigen, mun.nombre municipioOrigen,
        var.id idvar_persona,edad,telefono,motivoEstancia,idOcupacion,ocu.nombre ocupacion, idEstadoCivil,civ.nombre estadoCivil,idEscolaridad,esc.nombre escolaridad,
        idReligion, rel.nombre religion,idDomicilio,docIdentificacion,numDocIdentificacion,idInterprete,inte.nombre interprete, lugarTrabajo,idDomicilioTrabajo,telefonoTrabajo,representanteLegal
        FROM variables_persona var 
        left join personas per on var.idPersona=per.id
        left join cat_ocupacion ocu on var.idOcupacion=ocu.id
        left join cat_estado_civil civ on civ.id=var.idEstadoCivil
        left join cat_escolaridad esc on esc.id=var.idEscolaridad
        left join cat_religion rel on rel.id=var.idReligion
        left join cat_interprete inte on inte.id=var.idInterprete
        left join cat_nacionalidad nac on nac.id=per.idNacionalidad
        left join cat_etnia et on et.id=per.idEtnia
        left join cat_lengua len on len.id=per.idLengua
        left join cat_municipio mun on mun.id=per.idMunicipioOrigen
        left join cat_estado edo on edo.id=mun.idEstado
        inner join vpersona_actual vp2 on var.id=vp2.id
         ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
