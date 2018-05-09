<template>
  <span>
    <span v-if="item">
      <button v-on:click="preencheFormulario()" v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" v-bind:class="css || 'btn btn-primary'"    v-bind:href="'#' + nome">{{titulo}}</button>
      <button v-on:click="preencheFormulario()" v-if="tipo == 'button'" type="button" v-bind:class="css || 'btn btn-primary'"    v-bind:href="'#' + nome">{{titulo}}</button>
      <a v-on:click="preencheFormulario()" v-if="tipo == 'link'" v-bind:class="css || ''"    v-bind:href="'#' + nome">{{titulo}}</a>
    </span>

    <span v-if="!item">
      <button v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" v-bind:class="css || 'btn btn-primary'"    v-bind:href="'#' + nome">{{titulo}}</button>
      <button v-if="tipo == 'button'" type="button" v-bind:class="css || 'btn btn-primary'"    v-bind:href="'#' + nome">{{titulo}}</button>
      <a v-if="tipo == 'link'" v-bind:class="css || ''"    v-bind:href="'#' + nome">{{titulo}}</a>
    </span>

  </span>

</template>

<script>
    export default {
      props:['tipo','nome','titulo','css','item','url'],
      methods:{
        preencheFormulario:function(){
          axios.get(this.url + this.item.id).then(res => {            
            this.$store.commit('setItem',res.data);
          });
          //this.$store.commit('setItem',this.item);
        }
      }
    }
</script>
