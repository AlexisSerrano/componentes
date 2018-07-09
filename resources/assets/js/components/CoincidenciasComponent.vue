<template>

<div class="col">

  <h3 class="mb-3">Coincidencias</h3>         
  <table class="table table-bordered table-hover">
    <thead class="thead-dark">
      <tr>
        <th>Nombres</th>
        <th>Primer apellido</th>
        <th>Segundo apellido</th>
        <th>Fecha de nacimiento</th>
        <th>Edad</th>
        <th>Sexo</th>
        <th>R.F.C</th>
        <th>C.U.R.P</th>
        <th>Nacionalidad</th>
        <th>Estado</th>
        <th>Municipio</th>

      </tr>
    </thead>
    <tbody >
      <tr v-for="coincidencia in coincidencias" :key="coincidencia.curp">
        <td>{{ coincidencia.nombres }}</td>
        <td>{{ coincidencia.primerAp }}</td>
        <td>{{ coincidencia.segundoAp }}</td>
        <td>{{ coincidencia.fechaNacimiento }}</td>
        <td>{{ coincidencia.edad }}</td>
        <td>{{ coincidencia.sexo }}</td>
        <td>{{ coincidencia.rfc }}</td>
        <td>{{ coincidencia.curp }}</td>
        <td>{{ coincidencia.idNacionalidad.nombre }}</td>
        <td>{{ coincidencia.idEstado.nombre }}</td>
        <td>{{ coincidencia.idMunicipioOrigen.nombre }}</td>
      </tr>
    </tbody>
  </table>
</div>

</template>


<script>
import { mapState } from "vuex";
    export default {
      data() {
        return {
          coincidencias:''
        }
      },
      watch: {
        personasEncontradas() {
          this.coincidencias=this.$store.state.personasEncontradas
        }
      },
      computed:mapState(['personasEncontradas'])
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