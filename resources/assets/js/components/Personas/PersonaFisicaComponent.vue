<template>
	<div class="container-fluid">
	
		<spring-spinner v-if="loader" class="centrar" :animation-duration="1500" :size="60" :color="'#828282'" />
		<form @submit.prevent="validateBeforeSubmit" v-if="loader!=true">
	
			<div class="row">
				<div v-if="tipo=='qrr'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="nombres">Nombres</label>
					<input type="text" class="form-control form-control-sm" v-model="qrr" readonly>
				</div>
			</div>
	
			<div class="form-row">
				<div v-if="validaciones.nombres!='oculto' && showCoincidencias!=true" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="nombres">Nombres</label>
					<input type="text" name="nombres" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('nombres') || this.validacionesback.nombres}" v-model="nombres" placeholder="Ingrese el nombre" v-validate="validaciones.nombres"
					    autocomplete="off" @blur="calcularRfc(),generarCurp(),searchConocido()" :readonly="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')">
					<span v-show="errors.has('nombres')" class="text-danger">{{ errors.first('nombres')}}</span>
					<span v-if="this.validacionesback.nombres!=undefined" class="text-danger">{{ String(this.validacionesback.nombres)}}</span>
				</div>
	
				<div v-if="validaciones.primerAp!='oculto' && showCoincidencias!=true" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="primerAp">Primer apellido</label>
					<input type="text" data-vv-name="primer apellido" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('primer apellido') || this.validacionesback.primerAp}" v-model="primerAp" placeholder="Ingrese el primer apellido"
					    v-validate="validaciones.primerAp" autocomplete="off" @blur="calcularRfc(),generarCurp(),searchConocido()" :readonly="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')">
					<span v-show="errors.has('primer apellido')" class="text-danger">{{ errors.first('primer apellido')}}</span>
					<span v-if="this.validacionesback.primerAp!=undefined" class="text-danger">{{ String(this.validacionesback.primerAp)}}</span>
				</div>
				<div v-if="validaciones.segundoAp!='oculto' && showCoincidencias!=true" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="segundoAp">Segundo apellido</label>
					<input type="text" data-vv-name="segundo apellido" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('segundo apellido') || this.validacionesback.segundoAp}" v-model="segundoAp" placeholder="Ingrese el segundo apellido"
					    v-validate="validaciones.segundoAp" autocomplete="off" @blur="calcularRfc(),generarCurp(),searchConocido()" :readonly="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')">
					<span v-show="errors.has('segundo apellido')" class="text-danger">{{ errors.first('segundo apellido')}}</span>
					<span v-if="this.validacionesback.segundoAp!=undefined" class="text-danger">{{ String(this.validacionesback.segundoAp)}}</span>
				</div>
				<div v-if="(validaciones.alias!='oculto' && tipo=='conocido' && showCoincidencias!=true) || (tipodenunciado=='conocido' && this.$store.state.edit==true)" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="alias">Alias</label>
					<input type="text" name="alias" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('alias')  || this.validacionesback.alias}" v-model="alias" placeholder="Ingrese el alias" v-validate="(this.tipo=='denunciado' && this.$store.state.edit==true)?'':validaciones.alias"
					    autocomplete="off">
					<span v-show="errors.has('alias')" class="text-danger">{{ errors.first('alias')}}</span>
					<span v-if="this.validacionesback.alias!=undefined" class="text-danger">{{ String(this.validacionesback.alias)}}</span>
				</div>
	
	
	
				<div v-if="validaciones.fechaNacimiento!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="fechaNacimiento">Fecha de nacimiento</label>
					<input type="date" class="form-control form-control-sm" v-model="fechaNacimiento" data-vv-name="fecha de nacimiento" v-validate="(this.tipo=='denunciado' && this.$store.state.edit==true)?'':'required|date_format:YYYY-MM-DD|before:' + today" :class="{ 'border border-danger': errors.has('fecha de nacimiento') || this.validacionesback.fechaNacimiento}"
					    @blur="calcularRfc(),generarCurp(),generarEdad()" :readonly="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')">
					<span v-show="errors.has('fecha de nacimiento')" class="text-danger">{{ errors.first('fecha de nacimiento')}}</span>
					<span v-if="this.validacionesback.fechaNacimiento!=undefined" class="text-danger">{{ String(this.validacionesback.fechaNacimiento)}}</span>
				</div>
				<div v-if="validaciones.edad!='oculto'" class="form-group col-md-1">
					<label class="col-form-label col-form-label-sm" for="edad">Edad</label>
					<input type="number" min="16" max="150" name="edad" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('edad') || this.validacionesback.edad}" v-model="edad" placeholder="Edad" v-validate="validaciones.edad"
					    :readonly="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')">
					<span v-show="errors.has('edad')" class="text-danger">{{ errors.first('edad')}}</span>
					<span v-if="this.validacionesback.edad!=undefined" class="text-danger">{{ String(this.validacionesback.edad)}}</span>
				</div>
				<div v-if="validaciones.sexo!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="sexos">Sexo</label>
					<v-select :options="sexos" label="nombre" v-model="sexo" name="sexo" v-validate="validaciones.sexo" :class="{ 'border border-danger rounded': errors.has('sexo') || this.validacionesback.sexo}" placeholder="Seleccione un sexo" @blur="generarCurp" :disabled="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')"></v-select>
					<span v-show="errors.has('sexo')" class="text-danger">{{ errors.first('sexo')}}</span>
					<span v-if="this.validacionesback.sexo!=undefined" class="text-danger">{{ String(this.validacionesback.sexo)}}</span>
				</div>
	
				<div v-if="validaciones.idEstadoOrigen!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="estado">Entidad federativa de origen</label>
					<v-select :options="(estadosCatalogo)?estadosCatalogo:[]" label="nombre" data-vv-name="entidad federativa de origen" v-model="estado" @input="getMunicipios" v-validate="validaciones.idEstadoOrigen" :class="{ 'border border-danger rounded': errors.has('entidad federativa de origen') || this.validacionesback.idEstadoOrigen }"
					    placeholder="Seleccione una entidad federativa de origen" @blur="generarCurp" :disabled="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')"></v-select>
					<span v-show="errors.has('entidad federativa de origen')" class="text-danger">{{ errors.first('entidad federativa de origen')}}</span>
					<span v-if="this.validacionesback.idEstadoOrigen!=undefined" class="text-danger">{{ String(this.validacionesback.idEstadoOrigen)}}</span>
				</div>
	
				<div v-if="validaciones.idMunicipioOrigen!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="municipio">Municipio de origen</label>
					<v-select :options="(estado.id==30)?municipiosVer:municipios" label="nombre" v-model="municipio" name="municipio" v-validate="validaciones.idMunicipioOrigen" :class="{ 'border border-danger rounded': errors.has('municipio') || this.validacionesback.idMunicipioOrigen}"
					    placeholder="Seleccione un municipio de origen" :disabled="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')"></v-select>
					<span v-show="errors.has('municipio')" class="text-danger">{{ errors.first('municipio')}}</span>
					<span v-if="this.validacionesback.idMunicipioOrigen!=undefined" class="text-danger">{{ String(this.validacionesback.idMunicipioOrigen)}}</span>
				</div>
	
				<div v-if="validaciones.rfc!='oculto'" class="form-group col-md-2">
					<label class="col-form-label col-form-label-sm" for="rfc">RFC</label>
					<input type="text" name="rfc" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('rfc') || this.validacionesback.rfc}" v-model="rfc" placeholder="Ingrese el RFC" v-validate="(this.tipo=='denunciado' && this.$store.state.edit==true)?'':validaciones.rfc"
					    autocomplete="off" @blur="searchPersona('rfc')" :readonly="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')">
					<span v-show="errors.has('rfc')" class="text-danger">{{ errors.first('rfc')}}</span>
					<span v-if="this.validacionesback.rfc!=undefined" class="text-danger">{{ String(this.validacionesback.rfc)}}</span>
				</div>
				<div v-if="validaciones.homo!='oculto'" class="form-group col-md-2">
					<label class="col-form-label col-form-label-sm" for="homoclave">Homoclave</label>
					<input type="text" name="homoclave" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('homoclave') || this.validacionesback.homo}" v-model="homoclave" placeholder="Homoclave" v-validate="(this.tipo=='denunciado' && this.$store.state.edit==true)?'':validaciones.homo"
					    autocomplete="off" @blur="searchPersona('rfc')" :readonly="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')">
					<span v-show="errors.has('homoclave')" class="text-danger">{{ errors.first('homoclave')}}</span>
					<span v-if="this.validacionesback.homo!=undefined" class="text-danger">{{ String(this.validacionesback.homo)}}</span>
				</div>
	
				<div v-if="validaciones.curp!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="curp">CURP</label>
					<input type="text" name="curp" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('curp') || this.validacionesback.curp}" v-model="curp" placeholder="Ingrese el curp" v-validate="(this.tipo=='denunciado' && this.$store.state.edit==true)?'':validaciones.curp"
					    autocomplete="off" @blur="searchPersona('curp')" :readonly="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')">
					<span v-show="errors.has('curp')" class="text-danger">{{ errors.first('curp') }}</span>
					<span v-if="this.validacionesback.curp!=undefined" class="text-danger">{{ String(this.validacionesback.curp)}}</span>
				</div>
				<div v-if="validaciones.idNacionalidad!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="nacionalidad">Nacionalidad</label>
					<v-select :options="nacionalidades" label="nombre" v-model="nacionalidad" name="nacionalidad" v-validate="validaciones.idNacionalidad" :class="{ 'border border-danger rounded': errors.has('nacionalidad') || this.validacionesback.idNacionalidad}" placeholder="Seleccione una nacionalidad"
					    :disabled="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')"></v-select>
					<span v-show="errors.has('nacionalidad')" class="text-danger">{{ errors.first('nacionalidad')}}</span>
					<span v-if="this.validacionesback.idNacionalidad!=undefined" class="text-danger">{{ String(this.validacionesback.idNacionalidad)}}</span>
				</div>
	
				<div v-if="validaciones.idEtnia!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="etnia">Etnia</label>
					<v-select label="nombre" :options="etnias" v-model="etnia" name="etnia" v-validate="validaciones.idEtnia" :class="{ 'border border-danger rounded': errors.has('etnia') || this.validacionesback.idEtnia}" placeholder="Seleccione una etnia" :disabled="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')"></v-select>
					<span v-show="errors.has('etnia')" class="text-danger">{{ errors.first('etnia')}}</span>
					<span v-if="this.validacionesback.idEtnia!=undefined" class="text-danger">{{ String(this.validacionesback.idEtnia)}}</span>
				</div>
				<div v-if="validaciones.idLengua!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="lengua">Lengua</label>
					<v-select label="nombre" :options="lenguas" v-model="lengua" name="lengua" v-validate="validaciones.idLengua" :class="{ 'border border-danger rounded': errors.has('lengua') || this.validacionesback.idLengua}" placeholder="Seleccione una lengua" :disabled="this.$store.state.fisicaEncontrada==true || (this.$store.state.edit==true && this.tipodenunciado!='qrr' && this.tipodenunciado!='conocido')"></v-select>
					<span v-show="errors.has('lengua')" class="text-danger">{{ errors.first('lengua')}}</span>
					<span v-if="this.validacionesback.idLengua!=undefined" class="text-danger">{{ String(this.validacionesback.idLengua)}}</span>
				</div>
	
	
	
				<div v-if="validaciones.idInterprete!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="interprete">Intérprete</label>
					<v-select :options="interpretes" label="nombre" v-model="interprete" name="intérprete" v-validate="validaciones.idInterprete" :class="{ 'border border-danger rounded': errors.has('intérprete') || this.validacionesback.idInterprete}" placeholder="Seleccione un intérprete"></v-select>
					<span v-show="errors.has('intérprete')" class="text-danger">{{ errors.first('intérprete')}}</span>
					<span v-if="this.validacionesback.idInterprete!=undefined" class="text-danger">{{ String(this.validacionesback.idInterprete)}}</span>
				</div>
				<div v-if="validaciones.motivoEstancia!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="motivoEstancia">Motivo de estancia</label>
					<input type="text" data-vv-name="motivo de estancia" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('motivo de estancia') || this.validacionesback.motivoEstancia}" v-model="motivoEstancia" placeholder="Ingrese el motivo de estancia"
					    v-validate="validaciones.motivoEstancia" autocomplete="off">
					<span v-show="errors.has('motivo de estancia')" class="text-danger">{{ errors.first('motivo de estancia')}}</span>
					<span v-if="this.validacionesback.motivoEstancia!=undefined" class="text-danger">{{ String(this.validacionesback.motivoEstancia)}}</span>
				</div>
				<div v-if="validaciones.idOcupacion!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="ocupación">Ocupación</label>
					<v-select :options="ocupaciones" label="nombre" v-model="ocupacion" name="ocupación" v-validate="validaciones.idOcupacion" :class="{ 'border border-danger rounded': errors.has('ocupación') || this.validacionesback.idOcupacion}" placeholder="Seleccione una ocupación"></v-select>
					<span v-show="errors.has('ocupación')" class="text-danger">{{ errors.first('ocupación')}}</span>
					<span v-if="this.validacionesback.idOcupacion!=undefined" class="text-danger">{{ String(this.validacionesback.idOcupacion)}}</span>
				</div>
	
	
	
				<div v-if="validaciones.idEstadoCivil!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="estadoCivil">Estado civil</label>
					<v-select :options="estadosCiviles" label="nombre" v-model="estadoCivil" data-vv-name="estado civil" v-validate="validaciones.idEstadoCivil" :class="{ 'border border-danger rounded': errors.has('estado civil') || this.validacionesback.idEstadoCivil}"
					    placeholder="Seleccione un estado civil"></v-select>
					<span v-show="errors.has('estado civil')" class="text-danger">{{ errors.first('estado civil')}}</span>
					<span v-if="this.validacionesback.idEstadoCivil!=undefined" class="text-danger">{{ String(this.validacionesback.idEstadoCivil)}}</span>
				</div>
				<div v-if="validaciones.idEscolaridad!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="escolaridad">Escolaridad</label>
					<v-select :options="escolaridades" label="nombre" v-model="escolaridad" name="escolaridad" v-validate="validaciones.idEscolaridad" :class="{ 'border border-danger rounded': errors.has('escolaridad') || this.validacionesback.idEscolaridad}" placeholder="Seleccione una escolaridad"></v-select>
					<span v-show="errors.has('escolaridad')" class="text-danger">{{ errors.first('escolaridad')}}</span>
					<span v-if="this.validacionesback.idEscolaridad!=undefined" class="text-danger">{{ String(this.validacionesback.idEscolaridad)}}</span>
				</div>
				<div v-if="validaciones.idReligion!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="religion">Religión</label>
					<v-select :options="religiones" label="nombre" v-model="religion" name="religion" v-validate="validaciones.idReligion" :class="{ 'border border-danger rounded': errors.has('religión') || this.validacionesback.idReligion}" placeholder="Seleccione una religión"></v-select>
					<span v-show="errors.has('religión')" class="text-danger">{{ errors.first('religión')}}</span>
					<span v-if="this.validacionesback.idReligion!=undefined" class="text-danger">{{ String(this.validacionesback.idReligion)}}</span>
				</div>
	
	
	
				<div v-if="validaciones.docIdentificacion!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="identificación">Identificación</label>
					<v-select :options="identificaciones" label="documento" v-model="identificacion" name="identificación" v-validate="validaciones.docIdentificacion" :class="{ 'border border-danger rounded': errors.has('identificación') || this.validacionesback.docIdentificacion}"
					    placeholder="Seleccione una identificación"></v-select>
					<span v-show="errors.has('identificación')" class="text-danger">{{ errors.first('identificación')}}</span>
					<span v-if="this.validacionesback.docIdentificacion!=undefined" class="text-danger">{{ String(this.validacionesback.docIdentificacion)}}</span>
				</div>
				<div v-if="validaciones.numDocIdentificacion!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="numIdentificacion">Número de identificación</label>
					<input type="text" data-vv-name="número de identificación" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('número de identificación') || this.validacionesback.numDocIdentificacion}" v-model="numIdentificacion"
					    placeholder="Ingrese el número de identificación" v-validate="validaciones.numDocIdentificacion" autocomplete="off">
					<span v-show="errors.has('número de identificación')" class="text-danger">{{ errors.first('número de identificación')}}</span>
					<span v-if="this.validacionesback.numDocIdentificacion!=undefined" class="text-danger">{{ String(this.validacionesback.numDocIdentificacion)}}</span>
				</div>
				<div v-if="validaciones.telefono!='oculto'" class="form-group col-md-4">
					<label class="col-form-label col-form-label-sm" for="teléfono">Teléfono</label>
					<input type="text" name="teléfono" :class="{'input': true, 'form-control form-control-sm':true, 'border border-danger': errors.has('teléfono') || this.validacionesback.telefono}" v-model="telefono" placeholder="Ingrese el teléfono" v-validate="validaciones.telefono"
					    autocomplete="off">
					<span v-show="errors.has('teléfono')" class="text-danger">{{ errors.first('teléfono')}}</span>
					<span v-if="this.validacionesback.telefono!=undefined" class="text-danger">{{ String(this.validacionesback.telefono)}}</span>
				</div>
			</div>
	
	
			<button v-if="personasEncontradas.length>0 && showCoincidencias!=true" type="button" @click="mostrarCoincidencias" class="btn btn-primary mt-2">
				<icon name="user-check" style="color:white"></icon>
				{{personasEncontradas.length + coincidenciasText}}
			</button>
			<button v-if="showCoincidencias!=true" type="submit" class="btn btn-primary mt-2">{{botonGuardarModificar}}</button>
	
	
	
			<coincidencias v-if="showCoincidencias==true" :sistema="sistema" :usuario="usuario"></coincidencias>
	
	
	
		</form>
	</div>
