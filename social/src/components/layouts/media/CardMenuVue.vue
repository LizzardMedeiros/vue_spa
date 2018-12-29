<template>
  <div>
    <empty-card-vue>
      <grid-vue v-if="image != ''" size="s4 m4">
        <img :src="image" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
      </grid-vue>
      <grid-vue v-if="image != ''" size="s8 m8">
        <span class="black-text">
          <h5>{{name}}</h5>
          <slot/>
        </span>
      </grid-vue>
      <grid-vue v-else size="s12 m12">
        <span class="black-text">
          <h4>{{name}}</h4>
          <hr>
          <slot/>
        </span>
      </grid-vue>
    </empty-card-vue>
  </div>
</template>

<script>

import GridVue from '@/components/layouts/GridVue';
import EmptyCardVue from '@/components/layouts/media/EmptyCardVue';

export default {
  name: 'CardMenuVue',
  props:['image', 'name'],
  components:{GridVue, EmptyCardVue},
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>