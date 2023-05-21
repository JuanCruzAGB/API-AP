<template>
  <div :class="positions"
    class="float menu">
    <slot />
  </div>
</template>

<script>
  export default {
    name: 'Float',
    props: {
      position: {
        default () {
          return [ "top", "right", ];
        },
        required: false,
        type: String|Array,
      },
    },
    computed: {
      positions () {
        let positions = !Array.isArray(this.position)
          ? [ this.position, ]
          : this.position;

        return positions.reduce((position, key) => {
          position[key] = true;

          return position;
        }, {});
      },
    },
  };
</script>

<style lang="scss" scoped>
  .float.menu {
    position: fixed;
    padding: .5rem;
    &.top {
      top: 0;
    }
    &.bottom {
      bottom: 0;
    }
    &.left {
      left: 0;
    }
    &.right {
      right: 0;
    }
  }
</style>