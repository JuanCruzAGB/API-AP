<template>
  <div class="home view bg-white">
    <Header />

    <RouterView />

    <Footer />
  </div>
</template>

<script>
  import Footer from "../Footer.vue";
  import Header from "../Header.vue";

  export default {
    name: 'Home',
    components: {
      Footer,
      Header,
    },
  }
</script>

<style lang="scss" scoped>
  .home.view {
    header {
      height: calc(100vh - var(--height));
    }
  }
</style>