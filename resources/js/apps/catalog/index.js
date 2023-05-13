import Vue from 'vue';
import VueRouter from "vue-router";

import router from "./router.js";

import store from "./store";

import App from "../../components/App.vue";

Vue.use(VueRouter);

const app = new Vue({
  el: '#app',
  template: `<App />`,
  components: {
    App,
  },
  store,
  router,
});