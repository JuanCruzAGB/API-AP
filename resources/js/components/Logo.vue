<template>
  <RouterLink class="logo"
    :to="{
      name: 'Layout',
    }">
    <img :alt="`${ name } logo`"
      :src="logo">

    <h1 :class="{
        hidden: !showName,
      }">
      {{ name }}
    </h1>
  </RouterLink>
</template>

<script>
  import { mapGetters, } from 'vuex';

  export default {
    name: 'Logo',
    props: {
      showName: {
        default: false,
        required: false,
      },
    },
    data () {
      return {
        name,
      };
    },
    computed: {
      ...mapGetters([ 'isDesktop', ]),
      logo () {
        if (this.isDesktop) {
          return this._provided.images.logo.regular.default;
        }

        return this._provided.images.logo.small.default;
      },
    },
  }
</script>

<style lang="scss" scoped>
  .logo {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
  }
</style>