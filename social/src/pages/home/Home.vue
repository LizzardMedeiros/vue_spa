<template>
  <timeline-template>
    
    <span slot="menu">
      <card-menu-vue 
      :image="user_data.image || 'http://mehandis.net/wp-content/uploads/2017/12/default-user-300x300.png'" 
      :name="user_data.name">
        Descrição 123
      </card-menu-vue> 
      <card-menu-vue
      image=""  
      name="Amigos">
        <li>Valéria</li>
        <li>Március</li>
        <li>Fulano</li>
      </card-menu-vue>  
    </span>

    <span slot="main">
      <new-publication-vue/>
      <publication-vue
        :image="user_data.image || 'http://mehandis.net/wp-content/uploads/2017/12/default-user-300x300.png'"
        :name="user_data.name" 
        time="26/11/2018 15:13">
        <content-vue image="https://materializecss.com/images/sample-1.jpg" title="Fotografia">
          I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.
        </content-vue>
      </publication-vue>
    </span>

  </timeline-template>
</template>

<script>

//Template
import TimelineTemplate from '@/templates/TimelineTemplate';
//Components
import GridVue from '@/components/layouts/GridVue';
import ContentVue from '@/components/layouts/social/ContentVue';
import PublicationVue from '@/components/layouts/social/PublicationVue';
import NewPublicationVue from '@/components/layouts/social/NewPublicationVue';
import CardMenuVue from '@/components/layouts/media/CardMenuVue';

export default {
  name: 'Home',
  components:{
    TimelineTemplate,
    GridVue,
    PublicationVue,
    ContentVue,
    NewPublicationVue,
    CardMenuVue
  },
  created: function(){
    let user =  sessionStorage.getItem('user_data');
    if(!user) this.$router.push('Login');
    else this.user_data = JSON.parse(user);
  },
  data () {
    return {
      user_data: null
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
