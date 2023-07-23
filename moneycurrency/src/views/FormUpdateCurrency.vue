<template>
  <section>
    <div class="card-body">
      <div class="mb-4" >
        <div class="d-flex mb-2">
          <h5 class="card-title flex-grow-1">
            Formulaire de modification d'une devise
          </h5>
        </div>
        <!-- @submit.prevent lors de la soumission du formulaire on annule tout comportement par defaut et on applle la fonction submitStudent-->
        <form class="row g-3" @submit.prevent="update">
          <div class="col-6">
            <label for="name" class="form-label">Devise</label>
            <input
              v-model="formData.currency_name"
              required
              type="text"
              class="form-control"
              id="name"
            />
          </div>
          <div class="col-6">
            <label for="code" class="form-label">Code devise</label>
            <input
              v-model="formData.exchange_code"
              required
              type="text"
              class="form-control"
              id="code"
            />
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">
               Modifier
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
      formData: {
        name: "",
        code: "",
      },
    };
  },
  mounted(){
      this.getCurrency()
  },
  methods: {
    getCurrency(){
       this.id = this.$route.params.id;
      console.log("this.id",this.id)
      axios.get(`http://127.0.0.1:8000/api/currencies/${this.id}`)
      .then(response=>{
        console.log(response.data.data)
        this.formData = response.data.data
        })

    },
    update() {
      this.id = this.$route.params.id;
      axios
        .put(`http://127.0.0.1:8000/api/currencies/${this.id}`,{
          currency_name:this.formData.currency_name,
          exchange_code:this.formData.exchange_code

        })
        .then((response) => {
          console.log(response.data);
           this.$router.push("/dashbord-liste-currency");
           
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