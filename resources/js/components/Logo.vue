<template>
  <RouterLink :to="{
      name: 'Home',
    }"
    class="logo">
    <img :alt="`${ name } logo`"
      :src="logo">

    <template v-if="showName">
      {{ name }}
    </template>
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
        name: 'API | Armentia Propiedades',
      };
    },
    computed: {
      ...mapGetters([ 'media', ]),
      logo () {
        switch (this.media) {
          case 'desktop':
            return this._provided.images.logo.regular.default;

          default:
            return this._provided.images.logo.small.default;
        }
      },
    },
  }
</script>

<style lang="scss" scoped>
  .logo {
    /*  */
  }
</style>