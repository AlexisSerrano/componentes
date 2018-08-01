<template>
    <div class="col">
    
        <h3 class="mb-3">Carpetas encontradas</h3>
        <div class="table-responsive">
    
            <table class="table table-sm table-bordered table-hover">
                <thead class="thead-dark" v-if="this.$store.state.fisicaEncontrada">
                    <tr>
                        <th>Nombres y apellidos</th>
                        <th>R.F.C</th>
                        <th>C.U.R.P</th>
                        <th>Carpeta</th>
                        <th>Sistema</th>
                        <th>Tipo de involucrado</th>
                        <th>N.U.C.</th>
                        <th>Tipo de determinación</th>
                    </tr>
                </thead>
                <thead class="thead-dark" v-if="this.$store.state.moralEncontrada">
                    <tr>
                        <th>Nombre</th>
                        <th>R.F.C.</th>
                        <th>Representante legal</th>
                        <th>Carpeta</th>
                        <th>Sistema</th>
                        <th>Tipo de involucrado</th>
                        <th>N.U.C.</th>
                        <th>Tipo de determinación</th>
                    </tr>
                </thead>
                <tbody v-if="this.$store.state.fisicaEncontrada">
                <tr v-for="(value,index) in carpetas" :key="index">
                        <td>{{ `${value.nombres} ${value.primerAp} ${value.segundoAp}` }}</td>
                        <td>{{ value.rfc }}</td>
                        <td>{{ value.curp }}</td>
                        <td>{{ value.carpeta }}</td>
                        <td>{{ value.sistema }}</td>
                        <td>{{ value.tipoInvolucrado }}</td>
                        <td>{{ value.nuc }}</td>
                        <td>{{ value.determinacion }}
                            <icon name="folder-open" :style="{color:(value.determinacion=='INICIADA')?'#ff6600':(value.determinacion=='ABSTENCION DE INVESTIGAR')?'#009900':(value.determinacion=='ARCHIVO TEMPORAL')?'#ff6600':(value.determinacion=='LA APLICACION DE UN CRITERIO DE OPORTUNIDAD')?'#009900':(value.determinacion=='NO EJERCICIO DE LA ACCION PENAL')?'#009900':(value.determinacion=='POR DETERMINAR')?'#ff6600':(value.determinacion=='EJERCICIO DE LA ACCION PENAL')?'#ff0000':''}"></icon>
                        </td>
                    </tr>
                    <tr v-show="carpetas==''">
                        <td colspan="10" style="text-align:center;">Sin resultados</td>
                    </tr>
                </tbody>
                <tbody v-if="this.$store.state.moralEncontrada">
                    <tr v-for="value in carpetas" :key="value.carpeta">
                        <td>{{ value.nombre }}</td>
                        <td>{{ value.rfc }}</td>
                        <td>{{ `${value.nombreRep} ${value.primerApRep} ${value.segundoApRep}` }}</td>
                        <td>{{ value.carpeta }}</td>
                        <td>{{ value.sistema }}</td>
                        <td>{{ value.tipoInvolucrado }}</td>
                        <td>{{ value.nuc }}</td>
                        <td> {{ value.determinacion }}
                            <icon name="folder-open" :style="{color:(value.determinacion=='INICIADA')?'yellow':''}"></icon>
                        </td>
                    </tr>
                    <tr v-show="carpetas==''">
                        <td colspan="10" style="text-align:center;">Sin resultados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>
    import {
        mapState
    } from "vuex";
    export default {
        data() {
            return {
                carpetas: ''
            }
        },
        watch: {
            carpetasLigadas() {
                this.carpetas = this.$store.state.carpetasLigadas
            }
        },
        computed: mapState(['carpetasLigadas'])
    }
</script>