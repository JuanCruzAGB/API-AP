<template>
  <Flag :class="{
      auth: auth,
      'not-auth': !auth,
    }">
    <template v-if="auth">
      <button @click="logout">
        <span>
          Authenticated
        </span>
      </button>
    </template>

    <template v-else>
      <a :href="url.auth">
        <span>
          Not authenticated
        </span>
      </a>
    </template>
  </Flag>
</template>

<script>
  import axios from "axios";
  import { mapActions, mapGetters, } from "vuex";

  import Flag from "../Flag.vue";

  export default {
    name: 'Auth',
    components: {
      Flag,
    },
    data () {
      return {
        // 
      };
    },
    computed: {
      ...mapGetters([ 'auth', 'url', ]),
    },
    methods: {
      ...mapActions([ 'unauthenticate', ]),
      logout () {
        if (this.auth)
          axios.get(`${ this.url.current }/logout`, {
            headers: {
              'Content-Type': 'application/json',
            },
          }).then(response => {
            this.unauthenticate();
          });
      },
    },
  };
</script>

<style lang="scss" scoped>
  .flag {
    &.auth {
      --color-background: var(--color-green, green);
    }
    &.not-auth {
      --color-background: var(--color-grey, grey);
    }

    * {
      color: var(--color-white, #FFFFFF);
      text-transform: lowercase;
      &::first-letter {
        text-transform: uppercase;
      }
      &:hover {
        text-decoration: none;
      }
    }
  }
</style>