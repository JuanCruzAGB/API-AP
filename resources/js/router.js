import VueRouter from "vue-router";

import Layout from "./components/layouts/Index.vue";

import Home from "./components/views/Home.vue";

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      name: 'Layout',
      path: '/',
      component: Layout,
      children: [
        {
          name: 'Home',
          path: '',
          component: Home,
        },
      ],
    }
  ],
});