@extends('layouts.app')

@section('content')
<div class="container" id="homePedidos">
  <div class="row mt-5">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <ul class="collection" id="meusPedidos">
          <li class="collection-header"><h4>Meus Pedidos</h4></li>
        </ul>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script type="text/javascript">
  function carregarPedidos(){
   var pedidos = <?php echo $pedidos ?>;
   console.log(pedidos);
   for (var indice in pedidos){
    adicionarPedido(pedidos[indice]);
  }
}

carregarPedidos();

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
