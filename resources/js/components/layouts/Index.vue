<template>
  <div class="index layout">
    <Header />

    <FloatMenu v-if="showFlags">
      <ul class="list grid gap-2">
        <li class="item">
          <AuthFlag />
        </li>

        <li class="item">
          <EnvFlag />
        </li>
      </ul>
    </FloatMenu>

    <main>
      <RouterView />
    </main>

    <Footer />
  </div>
</template>

<script>
  import { mapActions, mapGetters, } from "vuex";

  import Footer from "../Footer.vue";
  import Header from "../Header.vue";
  import AuthFlag from "../flags/Auth.vue";
  import EnvFlag from "../flags/Env.vue";
  import FloatMenu from "../menus/Float.vue";

  export default {
    name: 'Index',
    components: {
      AuthFlag,
      EnvFlag,
      FloatMenu,
      Footer,
      Header,
    },
    computed: {
      ...mapGetters([ 'env', 'url', ]),
      showFlags () {
        return [ 'development', 'local' ].includes(this.env);
      },
    },
    methods: {
      ...mapActions([ 'authenticate', ]),
    },
  }
</script>

<style lang="scss" scoped>
  .index.layout {
    header {
      height: calc(100vh - var(--height));
    }

    .float.menu {
      padding: .5rem 0;
    }
  }
</style>