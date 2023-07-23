<template>
  <section>
    <div class="card-body">
      <div class="mb-4">
        <div class="d-flex mb-2">
          <h5 class="card-title flex-grow-1">
            Formulaire de modification d'une paire
          </h5>
        </div>

        <form class="row g-3" @submit.prevent="updatePair">
          <div class="col-6">
            <label for="currency_from" class="form-label"
              >Devise de depart</label
            >
            <div v-if="infosData.currency_from">
              <input
                readonly
                type="text"
                class="form-control"
                id="rate"
                :value="infosData.currency_from.exchange_code"
                disabled="disabled"
              />
            </div>
          </div>
          <div class="col-6">
            <label for="currency_to" class="form-label">Devise d'arrivée</label>
            <div v-if="infosData.temp">
              <input
                readonly
                type="text"
                class="form-control"
                id="rate"
                :value="infosData.temp.exchange_code"
                disabled="disabled"
              />
            </div>
          </div>
          <div class="col-6">
            <label for="rate" class="form-label">Taux d'échange</label>

            <input
              v-model="infosData.rate"
              required
              type="text"
              class="form-control"
              id="rate"
            />
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">
               Mettre à jour
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      currencies: [],
      infosData: {
        currency_id_from: "",
        id_to: "",
        rate: "",
      },
    };
  },

  mounted() {
    this.getPair();
  },
  methods: {
    async getPair() {
      this.id = this.$route.params.id;
      await axios
        .get(`http://127.0.0.1:8000/api/pairs/${this.id}`)
        .then((response) => {
          this.infosData = response.data.data;
        });
      this.getCurrencyTo(this.infosData.currency_id_to);
      this.getCurrencyFrom(this.infosData.currency_id_from);
    },
    async getCurrencyFrom(id) {
      await axios
        .get(`http://127.0.0.1:8000/api/currencies/${id}`)
        .then((resp) => {
          let currency_from = resp.data.data;
          this.infosData = { currency_from, ...this.infosData };
        });
    },
    async getCurrencyTo(id) {
      await axios
        .get(`http://127.0.0.1:8000/api/currencies/${id}`)
        .then((resp) => {
          let temp = resp.data.data;
          this.infosData = { temp, ...this.infosData };
          console.log("infosData",this.infosData)
        });
    },

    //updating
    async updatePair() {
      this.id = this.$route.params.id;
      console.log("infosData rate",this.infosData.rate)
      await axios
        .put(`http://127.0.0.1:8000/api/pairs/${this.id}`, {
          currency_id_from:this.infosData.currency_id_from,
          currency_id_to:this.infosData.currency_id_to,
          rate: this.infosData.rate,
        })
        .then((response) => {
          console.log("réussi !")
           this.$router.push("/dashbord-listepair");
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        });
    },
  },
};
</script>

<style>
</style>