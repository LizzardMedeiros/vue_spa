<template>
  <div id="app">

  	<header>
      <nav-bar color="blue darken-4" logo="Social" logourl="/">
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/profile">Profile</router-link></li>
        <li v-if="has_user"><a v-on:click="logout()">Sair</a></li>
      </nav-bar>
  	</header>

  	<main class="container">
  		<div class="row">
  			<grid-vue size="s12 m4">
          <slot name="menu"/> 
        </grid-vue>
  			<grid-vue size="s12 m8">
  				<slot name="main"/>
  			</grid-vue>
  		</div>
  		
  	</main>

  	<footer-vue color="blue darken-4" title="Navbar Social">
  		<li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
  	</footer-vue>

  </div>
</template>

<script>
import NavBar from '@/components/layouts/navs/NavBar';
import GridVue from '@/components/layouts/GridVue';
import FooterVue from '@/components/layouts/footers/FooterVue';

export default {
  name: 'TimelineTemplate',
  components:{
  	NavBar,
  	GridVue,
  	FooterVue
  },
  created: function(){
    let has_user = sessionStorage.getItem('user_data');
    if(!has_user) this.$router('Login');
    else this.has_user = true;
  },
  methods:{
      logout(){
        sessionStorage.clear();
        this.has_user = null;
        this.$router.push('Login');
      }
  },
  data(){
    return{
      has_user: false
    }
  }
}
</script>

<style>
</style>
