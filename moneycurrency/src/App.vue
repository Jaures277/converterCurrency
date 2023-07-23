<script setup>
import { RouterLink, RouterView } from "vue-router";
import Dashbord from "@/components/Dashbord.vue";

import { useRouter } from 'vue-router'
import { onMounted, reactive, watch } from 'vue'

const router = useRouter()

const state = reactive({
    isLogged: false,
})

const defaultRoute = () => {
    const token = localStorage.getItem('token')
    console.log("token app",token)
    if (token !== null) {
        state.isLogged = true
    } else {
        router.push('/')
    }
}


onMounted(() => {
    defaultRoute();
})

watch(() => state, (isLogged, oldIsLogged) => {
    console.log(`isLogged is: ${isLogged}`)
  }
)

</script>

<template>
  <div> 
      <div v-if="state.isLogged">
           <Dashbord/>
      </div>
      <div v-else>
           <RouterView /> 
      </div> 
  </div> 
</template>

<style >
@import "@/assets/base.css";


#app {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0;
  font-weight: normal;
}
</style>

