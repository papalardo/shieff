<template>
<div class="container">
  <div class="menu-body">
  <!-- Section starts: Appetizers -->
    <div class="menu-section" v-for="(categoria,index) in categorias" v-if="categoria.produtos[index]">

      <h2 class="menu-section-title">{{ categoria.nome }}</h2>
    
      <!-- Item starts -->
      <div class="menu-item" v-for="(produto,index) in categoria.produtos" v-on:click.prevent="addCart(index)" 
      style="cursor: pointer" disabled>
        <div class="menu-item-name">
           {{ produto.nome }}
        </div>
        
        <div class="menu-item-price">
          R${{ produto.preco }}
        </div>

        <div class="menu-item-description">
        <form method="post" enctype="" :id="index">
                  <input type="hidden" name="id" :value="produto.id">
                  <input type="hidden" name="_token" :value="token">
                  </form>
          {{ produto.descricao }}
        </div>

      </div>
      <!-- Item ends -->
  </div>  

  </div>

  <div id="progress" class="modal progress" style="margin-top:10%!important">
 <div class="indeterminate"></div>
  </div>


</div>



</template>

<script>
import bus from '../bus' 
export default {
props:['itens', 'subtotal', 'token'],
data(){
   return  {
    categorias: [],
    total: '' ,
    progress: false     
  }
},
mounted() {
  this.carregaItens()
},
methods:{
  carregaItens() {
    const vm = this;
    axios.get('/categoria/all').then((res) => {            
      //this.$store.commit('setItem',res.data);
      vm.categorias = res.data;
    });

  },
  addCart(index){
    $('#progress').modal('open');
    let formData = new FormData(document.getElementById(index));
    axios.post('/pedido/addItemCart', formData )
      .then((response) => {
        $('#progress').modal('close');
        Materialize.toast('Adicionado ao carrinho', 2000, 'green');
        bus.$emit('atualizarCart');
      })
      .catch((error) => {
        console.log(error.response);
      });
      this.carregaItens();
    }
  }
}
</script>

<style>

.menu-body {
  max-width: 70%;
  margin: 0 auto;
  display: block;
  color: rgb(92, 92, 92);
}

.menu-section {
  margin-bottom: 50px;
}

.menu-section-title {
  font-family: georgia;
  font-size: 50px;
  display: block;
  font-weight:normal;
  margin: 20px 0; 
  text-align: Center;
}

.menu-item {
  margin: 15px 0;
  font-size: 18px;
}

.menu-item-name{
  font-family: helvetica;
  font-weight: bold;
  border-bottom: 2px dotted rgb(213, 213, 213);
}

.menu-item-description {
  font-style: italic;
  font-size: .9em;
  line-height: 1.5em;
}

.menu-item-price{
  float: right;
  font-weight: bold;
  font-family: arial;
  margin-top: -22px;
}
</style>


