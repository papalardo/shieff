
import bus from './bus';

<template>
  
  <table class="striped">
  <tbody>
  <tr v-if="itens_total == 0"><div align="center">Nenhum item</div></tr>
  <tr v-for="(item,index) in itensCart">
    <td>{{ item.name }} </td>
    <td>x{{ item.qty }}</td>
    <td>R${{ item.subtotal }}</td>
    <td>
      <form method="post" enctype="" :id="index">
        <input type="hidden" name="_method" value="DELETE"> 
        <input type="hidden" name="id" :value="item.id">
        <input type="hidden" name="_token" :value="token">
        <a class="btn-floating red" v-on:click.prevent="delCart(index)"><i class="material-icons">delete</i></a> 
      </form>
    </td>
  </tr>
  <tr v-if="itens_total > 0">
  <td>Total</td>
  <td></td>
  <td>R${{ total }}</td>
  </tr>
  </tbody>
  </table>
</template>

<script>

import bus from '../bus'

    export default {

      props:['token'],
      data(){
         return  {
          itensCart: [],
          total: '',
          itens_total: ''       
        }
      },

      mounted() {
        var self = this;
        this.carregaItens();
        bus.$on('atualizarCart', function(value){
          self.carregaItens();
          });
      },
      methods:{

        carregaItens() {
          const vm = this;
          axios.get('/api/cart/all')
            .then((response) => {
              vm.itensCart = response.data.itens;
              vm.total = response.data.total;
              vm.itens_total = response.data.itens_total;
            })
            .catch((error) => {
              console.log(error.response);
            });
        },

        delCart(index){
          var  vm = this;
          let formData = new FormData(document.getElementById(index));
          axios.post('/pedido/delItemCart/' + index, formData)
            .then((response) => {
              vm.carregaItens();
              Materialize.toast('Deletado', 2000);
            })
            .catch((error) => {
              console.log(error.response);
            });

          }
      }

    }
</script>

<style>


</style>


