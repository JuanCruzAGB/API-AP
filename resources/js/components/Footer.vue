<template>
  <footer>
    <span class="copyright">
      <a :href="`mailto:${ contact.email }`">© Armentia Propiedades</a>. Todos los Derechos Reservados. | Desarrollado por <a :href="`mailto:${ contact.developer }`">Juan Cruz Armentia</a>
    </span>
  </footer>
</template>

<script>
  import { mapGetters, } from "vuex";

  export default {
    name: 'Footer',
    computed: {
      ...mapGetters([ 'contact', ]),
    },
  }
</script>

<style lang="scss" scoped>
  footer {
    display: flex;
    align-items: center;
    justify-content: center;
    height: var(--height);

    .copyright {
      color: var(--black, black);
      font-size: var(--work-sans, sans-serif);
    }
  }
</style>