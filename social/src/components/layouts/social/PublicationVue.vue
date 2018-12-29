<template>
	<div class="card">
        <div class="card-content white-text">
			<empty-card-vue>
		      <grid-vue size="s3 m1">
		        <img :src="image" alt="" class="circle responsive-img">
		      </grid-vue>
		      <grid-vue size="s9 m11">
		        <span class="black-text">
		          <strong>{{name}}</strong> - <small>{{time}}</small>
		        </span>
		      </grid-vue>
		    </empty-card-vue>
		    <slot/>
        </div>
        <div class="card-action">
          <i class="material-icons">favorite_border</i>
          <i class="material-icons">message</i>
        </div>
    </div>
</template>

<script>
import EmptyCardVue from '@/components/layouts/media/EmptyCardVue';
import GridVue from '@/components/layouts/GridVue';
export default {
  name: 'PublicationVue',
  props:['image','name','time'],
  components:{EmptyCardVue, GridVue},
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>