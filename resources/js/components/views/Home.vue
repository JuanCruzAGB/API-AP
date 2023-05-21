<template>
  <div class="home view bg-white">
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

    <RouterView />

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
    name: 'Home',
    components: {
      AuthFlag,
      EnvFlag,
      FloatMenu,
      Footer,
      Header,
    },
    data () {
      return {
        // 
      };
    },
    computed: {
      ...mapGetters([ 'env', 'url', ]),
      showFlags () {
        return [ 'development', 'local' ].includes(this.env);
      },
    },
    methods: {
      ...mapActions([ 'authenticate', ]),
      login () {
        let formData = new FormData();

        formData.append("email", "juan.cruz.armentia@gmail.com");
        formData.append("password", "AP40538177");

        axios.post(`${ this.url.current }/login`, formData, {
          headers: {
            'Content-Type': 'application/json',
          },
        }).then(response => {
          this.authenticate();
        });
      },
    },
    beforeMount () {
      this.login();
    },
  }
</script>

<style lang="scss" scoped>
  .home.view {
    header {
      height: calc(100vh - var(--height));
    }

    .float.menu {
      padding: .5rem 0;
    }
  }
</style>