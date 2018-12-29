<template>
	<span>
		<div v-if="image" class="card-image">
		  <img :src="image">
		  <span class="card-title">{{title}}</span>
		</div>
		<div class="card-content black-text">
		  <p><slot/></p>
		</div>
	</span>
</template>

<script>
export default {
  name: 'ContentVue',
  props:['image', 'title'],
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>