<template>
  <footer>
    <span class="copyright">
      <a href="mailto:jmarmentia2010@hotmail.com">© Armentia Propiedades</a>. Todos los Derechos Reservados. | Desarrollado por <a href="mailto:juan.cruz.armentia@gmail.com">Juan Cruz Armentia</a>
    </span>
  </footer>
</template>

<script>
  export default {
    name: 'Footer',
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