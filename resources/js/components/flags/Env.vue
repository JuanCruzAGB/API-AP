<template>
  <Flag :class="env">
    <a :href="href">
      <span>
        {{ env }}
      </span>
    </a>
  </Flag>
</template>

<script>
  import { mapGetters, } from "vuex";

  import Flag from "../Flag.vue";

  export default {
    name: 'Env',
    components: {
      Flag,
    },
    data () {
      return {
        // 
      };
    },
    computed: {
      ...mapGetters([ 'env', 'url', ]),
      href () {
        switch (this.env.toLowerCase()) {
          case 'development':
            return this.url.local;

          case 'local':
            return this.url.development;
        }
      },
    },
  };
</script>

<style lang="scss" scoped>
  .flag {
    &.development {
      --bg-color: var(--grey, grey);
    }
    &.local {
      --bg-color: var(--color-green, green);
    }
    &.production {
      --bg-color: var(--red, red);
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
  }
</style>