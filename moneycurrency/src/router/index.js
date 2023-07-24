import { createRouter, createWebHistory } from "vue-router";

import LoginView from "../views/LoginView.vue";
import DashbordView from "../views/DashbordView.vue";
import TableListPairsView from "../views/TableListPairsView.vue"; 
import TableListCurrencyView from "../views/TableListCurrencyView.vue"; 
import FormCreateCurrencyView from "../views/FormCreateCurrencyView.vue"; 
import FormUpdateCurrency from "../views/FormUpdateCurrency.vue"; 
import FormUpadatePair from "../views/FormUpadatePair.vue";
import FormCreatePairView from "../views/FormCreatePairView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
   
    {
      path: "/",
      name: "login",
      component: LoginView,
      beforeEnter(){
        if (localStorage.getItem("token")) {
            this.$route.push("/dashbord") ;
        }
      }
    },
    
    {
      path: "/dashbord",
      name: "dashbord",
      component: DashbordView,
      beforeEnter(){
        if (localStorage.getItem("token")) {
          this.$route.push("/dashbord-listepair") ;
        }
      }
    },
    {
      path: "/dashbord-listepair",
      name: "listepair",
      component:  TableListPairsView,
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    {
      path: "/dashbord-liste-currency",
      name: "listecurrency",
      component:  TableListCurrencyView,
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    {
      path: "/dashbord-createCurrencie",
      name: "createCurrency",
      component:  FormCreateCurrencyView,
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    
    {
      path: "/dashbord-update-currencie/:id",
      name: "updateCurrency",
      component:  FormUpdateCurrency,
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    {
      path: "/updatepair/:id",
      name: "updatePair",
      component:  FormUpadatePair,
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    {
      path: "/createpair",
      name: "createPair",
      component:  FormCreatePairView,
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },

  ],
});

export default router;
