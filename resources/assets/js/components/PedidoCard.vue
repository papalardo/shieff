<template>
<div class="row">
<div class="col s12 m3" v-for="itens in pedidos">
      <div class="card blue border-0">
        <div class="card-content">
        <table style="border: 2px">
            <tr  v-for="item in itens.itens">
                <td>{{ item.nome }}</td>
            </tr>
        </table>
        <div class="center-align">
        {{ btnPronto }}
            <a class="btn-floating waves-effect waves-light red" v-on:click="mudarEstado(itens.pedido, proxestado)"><i class="material-icons">add</i></a>
            <a class="btn-floating waves-effect waves-light red" v-on:click="mudarEstado(itens.pedido, proxestado)"><i class="material-icons">add</i></a>
        </div> 
        </div>
      </div>
    </div>

<div v-if="pedidos.length == 0" class="center-align" style="margin-top:50px">Nenhum pedido no momento </div>
</div>

</template>

<script>
    export default {
    	props:['url', 'status', 'proxestado', 'btnPronto'],
    	data(){
    		return {
    			pedidos:[],
                itemId: '',
                estado: ''
    		}
    	},
    	mounted() {
    		this.carregaCard();
        var self = this;
		      setInterval(function () {
	         self.carregaCard();
	         //self.$data.now = Date.now()
	      }, 4000);

    	},
        methods: {
    		carregaCard() {
    			const vm = this;
    			axios.get('/dashboard/pedidos/jsonCardAberto/' + vm.status)
        			.then((response) => {
                      vm.pedidos = response.data;
                    })
                .catch(error => {
                  console.log(error);
                });
    		},
            mudarEstado(itemId, estado) {
                const vm = this;
                axios.get('/dashboard/pedidos/mudarEstado/' + estado +'/'+ itemId)
                    .then((response) => {
                        console.log(response.data);
                      vm.carregaCard();
                      //vm.pedidos = response.data;
                    })
                .catch(error => {
                  console.log(error);
                });
            }
    	}

    }
</script>


<style>
</style>