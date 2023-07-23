<template>
  <section>
    <div>
      <RouterLink to="/createpair" class="btn btn-sm round btn-outline-success">
        Ajouter une paire
      </RouterLink>
    </div>
    <div class="header">
      <h2>Listes de paires</h2>
    </div>
    <div class="table-responsive">
      <table
        class="table table-hover js-basic-example dataTable table-custom mb-0"
      >
        <thead class="thead-dark">
          <tr>
            <th>Id</th>
            <th>Paires</th>
            <th>Taux d'echanges</th>
            <th>Nombre de conversion</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pair in pairs" :key="pair.id">
            <td>{{ pair.id }}</td>
            <td>
              {{ pair.currency_from.exchange_code }} -
              {{ pair.currency_to.exchange_code }}/
              {{ pair.currency_to.exchange_code }} -
              {{  pair.currency_to.exchange_code }}
            </td>
            <td>{{ pair.rate }}</td>
            <td>{{ pair.exchange_number }}</td>
            <td>
              <router-link
                :to="`/updatepair/${pair.id}`"
                class="btn btn-sm round btn-outline-success"
              >
                Modifier
              </router-link>
              <button
                type="button"
                class="btn btn-sm round btn-outline-danger"
                @click.prevent="deletePair(pair.id)"
              >
                Supprimer
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="showFormCreatePair">
      <FormCreatePair />
    </div>
  </section>
</template>

<script>
import axios from "axios";
import Swal from 'sweetalert2'
export default {
  name: "TableListPairs",

  data() {
    return {
      pairs: [],
    };
  },
  mounted() {
    this.getPairs();
  },
  methods: {
    deletePair(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Es-tu sûr de vouloir supprimer?",
          text: "Verifiez bien votre choix",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Oui, supprimer",
          cancelButtonText: "Non, annuler!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
            .delete(`http://127.0.0.1:8000/api/pairs/${id}`)
            .then((res) => {
              console.log("réussi");
              // this.getPairs()
              let i = this.pairs.map((data) => data.id).indexOf(id);
              this.pairs.splice(i, 1);
            })
            .catch((error) => {
              console.log(error);
            });

          } 
        });

    
    },
    async getPairs() {
      console.log("ici");
      await axios.get("http://127.0.0.1:8000/api/pairs").then((res) => {
        this.pairs = res.data.currencies;
        console.log("response this.pairs", this.pairs);
      });
    },
  },
};
</script>

<style>
</style> 