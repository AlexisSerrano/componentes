<template>
<div class="container">
    <input v-model="alias" v-on:blur="search()">
    <div id="r-td-1"></div>
</div>
</template>
<script>
import { execn, draw } from "rendata";
export default {
  data() {
    return {
      alias: ""
    };
  },
  mounted() {},
  methods: {
    search: function() {
      let dt = {
        url: "/api/SearchUndefined",
        params: {
          columns: [
            { name: "id", show: false },
            { name: "nombre", replace: "nombre del sistema", show: true },
            {
              name: "descripcion",
              replace: "descripcion del sistema",
              show: true
            }
          ],
          tablename: "sistemas",
          limit: 2
        },
        options: {
          title: "Opciones",
          links: [
            {
              text: "consola",
              func: function(obj) {
                console.log(obj);
              }
            }
          ]
        }
      };
      execn(dt, 0)
        .then(datatable => {
          dt = datatable;
        })
        .catch(datatable => {
          dt = datatable;
        })
        .finally(() => {
          console.log(dt);
          draw(dt, 1);
        });
    }
  }
};
</script>