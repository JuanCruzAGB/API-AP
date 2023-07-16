<template>
  <aside class="float menu"
    :class="positions">
    <slot />
  </aside>
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
        let positions = [];

        if (!Array.isArray(this.position))
          positions = [ this.position, ];

        else
          positions = [ ...this.position, ];

        return positions
          .reduce((position, key) => {
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