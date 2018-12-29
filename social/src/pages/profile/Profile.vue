<template>
  <timeline-template>
    <span slot="menu">
      <empty-card-vue>
      <img :src="user.image || 'http://mehandis.net/wp-content/uploads/2017/12/default-user-300x300.png'" class="responsive-img"/>
      </empty-card-vue>
    </span>
    <span slot="main">
      <span>
          <h5>Perfil</h5>
          <input type="text" placeholder="Nome" v-model="user.name">
          <input type="text" placeholder="E-Mail" v-model="user.email">
          <div class="file-field input-field">
            <div class="btn">
              <span>Foto Perfil</span>
              <input type="file" v-on:change="updateImage">
            </div>
              <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
          <input type="password" placeholder="Senha" v-model="password">
          <input type="password" placeholder="Confirmar senha" v-model="password_confirmation">
          <button class="btn orange " v-on:click="update()">Atualizar</button>     
      </span>
    </span>
  </timeline-template>
</template>

<script>
  import GridVue from '@/components/layouts/GridVue';
  import EmptyCardVue from '@/components/layouts/media/EmptyCardVue';
  import TimelineTemplate from '@/templates/TimelineTemplate';

  import axios from 'axios';

  export default {
    name: 'Perfil',
    props:[],
    components:{GridVue, EmptyCardVue, TimelineTemplate},
    created: function(){
      let user =  sessionStorage.getItem('user_data');
      this.user = JSON.parse(user);
    },
    methods:{
      updateImage(e){
        let file = e.target.files || e.dataTransfer.files;
        if(file.length == 0) return;

        let fr = new FileReader();
        fr.onloadend = (e) => {
          this.profile_img = e.target.result;
        }
        fr.readAsDataURL(file[0]);
      },
      update(){
        var result = axios
        .put('http://localhost:8000/api/profile', {
          name: this.user.name,
          email: this.user.email,
          image: this.profile_img,
          password: this.password,
          password_confirmation: this.password_confirmation
        },{"headers":{"authorization":"Bearer "+this.user.token}})
        .then(response => {
            if(response.data.token){
              sessionStorage.setItem('user_data', JSON.stringify(response.data));
              this.user = JSON.parse(JSON.stringify(response.data));
              alert("Perfil atualizado com sucesso!");
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
        user: null,
        profile_img: null,
        password: "",
        password_confirmation: ""
      }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>