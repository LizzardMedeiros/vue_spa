<template>
  <div class="card">
    <div class="card-content">
      <div class="row">
        <grid-vue class="input-field" size="s12 m12">
          <i class="material-icons prefix">mode_edit</i>
          <textarea v-model="text" class="materialize-textarea"></textarea>
          <label>O que você está pensando?</label>
        </grid-vue>
        <grid-vue v-if="text" class="btn waves-effect waves-light scale-transition" size="s3 offset-s9 m3 offset-m9" type="submit" name="action">Enviar <i class="material-icons right">send</i>
        </grid-vue>
      </div>
    </div>
  </div>
</template>

<script>

import GridVue from '@/components/layouts/GridVue';

export default {
  name: 'NewPublicationVue',
  props:[],
  components:{GridVue},
  data () {
    return {
      text:""
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>