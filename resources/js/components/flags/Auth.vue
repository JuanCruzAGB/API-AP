<template>
  <Flag :class="{
      auth: auth,
      'not-auth': !auth,
    }">
    <template v-if="auth">
        <span v-if="isMobile">
          Auth
        </span>

        <span v-else>
          Authenticated
        </span>
      </button>
    </template>

    <template v-else>
      <a class="crossed"
        :href="url.auth">
        <span v-if="isMobile">
          Auth
        </span>

        <span v-else>
          Authenticated
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
      ...mapGetters([ 'auth', 'isMobile', 'url', ]),
    },
    methods: {
      ...mapActions([ 'unauthenticate', ]),
      logout () {
        if (this.auth)
          axios
            .get(`${ this.url.current }/logout`, {
              headers: {
                'Content-Type': 'application/json',
              },
            })
            .then(response => {
              this.unauthenticate();
            });
      },
    },
  };
</script>

<style lang="scss" scoped>
  .flag {
    &.auth {
      --bg-color: var(--color-green, green);
    }
    &.not-auth {
      --bg-color: var(--grey, grey);
    }

    * {
      color: var(--white, white);
      text-transform: lowercase;
      &::first-letter {
        text-transform: uppercase;
      }
      &:hover {
        text-decoration: none;
      }
    }

    .crossed {
      text-decoration: 1px line-through var(--black, black);
    }
  }
</style>