<template>
  <section>
    <div class="card-body">
      <div class="mb-4">
        <div class="d-flex mb-2">
          <h5 class="card-title flex-grow-1">
            Formulaire de création d'une paire
          </h5>
        </div>

        <form class="row g-3" @submit.prevent="createPair">
          <div class="col-6">
            <label for="currency_from" class="form-label"
              >Devise de depart</label
            >
            
            <select v-model="infosData.id_from" required id="currency_from" class="form-select" >
             
             <option v-for="currency in currencies" :key="currency.id"  :value="currency.id">{{currency.exchange_code}}</option>
              
            </select>
          </div>
          <div class="col-6">
            <label for="currency_to" class="form-label">Devise d'arrivée</label>
           
            <select v-model="infosData.id_to"  required id="currency_to" class="form-select">
               <option v-for="currency in currencies" :key="currency.id"  :value="currency.id">{{currency.exchange_code}}</option>
             
            </select>
          </div>
          <div class="col-6">
            <label for="rate" class="form-label">Taux d'échange</label>
           
            <input  v-model="infosData.rate" required type="text" class="form-control" id="rate" />
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">
              Créer
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
        id_from: "",
        id_to: "",
        rate:""
      },
    };
  },

  mounted() {
    this.getPair();
  },
    methods: {

    createPair() {
      console.log("this.infosData.currency_id_from",this.infosData.id_from)
      console.log("this.infosData.currency_id_to",this.infosData.id_to)
      console.log("this.infosData.rate",this.infosData.rate)
      axios
        .post("http://127.0.0.1:8000/api/pairs",{
           currency_id_from:this.infosData.id_from,
           currency_id_to:this.infosData.id_to,
           rate:this.infosData.rate
        })
        .then((res) => {
          console.log("réussi");
          this.$router.push('/dashbord-listepair')
          // this.route.push("/dashbord-listepair")
          // this.getPairs()
          // let i = this.pairs.map((data) => data.id).indexOf(id);
          // this.pairs.splice(i, 1);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async getPair() {
      await axios.get("http://127.0.0.1:8000/api/currencies").then((res) => {
        this.currencies = res.data.currencies;
        
        console.log("response", this.currencies);
      });
    },
  },

};
</script>

<style>
</style>