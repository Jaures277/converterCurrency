<template>
  <section>
    <div>
      <RouterLink
        class="btn btn-sm round btn-outline-success"
        to="/dashbord-createCurrencie"
      >
        Ajouter une devise
      </RouterLink>
    </div>
    <div class="header">
      <h2>Listes de devises</h2>
    </div>
    <div class="table-responsive">
      <table
        class="table table-hover js-basic-example dataTable table-custom mb-0"
      >
        <thead class="thead-dark">
          <tr>
            <th>Id</th>
            <th>Devise</th>
            <th>Code</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="currency in currencies" :key="currency.id">
            <td>{{ currency.id }}</td>
            <td>
              {{ currency.currency_name }}
            </td>
            <td>
              {{ currency.exchange_code }}
            </td>
            <td>
              <router-link
                :to="`/dashbord-update-currencie/${currency.id}`"
                class="btn btn-sm round btn-outline-success"
              >
                Modifier
              </router-link>
              <button
                type="button"
                class="btn btn-sm round btn-outline-danger"
                @click.prevent="deleteCurrency(currency.id)"
              >
                Suppression
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
  name: "TableListCurrency",
  data() {
    return {
      currencies: [],
    };
  },
  mounted() {
    this.getCurrencies();
  },
  methods: {
    deleteCurrency(id) {
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
              .delete(`http://127.0.0.1:8000/api/currencies/${id}`)
              .then((res) => {
               
                let i = this.currencies.map((data) => data.id).indexOf(id);
                this.currencies.splice(i, 1);
                
              })
              .catch((error) => {
                console.log(error);
              });
          }
        });
    },
    async getCurrencies() {
      await axios.get("http://127.0.0.1:8000/api/currencies").then((res) => {
        this.currencies = res.data.currencies;
        console.log("response", res.data.currencies);
      });
    },
  },
};
</script>

<style>
</style>