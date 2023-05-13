import Vue from 'vue';
import VueRouter from "vue-router";

import router from "./router.js";

import store from "./store/index.js";

import logoRegularDefault from "../assets/images/logo/01-regular.png";
import logoRegularWhite from "../assets/images/logo/02-regular-white.png";
import logoSmallDefault from "../assets/images/logo/03-small.png";
import logoSmallWhite from "../assets/images/logo/04-small-white.png";
import propertySample from "../assets/images/sample.png";

import App from "./components/App.vue";

Vue.use(VueRouter);

const app = new Vue({
  el: '#app',
  template: `<App />`,
  components: {
    App,
  },
  provide: {
    images: {
      logo: {
        regular: {
          default: logoRegularDefault,
          white: logoRegularWhite,
        },
        small: {
          default: logoSmallDefault,
          white: logoSmallWhite,
        },
      },
      property: {
        sample: propertySample,
      },
    },
  },
  store,
  router,
});