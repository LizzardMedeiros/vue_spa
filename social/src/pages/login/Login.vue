<template>
  <login-template>
    <span slot="menu">
      <empty-card-vue>
      <img src="https://i.ytimg.com/vi/VbSQ1kuIwME/maxresdefault.jpg" class="responsive-img"/>
      </empty-card-vue>
    </span>
    <span slot="main">
      <span>
          <h5>Entrar</h5>
          <input type="email" placeholder="E-Mail" v-model="user.email">
          <input type="password" placeholder="Senha" v-model="user.password">
          <button class="btn" v-on:click="login()">Entrar</button>
          <router-link to="/register" class="btn orange">Registrar</router-link>   
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
    name: 'Login',
    props:[],
    components:{GridVue, EmptyCardVue, LoginTemplate},
    methods:{
      login(){
        var result = axios
        .post('http://localhost:8000/api/login', {
          email: this.user.email,
          password: this.user.password 
        })
        .then(response => {
            if(response.data.token){
              sessionStorage.setItem('user_data', JSON.stringify(response.data));
              this.$router.push('/');
            }
            else if(response.data.error) console.log('Falha ao fazer login '+response.data.error);
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
        user:{email:"", password:""}
      }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>