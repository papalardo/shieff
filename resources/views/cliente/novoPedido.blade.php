@extends('layouts.app')

@section('content')

<menu-cardapio token="{{ csrf_token() }}"></menu-cardapio>

<!-- Modal Trigger -->
<div class="fixed-action-btn horizontal">
  <a class="btn-floating btn-large waves-effect waves-light  modal-trigger"  href="#cartModal">
    <i class="material-icons">shopping_cart</i></a>
  </div>
  <!-- Modal Structure -->
  <div id="cartModal" class="modal">
    <div class="modal-content">        
      <carrinho></carrinho>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Voltar</a>
      <a href="#myModal" class="modal-trigger modal-action modal-close waves-effect waves-green btn-flat">Proximo</a>
    </div>
  </div>


  <div id="myModal" class="modal modal-fixed-footer">
    <div class="modal-content"> 
      <form action="{{ url('pedido') }}" class="col s12" method="post" id="formId">   
        <input type="hidden" name="_token" value="{{ csrf_token() }}">    
        <div class="row">
          <div class="input-field col s12">
            <input type="text" name="endereco">
            <label>Endereço</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Dinheiro + Cartão" name="pagamento" type="text">
            <label>Pagamento</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Dinheiro + Cartão" name="obs" type="text">
            <label>Observações</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">

        <button class="modal-action modal-close waves-effect waves-green btn-flat" type="submit" form="formId" name="action">Submit
          <i class="material-icons right">send</i>
        </button>
      </form>
    </div>
  </div>  
@endsection