</template>

<script>
	import urlComponentes from '../../urlComponentes'
	import generaCurp from '../../curp'
	import swal from 'sweetalert2'
	import {
		SpringSpinner
	} from 'epic-spinners'
	import moment from 'moment'
	import {
		mapState
	} from "vuex";
	export default {
		data() {
			return {
				today: moment().format('YYYY-MM-DD'),
				nacionalidades: [],
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
				personaExiste: [],
				nombres: '',
				primerAp: '',
				segundoAp: '',
				fechaNacimiento: '',
				edad: '',
				sexo: '',
				rfc: '',
				homoclave: '',
				curp: '',
				nacionalidad: {
					"nombre": "MEXICANA",
					"id": 1
				},
				estado: {
					"nombre": "VERACRUZ DE IGNACIO DE LA LLAVE",
					"id": 30
				},
				municipio: null,
				etnia: {
					"nombre": "SIN INFORMACIÓN",
					"id": 13
				},
				lengua: {
					"nombre": "SIN INFORMACIÓN",
					"id": 69
				},
				interprete: {
					"nombre": "SIN INFORMACIÓN",
					"id": 1
				},
				motivoEstancia: '',
				ocupacion: '',
				estadoCivil: '',
				escolaridad: '',
				religion: '',
				identificacion: '',
				numIdentificacion: '',
				alias: '',
				telefono: '',
				validaciones: [],
				validacionesback: '',
				loader: true,
				qrr: "QUIEN O QUIENES RESULTEN RESPONSABLES",
				url: urlComponentes,
				intentoCarga: 1
			}
		},
		props: ['sistema', 'tipo', 'carpeta', 'idcarpeta', 'usuario', 'idvarpersona', 'tipodenunciado'],
		components: {
			SpringSpinner
		},
		created: function() {
			this.getCatalogos()
			this.cargarEdicion()
		},
		methods: {
			getCatalogos: function() {
				// console.log("Entrando a get catalogos persona")
				var urlCatalogos = this.url + '/getCatalogos';
				axios.post(urlCatalogos, {
						sistema: this.sistema,
						tipo: this.tipo
					}).then(response => {
						this.nacionalidades = response.data['nacionalidades'].original
						this.$store.commit('asignarEstadosMunicipiosVer', {
							estados: response.data['estados'].original,
							municipios: response.data['municipios'].original
						})
						this.etnias = response.data['etnias'].original
						this.lenguas = response.data['lenguas'].original
						this.sexos = response.data['sexos'].original
						this.ocupaciones = response.data['ocupaciones'].original
						this.estadosCiviles = response.data['estadosciviles'].original
						this.escolaridades = response.data['escolaridades'].original
						this.religiones = response.data['religiones'].original
						this.identificaciones = response.data['identificaciones'].original
						this.interpretes = response.data['interpretes'].original
						this.validaciones = response.data['validaciones'].original
						var self = this;
						setTimeout(function() {
							self.loader = false;
						}, 1100);
					})
					.catch((error) => {
						if (this.intentoCarga == 1) {
							this.intentoCarga++
								this.getCatalogos()
						} else {
							swal({
									title: '¡Error de conexión!',
									text: 'No fue posible cargar los catalogos correctamente.',
									type: 'error',
									confirmButtonText: 'Intentar de nuevo'
								})
								.then((result) => {
									if (result.value) {
										window.location.replace(window.location)
									}
								})
						}
					})
			},
			cargarEdicion() {
				if (this.idvarpersona) {
					// console.log("Entrando a get persona Edit")
					var urlGetPersonasEdit = this.url + '/getPersonaEdit'
					axios.post(urlGetPersonasEdit, {
							idVarPersona: this.idvarpersona,
							tipo: this.tipo,
							esEmpresa: false
						})
						.then((response) => {
							console.log(response)
							this.$store.commit('asignarDataEditFisica', response.data)
							this.personaExiste = response.data.persona.original
							this.fillFields()
						})
						.catch((error) => {
							swal({
								title: '¡Algo salio mal!',
								text: 'No fue posible cargar los datos para edición.',
								type: 'error',
								confirmButtonText: 'Entendido'
							})
						})
				}
			},
			getDomicilios() {
				// console.log("Entrando a get domicilios")
				var urlGetDomicilios = this.url + '/getDomiciliosPersona'
				axios.post(urlGetDomicilios, {
						idVarPersona: this.$store.state.idTemporal,
						esEmpresa: false
					})
					.then((response) => {
						if (response.data) {
							this.$store.commit('asignarDomicilios', response.data)
						}
					})
			},
			searchPersona: function(rfc_curp) {
				if (this.$store.state.fisicaEncontrada == true || this.$store.state.idPersonaFisica) {
					return
				}
				if (rfc_curp == 'rfc') {
					if (this.rfc.length != 10 || this.homoclave.length != 3) {
						return
					} else {
						var rfcCurp = this.rfc + this.homoclave
					}
				} else if (rfc_curp == 'curp') {
					if (this.curp.length != 18) {
						return
					} else {
						var rfcCurp = this.curp
					}
				}
				// console.log("Entrando a search persona")
				var urlBuscarPersona = this.url + '/searchPersonaFisica';
				axios.post(urlBuscarPersona, {
					tipoBusqueda: rfc_curp,
					rfcCurp: rfcCurp
				}).then(response => {
					this.personaExiste = response.data
					if (this.personaExiste != '') {
						this.$store.commit('asignarIdFisica', {
							idPersona: '',
							idTemporal: this.personaExiste.idVarPersona,
							fisicaEncontrada: true,
							personaFisica: this.personaExiste.idPersona
						})
						this.$store.commit('asignarDomiciliosTemporales', {
							idDomicilioTemporal: this.personaExiste.idDomicilio,
							idTrabajoTemporal: this.personaExiste.idDomicilioTrabajo,
							idContactoTemporal: this.personaExiste.idDomicilioNotificacion
						})
						swal({
							title: '¡Persona Encontrada!',
							text: 'Ésta persona ya fue registrada anteriormente.',
							type: 'success',
							confirmButtonText: 'Entendido'
						})
						this.fillFields()
					}
				});
			},
			fillFields() {
				this.nombres = this.personaExiste.nombres
				this.primerAp = this.personaExiste.primerAp
				this.segundoAp = this.personaExiste.segundoAp
				this.alias = (this.personaExiste.alias) ? this.personaExiste.alias : ''
				this.fechaNacimiento = this.personaExiste.fechaNacimiento
				this.edad = this.personaExiste.edad
				this.sexo = this.personaExiste.sexo
				this.rfc = (this.personaExiste.rfc != null) ? this.personaExiste.rfc.slice(0, -3) : ''
				this.homoclave = (this.personaExiste.rfc != null) ? this.personaExiste.rfc.slice(-3) : ''
				this.curp = this.personaExiste.curp
				this.nacionalidad = this.personaExiste.idNacionalidad
				this.estado = this.personaExiste.idEstado
				this.municipio = this.personaExiste.idMunicipioOrigen
				this.etnia = this.personaExiste.idEtnia
				this.lengua = this.personaExiste.idLengua
				this.interprete = this.personaExiste.idInterprete
				this.ocupacion = this.personaExiste.idOcupacion
				this.estadoCivil = this.personaExiste.idEstadoCivil
				this.escolaridad = this.personaExiste.idEscolaridad
				this.religion = this.personaExiste.idReligion
				this.identificacion = this.personaExiste.docIdentificacion
				this.numIdentificacion = this.personaExiste.numDocIdentificacion
				this.telefono = this.personaExiste.telefono,
					(this.sistema == 'uipj') ? this.motivoEstancia = this.personaExiste.motivoEstancia : ''
			},
			searchConocido() {
				if ((this.tipo == 'conocido' || this.tipo == 'conocidomoral') && this.nombres != '' && this.primerAp != '' && this.segundoAp != '') {
					// console.log("Entrando a search conocido")
					var urlSearchConocido = this.url + '/searchConocido';
					axios.post(urlSearchConocido, {
						nombres: this.nombres,
						primerAp: this.primerAp,
						segundoAp: this.segundoAp,
					}).then(response => {
						if (response.data) {
							this.$store.commit('asignarPersonasEncontradas', response.data)
						}
					});
				}
			},
			mostrarCoincidencias() {
				this.$store.commit('mostrarCoincidencias')
			},
			calcularRfc() {
				if (this.nombres != '' && this.primerAp != '' && this.fechaNacimiento != '') {
					// console.log("Entrando a calcular rfc")
					var urlRfcFisico = this.url + '/rfcFisico';
					axios.post(urlRfcFisico, {
						nombres: this.nombres,
						primerAp: this.primerAp,
						segundoAp: this.segundoAp,
						fechaNacimiento: this.fechaNacimiento
					}).then(response => {
						this.rfc = response.data.res.slice(0, -3);
						this.homoclave = response.data.res.slice(-3);
						this.searchPersona('rfc');
					});
				} else {
					this.rfc = ''
					this.homoclave = ''
				}
			},
			buscarCarpetasFisica: function(param) {
				// console.log("Entrando a buscar carpetas fisica")
				var post = this.url + '/fisicaCarpetasRfc';
				axios.post(post, {
					rfc: this.rfc + this.homoclave,
					curp: this.curp
				}).then(response => {
					if (response.data) {
						this.$store.commit('asignarCarpetasLigadas', response.data)
					}
				});
			},
			getMunicipios: function() {
				if (this.estado != null && this.$store.state.edit != true && this.$store.state.fisicaEncontrada!=true) {
					if (this.estado.id == 30) {
						return
					}
					// console.log("Entrando a get municipios en persona")
					// this.municipio=null
					var urlMunicipios = this.url + '/getMunicipios/' + this.estado.id;
					axios.get(urlMunicipios).then(response => {
						this.municipios = response.data
					});
				} else {
					this.municipios = []
				}
			},
			generarCurp: function() {
				this.curp = ''
				if ((this.sexo != null) && (this.sexo != undefined) && (this.sexo != '') && (this.sexo.id != 3)) {
					var sex = '';
					var edoArray = ['AS', 'BC', 'BS', 'CC', 'CS', 'CH', 'CL', 'CM', 'DF', 'DG', 'GT', 'GR', 'HG', 'JC', 'MC', 'MN', 'MS', 'NT', 'NL', 'OC', 'PL', 'QT', 'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VZ', 'YN', 'ZS', 'NE'];
					var edo = '';
					switch (this.sexo.id) {
						case 1:
							sex = 'H';
							break;
						case 2:
							sex = "M";
							break;
						default:
							sex = '';
					}
					if (this.nombres != '' && this.primerAp != '' && this.fechaNacimiento != '' && this.estado != null && this.estado != '' && this.sexo != undefined & this.sexo != null) {
						edo = edoArray[this.estado.id - 1];
						var fecha = this.fechaNacimiento;
						var arr = fecha.split('-');
						var curpAuto = generaCurp({
							nombre: this.nombres,
							apellido_paterno: this.primerAp,
							apellido_materno: this.segundoAp,
							sexo: sex,
							estado: edo,
							fecha_nacimiento: [arr[2], arr[1], arr[0]]
						});
						if (curpAuto)
							this.curp = curpAuto;
						(this.$store.state.fisicaEncontrada == true) ? '' : this.searchPersona('curp');
					}
				}
			},
			generarEdad: function() {
				var fechaNacimiento = moment(this.fechaNacimiento);
				var hoy = moment(this.today);
				this.edad = hoy.diff(fechaNacimiento, 'years');
			},
			validateBeforeSubmit() {
				this.$validator.validateAll().then((result) => {
					if (result) {
						this.crearPersona();
						return;
					}
					swal({
						title: '¡Aún no es posible guardar!',
						text: 'Ingrese los campos obligatorios',
						type: 'warning',
						confirmButtonText: 'Entendido'
					});
				});
			},
			CleanFields() {
				this.nacionalidad = {
						"nombre": "MEXICANA",
						"id": 1
					},
					this.estado = {
						"nombre": "VERACRUZ DE IGNACIO DE LA LLAVE",
						"id": 30
					},
					this.municipio = null,
					this.etnia = {
						"nombre": "SIN INFORMACIÓN",
						"id": 13
					},
					this.lengua = {
						"nombre": "SIN INFORMACIÓN",
						"id": 69
					},
					this.interprete = {
						"nombre": "SIN INFORMACIÓN",
						"id": 1
					},
					this.nombres = '',
					this.primerAp = '',
					this.segundoAp = '',
					this.fechaNacimiento = '',
					this.edad = '',
					this.sexo = null,
					this.rfc = '',
					this.homoclave = '',
					this.curp = '',
					this.motivoEstancia = '',
					this.ocupacion = '',
					this.estadoCivil = '',
					this.escolaridad = '',
					this.religion = '',
					this.identificacion = '',
					this.numIdentificacion = '',
					this.alias = '',
					this.telefono = '',
					this.$validator.reset();
			},
			crearPersona: function() {
				// console.log("Entrando a crear persona")
				this.validacionesback = '';
				var urlCrearPersona = this.url + '/' + this.tipo + this.sistema;
				if (this.tipo == 'denunciado' && this.$store.state.edit == true) {
					urlCrearPersona = this.url + '/' + this.tipo + this.sistema + 'edit';
				}
				if (this.tipo != 'qrr') {
					var data = {
						nombres: (this.nombres) ? this.nombres.toUpperCase() : '',
						primerAp: (this.primerAp) ? this.primerAp.toUpperCase() : '',
						segundoAp: (this.segundoAp) ? this.segundoAp.toUpperCase() : '',
						fechaNacimiento: (this.fechaNacimiento) ? this.fechaNacimiento : '',
						edad: (this.edad) ? this.edad : '',
						sexo: (this.sexo) ? this.sexo.id : '',
						rfc: (this.rfc) ? this.rfc : '',
						homo: (this.homoclave) ? this.homoclave : '',
						curp: (this.curp) ? this.curp : '',
						idNacionalidad: (this.nacionalidades) ? this.nacionalidad.id : '',
						idEstadoOrigen: (this.estado) ? this.estado.id : '',
						idMunicipioOrigen: (this.municipio) ? this.municipio.id : '',
						idEtnia: (this.etnia) ? this.etnia.id : '',
						idLengua: (this.lengua) ? this.lengua.id : '',
						idInterprete: (this.interprete) ? this.interprete.id : '',
						motivoEstancia: (this.motivoEstancia) ? this.motivoEstancia.toUpperCase() : '',
						idOcupacion: (this.ocupacion) ? this.ocupacion.id : '',
						idEstadoCivil: (this.estadoCivil) ? this.estadoCivil.id : '',
						idEscolaridad: (this.escolaridad) ? this.escolaridad.id : '',
						idReligion: (this.religion) ? this.religion.id : '',
						docIdentificacion: (this.identificacion) ? this.identificacion.id : '',
						numDocIdentificacion: (this.numIdentificacion) ? this.numIdentificacion.toUpperCase() : '',
						telefono: (this.telefono) ? this.telefono : '',
						alias: (this.alias) ? this.alias.toUpperCase() : '',
						sistema: this.sistema,
						idPersona: this.$store.state.idPersonaFisica,
						usuario: this.usuario,
						personaFisica: this.$store.state.personaFisica,
						idDomicilio: this.$store.state.idDomicilioTemporal,
						idTrabajo: this.$store.state.idTrabajoTemporal,
						idNotificacion: this.$store.state.idContactoTemporal,
						idExtrasConocido: this.$store.state.idExtra,
						carpeta: this.carpeta,
						idCarpeta: this.idcarpeta
					};
				} else {
					var data = {
						sistema: this.sistema,
						usuario: this.usuario,
						carpeta: this.carpeta,
						idCarpeta: this.idcarpeta
					};
				}
				if (data) {
					axios.post(urlCrearPersona, data)
						.then(response => {
							if (response.data) {
								this.$store.commit('asignarIdFisica', {
									idPersona: response.data.original.idVarPersona,
									personaFisica: response.data.original.idPersona
								})
								if (this.tipo == 'conocido') {
									this.$store.commit('asignarIdExtra', response.data.original.idExtra)
								} else if (this.tipo == 'qrr' && response.data.original.idPersona == false && response.data.original.idVarPersona == false) {
									swal({
										title: '¡No fue posible guardar!',
										text: 'Ya existe un qrr registrado en esta carpeta.',
										type: 'warning',
										confirmButtonText: 'Entendido'
									})
									return
								}
								swal({
									title: '¡Guardado correctamente!',
									text: 'Ésta persona fue guardada exitosamente.',
									type: 'success',
									confirmButtonText: 'Entendido'
								})
								if (this.$store.state.fisicaEncontrada) {
									this.getDomicilios()
									this.buscarCarpetasFisica()
								}
							} else {
								swal({
									title: '¡Guardado incorrecto!',
									text: 'Ésta persona no fue posible guardarla.',
									type: 'error',
									confirmButtonText: 'Entendido'
								})
							}
						}).catch((error) => {
							if (error.response.data.errors) {
								this.validacionesback = error.response.data.errors;
							}
							swal({
								title: '¡Guardado incorrecto!',
								text: 'Ésta persona no fue posible guardarla.',
								type: 'error',
								confirmButtonText: 'Entendido'
							})
						});
				}
			}
		},
		watch: {
			sexo() {
				this.generarCurp();
			},
			estado() {
				this.generarCurp();
			},
			lengua() {
				if (this.lengua != null && this.lengua != '') {
					if (this.lengua.id != 69 && this.lengua.id != 70 && this.validaciones.idLengua != 'oculto') {
						this.validaciones.idInterprete = '';
					} else {
						this.validaciones.idInterprete = 'oculto';
					}
				} else {
					this.validaciones.idInterprete = 'oculto';
				}
			},
			fisicaEncontrada() {
				if (this.$store.state.fisicaEncontrada == '') {
					this.CleanFields()
				}
			}
		},
		computed: Object.assign({
			botonGuardarModificar() {
				if (this.$store.state.idPersonaFisica == '' || this.tipo == 'qrr') {
					return 'Guardar'
				} else {
					return 'Modificar'
				}
			},
			coincidenciasText() {
				if (this.personasEncontradas.length == 1) {
					return " Coincidencia"
				} else {
					return " Coincidencias"
				}
			}
		}, mapState(['idPersonaFisica', 'idPersonaMoral', 'fisicaEncontrada', 'personasEncontradas', 'showCoincidencias', 'estadosCatalogo', 'municipiosVer']))
	}
</script>
