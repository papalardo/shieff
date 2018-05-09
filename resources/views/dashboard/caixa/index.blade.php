@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col m3">
     <h5>Cart</h5>

      <carrinho></carrinho>
    </div>

    <div class="col m9">
      <h5>Produtos</h5>
      <ul class="tabs" id="categoria_tab">
      </ul>
    </div>
    <div id="test1" class="col s12">Test 1</div>
    <div id="test2" class="col s12">Test 2</div>
    <div id="test3" class="col s12">Test 3</div>
    <div id="test4" class="col s12">Test 4</div>
  </div>
    </div>
  </div>
</div>

@push('scripts')
<script type="text/javascript">
  function carregarProdutos(index){
   var produto = <?php echo $produtos ?>;
   console.log((produto).filter(produto.categoria_id == index));
   /*
   var pedido_div = '<div id="test1" class="col s12">';
   for (var index in produto){
    
  }
  pedido_div += '</div>';
  */
}

  function carregarCategorias(){
   var categorias = <?php echo $categorias ?>;
   var tabs = document.getElementById('categoria_tab');
   var categorias_item = '';
   for(index in categorias){
    categorias_item += `
        <li class="tab col 1"><a href="#${categorias[index]['id']}"
                                onclick="carregarProdutos(${categorias[index]['id']})">
                                ${categorias[index]['nome']}</a></li>
        `
   }
   tabs.innerHTML = categorias_item;
  }

carregarCategorias();

function adicionarPedido(_pedido){

	var itens = '<br>';
	if ((_pedido.itens).length > 0){
		for (var indice in  _pedido.itens){
      itens += `<p> ${ _pedido.itens[indice]['qtd'] + 'x '+ 
      _pedido.itens[indice]['produto']['nome'] }`
    };
  } else {
    itens += `Nenhum item`
  }

  var pedido = document.getElementById('meusPedidos');
  var linePedidos = `<li class="collection-item avatar">
  <i class="material-icons circle red">play_arrow</i>
  <span class="title">Pedido # ${_pedido.id}</span> <br>
  <span class="title">Status ${_pedido.status}</span>
  <span class="title">${ itens }</span>
  <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
  </li>
  `
  pedido.innerHTML += linePedidos;
}
</script>
@endpush

@endsection
