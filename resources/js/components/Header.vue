<template>
  <header>
    <Logo />
  </header>
</template>

<script>
  import Logo from "./Logo.vue";

  export default {
    name: 'Header',
    components: {
      Logo,
    },
  }
</script>

<style lang="scss" scoped>
  header {
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>