import VueRouter from "vue-router";

import Layout from "./components/layouts/Index.vue";

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      name: 'Layout',
      path: '/',
      component: Layout,
    }
  ],
});