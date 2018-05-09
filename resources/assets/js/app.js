
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'Vuex';
import axios from 'axios';

Vue.use(Vuex);
Vue.use(axios);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://localhost:8000/' : ''

// Vue Material
//import 'vuetify/dist/vuetify.min.css'
//import VueMaterial from 'vue-material'
//Vue.use(VueMaterial)

/*
import { MdButton, MdContent, MdTabs } from 'vue-material/dist/components'
Vue.use(MdButton)
Vue.use(MdContent)
Vue.use(MdTabs)
*/





//Toast 

import Toasted from 'vue-toasted';
Vue.use(Toasted)


 //Vuex

 const store = new Vuex.Store({
   state:{
     item:{}
   },
   mutations:{
     setItem(state,obj){
       state.item = obj;
     }
   }
 });

// Meus Componentes

Vue.component('topo', require('./components/Topo.vue'));
Vue.component('painel', require('./components/Painel.vue'));
Vue.component('caixa', require('./components/Caixa.vue'));
Vue.component('pagina', require('./components/Pagina.vue'));
Vue.component('tabela-lista', require('./components/TabelaLista.vue'));
Vue.component('migalhas', require('./components/Migalhas.vue'));
Vue.component('modal', require('./components/modal/Modal.vue'));
Vue.component('modallink', require('./components/modal/ModalLink.vue'));
Vue.component('formulario', require('./components/Formulario.vue'));
Vue.component('ckeditor', require('vue-ckeditor2'));
Vue.component('artigocard', require('./components/ArtigoCard.vue'));
Vue.component('carrinho', require('./components/Carrinho.vue'));
Vue.component('menu-cardapio', require('./components/Menu.vue'));
Vue.component('pedido-card', require('./components/PedidoCard.vue'));

const app = new Vue({
    el: '#app',
    store,
    mounted: function(){
      //console.log("ok");
      document.getElementById('app').style.display = "block";
      document.getElementById('pageLoad').style.display = "none";
    }
});
