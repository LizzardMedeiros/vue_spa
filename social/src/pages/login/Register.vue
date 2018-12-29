<template>
  <login-template>
    <span slot="menu">
      <empty-card-vue>
      <img src="https://i.ytimg.com/vi/VbSQ1kuIwME/maxresdefault.jpg" class="responsive-img"/>
      </empty-card-vue>
    </span>
    <span slot="main">
      <span>
          <h5>Registrar</h5>
          <input type="text" placeholder="Nome" v-model="user.name">
          <input type="text" placeholder="E-Mail" v-model="user.email">
          <input type="password" placeholder="Senha" v-model="user.password">
          <input type="password" placeholder="Confirmar senha" v-model="user.password_confirmation">
          <button class="btn" v-on:click="register()">Registrar</button>
          <router-link to="/login" class="btn orange">Login</router-link>      
      </span>
    </span>

  </login-template>
</template>

<script>
  import GridVue from '@/components/layouts/GridVue';
  import EmptyCardVue from '@/components/layouts/media/EmptyCardVue';
  import LoginTemplate from '@/templates/LoginTemplate';

  import axios from 'axios';

  export default {
    name: 'Register',
    props:[],
    components:{GridVue, EmptyCardVue, LoginTemplate},
    methods:{
      register(){
        var result = axios
        .post('http://localhost:8000/api/register', {
          name: this.user.name,
          email: this.user.email,
          password: this.user.password,
          password_confirmation: this.user.password_confirmation
        })
        .then(response => {
            if(response.data.token){
              sessionStorage.setItem('user_data', JSON.stringify(response.data));
              this.$router.push('/');
            }
            else if(response.data.error) console.log('Falha ao fazer o registro');
            else{
              let errors = "";
              for(let e of Object.values(response.data)) errors += e+" ";
              console.log(errors);
            }
        })
        .catch(e => (console.log(e)));
        console.log(result);
      }
    },
    data () {
      return {
        user : {
          name: "",
          email: "",
          password: "",
          password_confirmation: ""
        }
      }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>