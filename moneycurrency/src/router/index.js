import { createRouter, createWebHistory } from "vue-router";

import LoginView from "../views/LoginView.vue";
import DashbordView from "../views/DashbordView.vue";
import TableListPairsView from "../views/TableListPairsView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
   
    {
      path: "/",
      name: "login",
      component: () => import("../views/LoginView.vue"),
      beforeEnter(){
        if (localStorage.getItem("token")) {
            this.$route.push("/dashbord") ;
            
        }
      }
    },
    
    {
      path: "/dashbord",
      name: "dashbord",
      
      component: () => import("../views/DashbordView.vue"),
      
    },
    {
      path: "/dashbord-listepair",
      name: "listepair",
      component:  () => import("../views/TableListPairsView.vue"),
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    {
      path: "/dashbord-liste-currency",
      name: "listecurrency",
      component:  () => import("../views/TableListCurrencyView.vue"),
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    {
      path: "/dashbord-createCurrencie",
      name: "createCurrency",
      component:  () => import("../views/FormCreateCurrencyView.vue"),
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    
    {
      path: "/dashbord-update-currencie/:id",
      name: "updateCurrency",
      component:  () => import("../views/FormUpdateCurrency.vue"),
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    {
      path: "/updatepair/:id",
      name: "updatePair",
      component:  () => import("../views/FormUpadatePair.vue"),
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    {
      path: "/createpair",
      name: "createPair",
      component:  () => import("../views/FormCreatePairView.vue"),
      beforeEnter(){
        if (localStorage.getItem("token") == null) {
            return {path:"/"};
        }
      }
    },
    

  ],
});

export default router;
