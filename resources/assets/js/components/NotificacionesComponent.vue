<template>

<div class="col">

  <h3 class="mb-3">Carpetas encontradas</h3>         
  <table class="table table-bordered table-hover">
    <thead class="thead-dark" v-if="this.$store.state.fisicaEncontrada">
      <tr>
        <th>Nombres</th>
        <th>Primer apellido</th>
        <th>Segundo apellido</th>
        <th>R.F.C.</th>
        <th>C.U.R.P.</th>
        <th>ID Carpeta</th>
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
        <th>ID Carpeta</th>
        <th>Sistema</th>
        <th>Tipo de involucrado</th>
        <th>N.U.C.</th>
        <th>Tipo de determinación</th>
      </tr>
    </thead>
    <tbody v-if="this.$store.state.fisicaEncontrada" >
      <tr v-for="value in carpetas" :key="value.idCarpeta">
        <td>{{ value.nombres }}</td>
        <td>{{ value.primerAp }}</td>
        <td>{{ value.segundoAp }}</td>
        <td>{{ value.rfc }}</td>
        <td>{{ value.curp }}</td>
        <td>{{ value.idCarpeta }}</td>
        <td>{{ value.sistema }}</td>
        <td>{{ value.tipoInvolucrado }}</td>
        <td>{{ value.nuc }}</td>
        <td>{{ value.determinacion }}
        <icon name="folder-open" :style="{color:(value.determinacion=='INICIADA')?'yellow':''}"></icon>
        </td>
      </tr>
      <tr v-show="carpetas==''" ><td colspan="10" style="text-align:center;">Sin resultados</td></tr>
    </tbody>
    <tbody v-if="this.$store.state.moralEncontrada">
      <tr  v-for="value in carpetas" :key="value.idCarpeta">
        <td>{{ value.nombre }}</td>
        <td>{{ value.rfc }}</td>
        <td>{{ value.representanteLegal }}</td>
        <td>{{ value.idCarpeta }}</td>
        <td>{{ value.sistema }}</td>
        <td>{{ value.tipoInvolucrado }}</td>
        <td>{{ value.nuc }}</td>
        <td>
          <icon name="folder-open" :style="{color:(value.tipoDeterminacion=='INICIADA')?'yellow':''}"></icon>
          {{ value.tipoDeterminacion }}
        </td>
      </tr>
      <tr v-show="carpetas==''" ><td colspan="10" style="text-align:center;">Sin resultados</td></tr>
    </tbody>
  </table>
</div>

</template>


<script>
import swal from 'sweetalert2'
import { mapState } from "vuex";
    export default {
        data(){
            return{
                url:'./api',
                carpetas:''         
            }
        },
        watch: {
            carpetasLigadas() {
                this.carpetas=this.$store.state.carpetasLigadas
            }
        },
        computed:mapState(['carpetasLigadas'])
    }
</script>
<style>
  th{
    text-align: center
  }
  td{
    text-align: center
  }
</style>