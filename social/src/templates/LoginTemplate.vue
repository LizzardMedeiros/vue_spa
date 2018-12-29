<template>

  <span>
    <header>
      <nav-bar color="blue darken-4" logo="Social" logourl="/">
        <li><router-link to="/login">Login</router-link></li>
        <li><router-link to="/register">Cadastro</router-link></li>
      </nav-bar>
    </header>

    <div class="container">
      <div class="row">
        <grid-vue size="m8">
          <slot name="menu"/>
        </grid-vue>
        <grid-vue size="m4">
          <slot name="main"/>
        </grid-vue>
        </div>
      </div>
    </div>

    <footer-vue color="blue darken-4" title="Navbar Social">
      <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
    </footer-vue>
    
  </span>
</template>

<script>
  import NavBar from '@/components/layouts/navs/NavBar';
  import GridVue from '@/components/layouts/GridVue';
  import FooterVue from '@/components/layouts/footers/FooterVue';
  export default {
    name: 'LoginTemplate',
    props:[],
    components:{NavBar, GridVue, FooterVue},
    methods:{
      logout(){
        sessionStorage.clear();
        this.user = null;
      }
    },
    created(){
      let user = sessionStorage.getItem('user_data');
      if(user) this.$router.push('/');
    },
    data () {
      return {
      }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>