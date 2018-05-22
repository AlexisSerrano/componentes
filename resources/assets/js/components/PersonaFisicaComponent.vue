<template>
    <div class="container">
        <!-- <div class="form-row align-items-end" v-if="mostrarForm">
            <div class="form-group col-md-4">
                <h5 id="pruebavue">{{personaExiste!=''?personaExiste.nombres+" "+personaExiste.primerAp+" "+personaExiste.segundoAp:''}}</h5>
            </div>
        </div> -->
        <form v-on:submit.prevent="validateBeforeSubmit" v-if="mostrarForm">
            <div class="form-row" v-if="tipo ==2 || tipo==3 || tipo==4 || tipo==10 || tipo==11 || tipo==12">
                <div class="form-group col-md-6">
                    <div class="form-check" style="padding: 0">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="comparecencia" style="padding-right: 5px">Comparecencia</label>
                            <input class="form-check-input" type="radio" v-model="denunciado" id="comparecencia" value="1">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="conocido" style="padding-right: 5px">Conocido</label>
                            <input class="form-check-input" type="radio" v-model="denunciado" id="conocido" value="2">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="QRR" style="padding-right: 5px">QRR</label>
                            <input class="form-check-input" type="radio" v-model="denunciado" id="QRR" value="3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div v-if="(denunciado==1 || denunciado==2) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)" class="form-group col-md-4">
                    <label for="nombres">Nombres</label>
                    <input v-if="nombresV == 1" type="text" name="nombres" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('nombres') }" id="nombres" v-model="nombres" placeholder="Ingrese el nombre" v-validate="'required'" autocomplete="off" @blur="searchPersona">
                    <input v-else type="text" name="nombres" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('nombres') }" id="nombres" v-model="nombres" placeholder="Ingrese el nombre" autocomplete="off" @blur="searchPersona">
                    <span v-if="errors.has('nombres')" class="text-danger">{{ errors.first('nombres') }}</span>
                </div>
                <div v-if="denunciado==3" class="form-group col-md-4">
                    <label for="nombres">Nombres</label>
                    <input type="text" class=form-control v-model="qrr" readonly>
                </div>
                <div v-if="(denunciado==1 || denunciado==2) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)" class="form-group col-md-4">
                    <label for="primerAp">Primer Apellido</label>
                    <input v-if="primerApV == 1" type="text" name="primerAp" data-vv-name="Primer Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Primer Apellido') }" id="primerAp" v-model="primerAp" placeholder="Ingrese el primer apellido" v-validate="'required'" autocomplete="off" @blur="searchPersona">
                    <input v-else type="text" name="primerAp" data-vv-name="Primer Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Primer Apellido') }" id="primerAp" v-model="primerAp" placeholder="Ingrese el primer apellido" autocomplete="off" @blur="searchPersona">
                    <span v-if="errors.has('Primer Apellido')" class="text-danger">{{ errors.first('Primer Apellido') }}</span>
                </div>
                <div v-if="(denunciado==1) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)" class="form-group col-md-4">
                    <label for="segundoAp">Segundo Apellido</label>
                    <input v-if="segundoApV == 1" type="text" name="segundoAp" data-vv-name="Segundo Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Segundo Apellido') }" id="segundoAp" v-model="segundoAp" placeholder="Ingrese el segundo apellido" v-validate="'required'" autocomplete="off" @blur="searchPersona">
                    <input v-else type="text" name="segundoAp" data-vv-name="Segundo Apellido" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Segundo Apellido') }" id="segundoAp" v-model="segundoAp" placeholder="Ingrese el segundo apellido" autocomplete="off" @blur="searchPersona">
                    <span v-if="errors.has('Segundo Apellido')" class="text-danger">{{ errors.first('Segundo Apellido') }}</span>
                </div>
                <div v-if="(denunciado==2) || (tipo ==2 && tipo==3 && tipo==4 && tipo==10 && tipo==11 && tipo==12)" class="form-group col-md-4">
                    <label for="alias">Alias</label>
                    <input v-if="aliasV == 1" type="text" name="alias" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('alias') }" id="alias" v-model="alias" placeholder="Ingrese el alias" v-validate="'required'" autocomplete="off">
                    <input v-else type="text" name="alias" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('alias') }" id="alias" v-model="alias" placeholder="Ingrese el alias" autocomplete="off">
                    <span v-if="errors.has('alias')" class="text-danger">{{ errors.first('alias') }}</span>
                </div>
            </div>

            <div class="form-row" v-if="(denunciado==1) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)">
                <div class="form-group col-md-4">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input v-if="fechaNacimientoV == 1" type="date" class="form-control" id="fechaNacimiento" v-model="fechaNacimiento" name="fechaNacimiento" data-vv-name="Fecha de Nacimiento" v-validate="'required'" :class="{ 'border border-danger': errors.has('Fecha de Nacimiento')}" @blur="searchPersona">
                    <input v-else type="date" class="form-control" id="fechaNacimiento" v-model="fechaNacimiento" name="fechaNacimiento" data-vv-name="Fecha de Nacimiento" :class="{ 'border border-danger': errors.has('Fecha de Nacimiento')}" @blur="searchPersona">
                    <span v-show="errors.has('Fecha de Nacimiento')" class="text-danger">{{ errors.first('Fecha de Nacimiento') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="rfc">R.F.C</label>
                    <input v-if="rfcV == 1" type="text" name="rfc" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('rfc') }" id="rfc" v-model="rfc" placeholder="Ingrese el rfc" v-validate="'required'" autocomplete="off">
                    <input v-else type="text" name="rfc" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('rfc') }" id="rfc" v-model="rfc" placeholder="Ingrese el rfc" autocomplete="off">
                    <span v-if="errors.has('rfc')" class="text-danger">{{ errors.first('rfc') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="edad">Edad</label>
                    <input v-if="edadV == 1" type="number" min="0" max="150" name="edad" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('edad') }" id="edad" v-model="edad" placeholder="Ingrese la edad" v-validate="'required'">
                    <input v-else type="number"  min="0" max="150" name="edad" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('edad') }" id="edad" v-model="edad" placeholder="Ingrese la edad">
                    <span v-if="errors.has('edad')" class="text-danger">{{ errors.first('edad') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="sexos">Sexo</label>    
                    <v-select v-if="sexoV == 1" :options="sexos" label="nombre" v-model="sexo" name="sexo" v-validate="'required'" :class="{ 'border border-danger': errors.has('sexo') }" placeholder="Seleccione un sexo"></v-select>
                    <v-select v-else :options="sexos" label="nombre" v-model="sexo" name="sexo" :class="{ 'border border-danger': errors.has('sexo') }" placeholder="Seleccione un sexo"></v-select>
                    <span v-show="errors.has('sexo')" class="text-danger">{{ errors.first('sexo') }}</span>
                </div>
            </div>

            <div class="form-row" v-if="(denunciado==1) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)">
                <div class="form-group col-md-4">
                    <label for="curp">Curp</label>
                    <input v-if="curpV == 1" type="text" name="curp" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('curp') }" id="curp" v-model="curp" placeholder="Ingrese el curp" v-validate="'required'" autocomplete="off">
                    <input v-else type="text" name="curp" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('curp') }" id="curp" v-model="curp" placeholder="Ingrese el curp" autocomplete="off">
                    <span v-if="errors.has('curp')" class="text-danger">{{ errors.first('curp') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="nacionalidad">Nacionalidad</label>    
                    <v-select v-if="nacionalidadV == 1" :options="nacionalidades" label="nombre" v-model="nacionalidad" name="nacionalidad" v-validate="'required'" :class="{ 'border border-danger': errors.has('nacionalidad') }" placeholder="Seleccione una nacionalidad"></v-select>
                    <v-select v-else :options="nacionalidades" label="nombre" v-model="nacionalidad" name="nacionalidad" :class="{ 'border border-danger': errors.has('nacionalidad') }" placeholder="Seleccione una nacionalidad"></v-select>
                    <span v-show="errors.has('nacionalidad')" class="text-danger">{{ errors.first('nacionalidad') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="estado">Entidad Federativa</label>    
                    <v-select v-if="estadoV == 1" :options="estados" label="nombre" data-vv-name="Entidad Federativa" v-model="estado" name="estado" @input="getMunicipios" v-validate="'required'" :class="{ 'border border-danger': errors.has('Entidad Federativa') }" placeholder="Seleccione una entidad federativa"></v-select>
                    <v-select v-else :options="estados" label="nombre" data-vv-name="Entidad Federativa" v-model="estado" name="estado" @input="getMunicipios" :class="{ 'border border-danger': errors.has('Entidad Federativa') }" placeholder="Seleccione una entidad federativa"></v-select>
                    <span v-show="errors.has('Entidad Federativa')" class="text-danger">{{ errors.first('Entidad Federativa') }}</span>
                </div>
            </div>

            <div class="form-row" v-if="(denunciado==1) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)">
                <div class="form-group col-md-4">
                    <label for="municipio">Municipio de Origen</label>    
                    <v-select v-if="municipioV == 1" :options="municipios" label="nombre" v-model="municipio" name="municipio" v-validate="'required'" :class="{ 'border border-danger': errors.has('municipio') }" placeholder="Seleccione un municipio"></v-select>
                    <v-select v-else :options="municipios" label="nombre" v-model="municipio" name="municipio" :class="{ 'border border-danger': errors.has('municipio') }" placeholder="Seleccione un municipio"></v-select>
                    <span v-show="errors.has('municipio')" class="text-danger">{{ errors.first('municipio') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="etnia">Etnia</label>    
                    <v-select v-if="etniaV == 1" label="nombre" :options="etnias" v-model="etnia" name="etnia" v-validate="'required'" :class="{ 'border border-danger': errors.has('etnia') }" placeholder="Seleccione una etnia" class="select"></v-select>
                    <v-select v-else label="nombre" :options="etnias" v-model="etnia" name="etnia" :class="{ 'border border-danger': errors.has('etnia') }" placeholder="Seleccione una etnia" class="select"></v-select>
                    <span v-show="errors.has('etnia')" class="text-danger">{{ errors.first('etnia') }}</span> 
                </div>
                <div class="form-group col-md-4">
                    <label for="lengua">Lengua</label>    
                    <v-select v-if="lenguaV == 1" label="nombre" :options="lenguas" v-model="lengua" name="lengua" v-validate="'required'" :class="{ 'border border-danger': errors.has('lengua') }" placeholder="Seleccione una lengua" class="select"></v-select>
                    <v-select v-else label="nombre" :options="lenguas" v-model="lengua" name="lengua" :class="{ 'border border-danger': errors.has('lengua') }" placeholder="Seleccione una lengua" class="select"></v-select>
                    <span v-show="errors.has('lengua')" class="text-danger">{{ errors.first('lengua') }}</span> 
                </div>
            </div>
            <div class="form-row" v-if="(denunciado==1) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)">
                <div class="form-group col-md-4">
                    <label for="interprete">Intérprete</label>    
                    <v-select v-if="interpreteV == 1" :options="interpretes" label="nombre" v-model="interprete" name="interprete" v-validate="'required'" :class="{ 'border border-danger': errors.has('interprete') }" placeholder="Seleccione un interprete"></v-select>
                    <v-select v-else :options="interpretes" label="nombre" v-model="interprete" name="interprete" :class="{ 'border border-danger': errors.has('interprete') }" placeholder="Seleccione un interprete"></v-select>
                    <span v-show="errors.has('interprete')" class="text-danger">{{ errors.first('interprete') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="telefono">Teléfono</label>
                    <input v-if="telefonoV == 1" type="text" name="telefono" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('telefono') }" id="telefono" v-model="telefono" placeholder="Ingrese el telefono" v-validate="'required|numeric'" autocomplete="off">
                    <input v-else type="text" name="telefono" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('telefono') }" id="telefono" v-model="telefono" placeholder="Ingrese el telefono" v-validate="'numeric'" autocomplete="off">
                    <span v-if="errors.has('telefono')" class="text-danger">{{ errors.first('telefono') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="motivoEstancia">Motivo Estancia</label>
                    <input v-if="motivoEstanciaV == 1" type="text" name="motivoEstancia" data-vv-name="Motivo de estancia" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Motivo de estancia') }" id="motivoEstancia" v-model="motivoEstancia" placeholder="Ingrese el motivo de estancia" v-validate="'required'" autocomplete="off">
                    <input v-else type="text" name="motivoEstancia" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Motivo de estancia') }" id="motivoEstancia" v-model="motivoEstancia" placeholder="Ingrese el motivo de estancia" autocomplete="off">
                    <span v-if="errors.has('Motivo de estancia')" class="text-danger">{{ errors.first('Motivo de estancia') }}</span>
                </div>
            </div>
            <div class="form-row" v-if="(denunciado==1) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)">
                <div class="form-group col-md-4">
                    <label for="ocupacion">Ocupación</label>    
                    <v-select v-if="ocupacionV == 1" :options="ocupaciones" label="nombre" v-model="ocupacion" name="ocupacion" v-validate="'required'" :class="{ 'border border-danger': errors.has('ocupacion') }" placeholder="Seleccione una ocupación"></v-select>
                    <v-select v-else :options="ocupaciones" label="nombre" v-model="ocupacion" name="ocupacion" :class="{ 'border border-danger': errors.has('ocupacion') }" placeholder="Seleccione una ocupación"></v-select>
                    <span v-show="errors.has('ocupacion')" class="text-danger">{{ errors.first('ocupacion') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="estadoCivil">Estado Civil</label>    
                    <v-select v-if="estadoCivilV == 1" :options="estadosCiviles" label="nombre" v-model="estadoCivil" name="estadoCivil" data-vv-name="Estado Civil" v-validate="'required'" :class="{ 'border border-danger': errors.has('Estado Civil') }" placeholder="Seleccione un estado civil"></v-select>
                    <v-select v-else :options="estadosCiviles" label="nombre" v-model="estadoCivil" name="estadoCivil" :class="{ 'border border-danger': errors.has('Estado Civil') }" placeholder="Seleccione un estado civil"></v-select>
                    <span v-show="errors.has('Estado Civil')" class="text-danger">{{ errors.first('Estado Civil') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="escolaridad">Escolaridad</label>    
                    <v-select v-if="escolaridadV == 1" :options="escolaridades" label="nombre" v-model="escolaridad" name="escolaridad" v-validate="'required'" :class="{ 'border border-danger': errors.has('escolaridad') }" placeholder="Seleccione una escolaridad"></v-select>
                    <v-select v-else :options="escolaridades" label="nombre" v-model="escolaridad" name="escolaridad" :class="{ 'border border-danger': errors.has('escolaridad') }" placeholder="Seleccione una escolaridad"></v-select>
                    <span v-show="errors.has('escolaridad')" class="text-danger">{{ errors.first('escolaridad') }}</span>
                </div>
            </div>
            <div class="form-row" v-if="(denunciado==1) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)">
                <div class="form-group col-md-4">
                    <label for="religion">Religion</label>    
                    <v-select v-if="religionV == 1" :options="religiones" label="nombre" v-model="religion" name="religion" v-validate="'required'" :class="{ 'border border-danger': errors.has('religion') }" placeholder="Seleccione una religión"></v-select>
                    <v-select v-else :options="religiones" label="nombre" v-model="religion" name="religion" :class="{ 'border border-danger': errors.has('religion') }" placeholder="Seleccione una religión"></v-select>
                    <span v-show="errors.has('religion')" class="text-danger">{{ errors.first('religion') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="identificacion">Identificación</label>    
                    <v-select v-if="identificacionV == 1" :options="identificaciones" label="documento" v-model="identificacion" name="identificacion" v-validate="'required'" :class="{ 'border border-danger': errors.has('identificacion') }" placeholder="Seleccione una identificación"></v-select>
                    <v-select v-else :options="identificaciones" label="documento" v-model="identificacion" name="identificacion" :class="{ 'border border-danger': errors.has('identificacion') }" placeholder="Seleccione una identificación"></v-select>
                    <span v-show="errors.has('identificacion')" class="text-danger">{{ errors.first('identificacion') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="numIdentificacion">Número de Identifación</label>
                    <input v-if="numIdentificacionV == 1" type="text" name="numIdentificacion" data-vv-name="Numero de identificacion" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Numero de identificacion') }" id="numIdentificacion" v-model="numIdentificacion" placeholder="Ingrese el número de identificación" v-validate="'required'" autocomplete="off">
                    <input v-else type="text" name="numIdentificacion" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Numero de identificacion') }" id="numIdentificacion" v-model="numIdentificacion" placeholder="Ingrese el número de identificación" autocomplete="off">
                    <span v-if="errors.has('Numero de identificacion')" class="text-danger">{{ errors.first('Numero de identificacion') }}</span>
                </div>
            </div>
            <div class="form-row" v-if="(denunciado==1) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)">
                <div class="form-group col-md-4">
                    <label for="lugarTrabajo">Lugar de Trabajo</label>
                    <input v-if="lugarTrabajoV == 1" type="text" name="lugarTrabajo" data-vv-name="Lugar de Trabajo" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Lugar de Trabajo') }" id="lugarTrabajo" v-model="lugarTrabajo" placeholder="Ingrese el lugar de trabajo" v-validate="'required'" autocomplete="off">
                    <input v-else type="text" name="lugarTrabajo" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Lugar de Trabajo') }" id="lugarTrabajo" v-model="lugarTrabajo" placeholder="Ingrese el lugar de trabajo" autocomplete="off">
                    <span v-if="errors.has('Lugar de Trabajo')" class="text-danger">{{ errors.first('Lugar de Trabajo') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="telefonoTrabajo">Teléfono de Trabajo</label>
                    <input v-if="telefonoTrabajoV == 1" type="text" name="telefonoTrabajo" data-vv-name="Telefono de Trabajo" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Telefono de Trabajo') }" id="telefonoTrabajo" v-model="telefonoTrabajo" placeholder="Ingrese el teléfono de trabajo" v-validate="'required|numeric'" autocomplete="off">
                    <input v-else type="text" name="telefonoTrabajo" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('Telefono de Trabajo') }" id="telefonoTrabajo" v-model="telefonoTrabajo" placeholder="Ingrese el teléfono de trabajo" v-validate="'numeric'" autocomplete="off">
                    <span v-if="errors.has('Telefono de Trabajo')" class="text-danger">{{ errors.first('Telefono de Trabajo') }}</span>
                </div>
                <div v-if="(denunciado==1) || (tipo ==2 && tipo==3 && tipo==4 && tipo==10 && tipo==11 && tipo==12)" class="form-group col-md-4">
                    <label for="alias">Alias</label>
                    <input v-if="aliasV == 1" type="text" name="alias" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('alias') }" id="alias" v-model="alias" placeholder="Ingrese el alias" v-validate="'required'" autocomplete="off">
                    <input v-else type="text" name="alias" :class="{'input': true, 'form-control':true, 'border border-danger': errors.has('alias') }" id="alias" v-model="alias" placeholder="Ingrese el alias" autocomplete="off">
                    <span v-if="errors.has('alias')" class="text-danger">{{ errors.first('alias') }}</span>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="form-group col-md-5">
                    <button v-if="(denunciado!=false) || (tipo !=2 && tipo!=3 && tipo!=4 && tipo!=10 && tipo!=11 && tipo!=12)" type="submit" class="btn mr-1">Guardar</button>
                </div>
            </div>
        </form>
<!-- <h1>{{fechaNacimiento}}</h1> -->
<!-- <h1>{{personaExiste}}</h1> -->
    </div>
</template>

<script>
import swal from 'sweetalert2'
    export default {
        data(){
             return{
                nacionalidades: [],
                estados: [],
                municipios: [],
                etnias: [],
                lenguas: [],
                interpretes: [],
                sexos: [],
                ocupaciones: [],
                estadosCiviles: [],
                escolaridades: [],
                religiones: [],
                identificaciones: [],
                personaExiste:'',
                nombres: '',
                primerAp: '',
                segundoAp: '',
                fechaNacimiento: '',
                edad: '',
                sexo:null,
                rfc:'',
                curp: '',
                // mostrarSearch:true,
                mostrarForm:true,
                nacionalidad:{ "nombre": "MEXICANA", "id": 1 },
                estado:{ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
                municipio:null,
                etnia:{ "nombre": "SIN INFORMACIÓN", "id": 13 },
                lengua:{ "nombre": "SIN INFORMACIÓN", "id": 69 },
                interprete:{ "nombre": "SIN INFORMACIÓN", "id": 1 },
                telefono:'',
                motivoEstancia:'',
                ocupacion:'',
                estadoCivil:'',
                escolaridad:'',
                religion:'',
                identificacion:'',
                numIdentificacion:'',
                lugarTrabajo:'',
                telefonoTrabajo:'',
                alias:'',
                nombresV:false,
                primerApV:false,
                segundoApV:false,
                fechaNacimientoV:false,
                edadV:false,
                sexoV:false,
                rfcV:false,
                curpV:false,
                nacionalidadV:false,
                estadoV:false,
                municipioV:false,
                etniaV:false,
                lenguaV:false,
                interpreteV:false,
                telefonoV:false,
                motivoEstanciaV:false,
                ocupacionV:false,
                estadoCivilV:false,
                escolaridadV:false,
                religionV:false,
                identificacionV:false,
                numIdentificacionV:false,
                lugarTrabajoV:false,
                telefonoTrabajoV:false,
                aliasV:false,
                validaciones:[],
                denunciado:false,
                qrr:"QUIEN RESULTE RESPONSABLE"
            }
        },

        // props: ['sistema','tipo'],
        props:{
            sistema: {
                default:false
            },
            tipo: {
                default:false
            }
        },
        mounted: function(){
           this.getNacionalidades();
           this.getEstados();
           this.getEtnias();
           this.getLenguas();
           this.getSexos();
           this.getOcupaciones();
           this.getEstadosCiviles();
           this.getEscolaridades();
           this.getReligiones();
           this.getIdentificaciones();
        //    this.getInterpretes();
           this.getValidaciones();
        },
        methods:{
            searchPersona: function(){
                if(this.nombres!='' && this.primerAp!='' && this.segundoAp!='' && this.fechaNacimiento!=''){
                    var urlRfcFisico = 'rfcFisico';
                    axios.post(urlRfcFisico,{
                        nombres: this.nombres,
                        primerAp: this.primerAp,
                        segundoAp: this.segundoAp,
                        fechaNacimiento: this.fechaNacimiento
                    }).then(response =>{
                        this.rfc = response.data.res
                        var urlBuscarPersona = 'searchPersonaFisica';
                        axios.post(urlBuscarPersona,{
                            rfc: this.rfc
                        }).then(response => {
                            this.personaExiste=response.data
                            if(this.personaExiste!=''){
                                swal({
                                    title: 'Persona Encontrada!',
                                    text: 'Esta persona ya fue registrada anteriormente',
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                })
                                this.nombres= this.personaExiste.nombres,
                                this.primerAp=this.personaExiste.primerAp,
                                this.segundoAp=this.personaExiste.segundoAp,
                                // this.fechaNacimiento=this.personaExiste.fechaNacimiento,
                                this.edad=this.personaExiste.edad,
                                this.sexo=this.personaExiste.sexo,
                                this.rfc=this.personaExiste.rfc,
                                this.curp=this.personaExiste.curp,
                                this.nacionalidad=this.personaExiste.idNacionalidad,
                                this.municipio=this.personaExiste.idMunicipioOrigen,
                                this.etnia=this.personaExiste.idEtnia,
                                this.lengua=this.personaExiste.idLengua,
                                this.interprete=this.personaExiste.idInterprete,
                                this.telefono=this.personaExiste.telefono,
                                this.motivoEstancia=this.personaExiste.motivoEstancia,
                                this.ocupacion=this.personaExiste.idOcupacion,
                                this.estadoCivil=this.personaExiste.idEstadoCivil,
                                this.escolaridad=this.personaExiste.idEscolaridad,
                                this.religion=this.personaExiste.idReligion,
                                this.identificacion=this.personaExiste.docIdentificacion,
                                this.numIdentificacion=this.personaExiste.numDocIdentificacion
                                this.lugarTrabajo=this.personaExiste.lugarTrabajo,
                                this.telefonoTrabajo=this.personaExiste.telefonoTrabajo,
                                this.alias=this.personaExiste.alias
                            }
                        })
                    });
                }
            },
            getNacionalidades: function(){
                var urlNacionalidades = 'getNacionalidades';
                axios.get(urlNacionalidades).then(response => {
                    this.nacionalidades = response.data
                });
            },
            getEstados: function(){
                var urlEstados = 'getEstados';
                axios.get(urlEstados).then(response => {
                    this.estados = response.data
                });
            },
            getMunicipios: function(){
                if(this.estado!=null){
                    this.municipio=null
                    var urlMunicipios = 'getMunicipios/'+this.estado.id;
                    axios.get(urlMunicipios).then(response => {
                        this.municipios = response.data
                    });
                }
                else{
                    this.municipio=null,
                    this.municipios=[]
                }
            },
            getEtnias: function(){
                var urlEtnias = 'getEtnias';
                axios.get(urlEtnias).then(response => {
                    this.etnias = response.data
                });
            },
            getLenguas: function(){
                var urlLenguas = 'getLenguas';
                axios.get(urlLenguas).then(response => {
                    this.lenguas = response.data
                });
            },
            // getInterprete: function(){
            //     var urlInterpretes = 'getInterpretes';
            //     axios.get(urlInterpretes).then(response => {
            //         this.interpretes = response.data
            //     });
            // },
            getSexos: function(){
                var urlSexos = 'getSexos';
                axios.get(urlSexos).then(response => {
                    this.sexos = response.data
                });
            },
            getOcupaciones: function(){
                var urlOcupaciones = 'getOcupaciones';
                axios.get(urlOcupaciones).then(response => {
                    this.ocupaciones = response.data
                });
            },
            getEstadosCiviles: function(){
                var urlEstadosCiviles = 'getEstadosCiviles';
                axios.get(urlEstadosCiviles).then(response => {
                    this.estadosCiviles = response.data
                });
            },
            getEscolaridades: function(){
                var urlEscolaridades = 'getEscolaridades';
                axios.get(urlEscolaridades).then(response => {
                    this.escolaridades = response.data
                });
            },
            getReligiones: function(){
                var urlReligiones = 'getReligiones';
                axios.get(urlReligiones).then(response => {
                    this.religiones = response.data
                });
            },
            getIdentificaciones: function(){
                var urlIdentificaciones = 'getIdentificaciones';
                axios.get(urlIdentificaciones).then(response => {
                    this.identificaciones = response.data
                });
            },
            getValidaciones: function(){
                var urlValidaciones = 'getValidaciones';
                axios.post(urlValidaciones, {
                    id1: this.sistema,
                    id2: this.tipo,
                    id3: 1
                })
                .then (response =>{
                    this.validaciones = response.data
                    this.nombresV= this.validaciones.nombres,
                    this.primerApV=this.validaciones.primerAp,
                    this.segundoApV=this.validaciones.segundoAp,
                    this.fechaNacimientoV=this.validaciones.fechaNacimiento,
                    this.edadV=this.validaciones.edad,
                    this.sexoV=this.validaciones.sexo,
                    this.rfcV=this.validaciones.rfc,
                    this.curpV=this.validaciones.curp,
                    this.nacionalidadV=this.validaciones.idNacionalidad,
                    this.estadoV=this.validaciones.idEdoOrigen,
                    this.municipioV=this.validaciones.idMunicipioOrigen,
                    this.etniaV=this.validaciones.idEtnia,
                    this.lenguaV=this.validaciones.idLengua,
                    this.interpreteV=this.validaciones.idInterprete,
                    this.telefonoV=this.validaciones.telefono,
                    this.motivoEstanciaV=this.validaciones.motivoEstancia,
                    this.ocupacionV=this.validaciones.idOcupacion,
                    this.estadoCivilV=this.validaciones.idEstadoCivil,
                    this.escolaridadV=this.validaciones.idEscolaridad,
                    this.religionV=this.validaciones.idReligion,
                    this.identificacionV=this.validaciones.docIdentificacion,
                    this.numIdentificacionV=this.validaciones.numDocIdentificacion
                    this.lugarTrabajoV=this.validaciones.lugarTrabajo,
                    this.telefonoTrabajoV=this.validaciones.telefonoTrabajo,
                    this.aliasV=this.validaciones.alias
                });
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.crearPersona();
                        this.CleanFields();
                        swal({
                            title: 'Guardado Correctamente!',
                            text: 'Esta persona fue guardada exitosamente',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        })
                        return;
                    }
                    swal({
                        title: 'Guardado Incorrecto!',
                        text: 'Esta persona no fue posible guardarla',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            CleanFields() {
                this.nacionalidad={ "nombre": "MEXICANA", "id": 1 },
                this.estado={ "nombre": "VERACRUZ DE IGNACIO DE LA LLAVE", "id": 30 },
                this.municipio=null,
                this.etnia={ "nombre": "SIN INFORMACIÓN", "id": 13 },
                this.lengua={ "nombre": "SIN INFORMACIÓN", "id": 69 },
                this.interprete={ "nombre": "SIN INFORMACIÓN", "id": 1 },
                this.nombres='',
                this.primerAp='',
                this.segundoAp='',
                this.fechaNacimiento='',
                this.edad='',
                this.sexo=null,
                this.rfc='',
                this.curp='',
                this.telefono='',
                this.motivoEstancia='',
                this.ocupacion='',
                this.estadoCivil='',
                this.escolaridad='',
                this.religion='',
                this.identificacion='',
                this.numIdentificacion='',
                this.lugarTrabajo='',
                this.telefonoTrabajo='',
                this.alias='',
                this.$validator.reset();
            },
            crearPersona: function(){
                var urlCrearPersona = 'http://localhost/api/PersonaFisica';
                if(this.denunciado==1){
                    axios.post(urlCrearPersona,{
                        id1: this.sistema,
                        id2: this.tipo,
                        id3: 1,
                        idCarpeta: 1,
                        nombres: this.nombres.toUpperCase(),
                        primerAp: this.primerAp.toUpperCase(),
                        segundoAp: this.segundoAp.toUpperCase(),
                        fechaNacimiento: this.fechaNacimiento,
                        edad: this.edad,
                        sexo: this.sexo.id,
                        rfc:this.rfc.toUpperCase(),
                        curp: this.curp.toUpperCase(),
                        idNacionalidad: this.nacionalidad.id,
                        idMunicipioOrigen: this.municipio.id,
                        idEtnia: this.etnia.id,
                        idLengua: this.lengua.id,
                        // idInterprete: this.interprete.id,
                        idInterprete: 1,
                        telefono: this.telefono,
                        motivoEstancia: this.motivoEstancia.toUpperCase(),
                        idOcupacion: this.ocupacion.id,
                        idEstadoCivil: this.estadoCivil.id,
                        idEscolaridad: this.escolaridad.id,
                        idReligion: this.religion.id,
                        docIdentificacion: this.identificacion.id,
                        numDocIdentificacion: this.numIdentificacion.toUpperCase(),
                        lugarTrabajo: this.lugarTrabajo.toUpperCase(),
                        telefonoTrabajo: this.telefonoTrabajo,
                        alias: this.alias.toUpperCase(),
                        esEmpresa:0
                    })
                }
                else if(this.denunciado==2){
                    axios.post(urlCrearPersona,{
                        nombres: this.nombres,
                        primerAp: this.primerAp,
                        alias: this.alias.toUpperCase(),
                        esEmpresa:0
                    })   
                }
                else if(this.denunciado==3){
                    console.log(1);
                    // axios.post(urlCrearPersona,{
                        // nombres: this.qrr
                    // }) 
                }
            }
       }
    }
</script>
<style>
.select{
    font-family: inherit
}
.form-control:focus {
  color: #6d6d6d;
  background-color: #fff;
  border-color: #828282;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(66, 66, 66, 0.25);
}
button{
    background-color: #424242;
    border-color: #424242;
    color: white;
}
h5{
    color: #138c13;
}
.icons{
    height: 1rem;
    margin-bottom: 3px;
}
input{
    text-transform: uppercase
}
::placeholder{
    text-transform: none
}
</style>