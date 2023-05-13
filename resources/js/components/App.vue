<template>
  <div class="app">
    <RouterView />
  </div>
</template>

<script>
  import { mapActions, } from 'vuex';

  export default {
    name: 'App',
    methods: {
      ...mapActions([ 'resize', ]),
    },
    beforeMount () {
      this.resize();

      window.addEventListener('resize', () => {
        this.resize();
      });
    },
  };
</script>

<style lang="scss" scoped>
  .app {
    // 
  }
</style>