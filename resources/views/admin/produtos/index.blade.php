@extends('layouts.app')

@section('content')
  <pagina tamanho="12">

    @if($errors->all())
      <div class="alert alert-danger alert-dismissible text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $key => $value)
          <li><strong>{{$value}}</strong></li>
        @endforeach
      </div>
    @endif

    <painel titulo="Lista de Autores">
    <tabela-lista
      v-bind:titulos="['#','Nome','E-mail']"
      v-bind:itens="{{json_encode($listaModelo)}}"
      ordem="desc" ordemcol="1"
      criar="#criar" detalhe="/admin/produtos/" editar="/admin/produtos/"
      modal="sim" deletar="/admin/produtos/" token="{{ csrf_token() }}"

      ></tabela-lista>
      <div align="center">
        {{$listaModelo}}
      </div>
    </painel>

  </pagina>

  <modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="{{route('produtos.store')}}" method="post" enctype="" token="{{ csrf_token() }}">

      <div class="form-group">
        <label for="email">Descricao</label>
        <input type="text" class="form-control" name="nome" value="{{old('nome')}}">
      </div>
       <div class="form-group">
        <label for="email">Preco</label>
        <input type="number" class="form-control" step="0.1" name="preco" value="{{old('preco')}}">
      </div>

       <div class="form-group">
        <label for="email">Descrocap</label>
        <input type="text" class="form-control" name="descricao" value="{{old('descricao')}}">
      </div>
      <div class="form-group">
         <select name="categoria_id" class="input-field select">
           <option>Selecione uma categoria</option>
           @foreach(App\CategoriaProduto::all() as $categoria)
           <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
           @endforeach;
         </select>
       </div>
    </formulario>
    <span slot="botoes">
      <button form="formAdicionar" class="btn btn-info">Adicionarr</button>
    </span>

  </modal>
  <modal nome="editar" titulo="Editar">
    <formulario id="formEditar" v-bind:action="'/produtos/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">

      <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" id="name" name="nome" v-model="$store.state.item.nome" placeholder="Nome">
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" class="form-control" id="email" name="descricao" v-model="$store.state.item.descricao" placeholder="E-mail">
      </div>
       <div class="form-group">
        <label for="email">Preco</label>
        <input type="text" class="form-control" id="email" name="preco" v-model="$store.state.item.preco" placeholder="E-mail">
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formEditar" class="btn btn-info">Atualizar</button>
    </span>
  </modal>
  <modal nome="detalhe" v-bind:titulo="$store.state.item.nome">
    <p>@{{$store.state.item.descricao}}</p>
    <p>@{{$store.state.item.preco}}</p>
  </modal>
@endsection
