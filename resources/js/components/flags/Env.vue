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
      --color-background: var(--color-grey, grey);
    }
    &.local {
      --color-background: var(--color-green, green);
    }
    &.production {
      --color-background: var(--color-red, red);
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