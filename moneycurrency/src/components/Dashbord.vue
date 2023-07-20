<template>
  
  <section>
   
    <input type="checkbox" name="" id="menu" />
    <div class="sidebar">
      <div class="sidebar-brand">
        <h2><span class="fa fa-user-o"> </span> MoneyValue</h2>
      </div>

      <div class="sidebar-menu">

        <nav>
           
          <ul>
            <li :class="{ active: selected === 'login' }">
              <RouterLink to="/dashbord-listepair">
                 <span></span><span>Paires</span>
              </RouterLink>
            </li>
            <li :class="{ active: selected === 'listecurrency' }">
              <RouterLink  to="/dashbord-liste-currency"
                > <span></span><span>Devise</span></RouterLink
              >
            </li>
            <!-- <li>
              <a href="#" class="active">Accueil</a>
            </li> -->
          </ul>
        </nav>
      </div>
    </div>
    <div class="content">
      <header>
        <p>
          <label for="menu"><span class="fa fa-bars"></span></label
          ><span class="accueil">Accueil</span>
        </p>

        <div id="dropdown" class="user-wrapp">
          <button
            type="submit"
            @click="logout"
            class="btn btn-outline-success"
          >
            Déconnexion
          </button>
        </div>
      </header>
      <main>
        <div class="col-lg-12 col-md-12 col-sm-12 m-2 p-2">
          <div class="card">
            <div class="body">
              <RouterView />
            </div>
          </div>
        </div>
      </main>
    </div>
  </section>
</template>




<script>
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "../assets/style_dashbord.css";
import axios from "axios";
import { ref, onMounted } from "vue";
 
export default {
  data() {

    return {
      token: null,
    };
  },
  methods: {
    logout() {
        let inMemoryToken = localStorage.getItem('token')
        fetch("http://127.0.0.1:8000/api/logout",{
        method: 'post',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${inMemoryToken}`
        },
    } )
    .then(res=>res.json())
    .then( res =>{
          localStorage.removeItem('token')
           window.location.href="/dashbord-listepairs"
          
          })
          .catch(err => console.log(err));
    },
  },
};
// reactive state
const selected = ref("home");

// functions that mutate state and trigger updates
function setSelected(value) {
  selected.value = value;
}

// lifecycle hooks
onMounted(() => {
  console.log(`Au chargement du composant, 
        "selected" a pour valeur ${selected.value}.`);
});
</script> 

<style>
</style>