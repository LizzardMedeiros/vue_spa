<template>
  <nav :class="color || blue">
    <div class="nav-wrapper container">
      <router-link :to="logourl" class="brand-logo">{{logo || 'Insert Logo'}}</router-link>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <slot/>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
  props:['logo', 'logourl', 'color'],
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
