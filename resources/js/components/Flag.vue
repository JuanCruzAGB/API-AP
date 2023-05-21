<template>
  <div class="flag">
    <slot />
  </div>
</template>

<script>
  export default {
    name: 'Flag',
  };
</script>

<style lang="scss" scoped>
  .flag {
    position: relative;
    right: -.25rem;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    height: 2.25rem;
    background-color: var(--color-background, grey);
    color: var(--color-font, #FFFFFF);
    font-family: var(--work-sans);
    font-size: .8rem;
    padding: .5rem;
    transition: right 500ms;
    &:hover {
      right: 0;
    }
    &.pointer {
      cursor: pointer;
    }

    &::before {
      content: '';
      position: absolute;
      top: 0;
      right: 100%;
      width: 0;
      height: 0;
      border-top: 1.125rem solid var(--color-background, grey);
      border-bottom: 1.125rem solid var(--color-background, grey);
      border-left: .5rem solid transparent;
    }
  }
</style>