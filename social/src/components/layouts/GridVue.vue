<template>
  <div :class="'col '+size || s12">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'GridVue',
  props:['size'],
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>