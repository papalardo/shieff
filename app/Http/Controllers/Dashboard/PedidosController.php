<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pedido;
use App\PedidoItem;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
	public function aberto()
	{
		return view('dashboard.pedidos.pedidosAbertos');
	}

	public function pronto()
	{
		return view('dashboard.pedidos.pedidosProntos');
	}

	public function mudarEstado($estado, $id)
	{
		Pedido::find($id)->update(['status' => $estado]);
     //return json_encode(['ok' => $estado ]);
	}

	public function jsonCardAberto($status)
	{
		$pedidos = [];
		foreach (Pedido::where('status',$status)->get() as $pedido)
		{
		$itens = [];
		$total = 0;
		$count = 0;
		foreach (PedidoItem::with('produto')->where('pedido_id', $pedido->id )->get() as $produto)
		  {
		  $produto ? $total += $produto->qtd*$produto->produto->preco : $total = 0;
		  array_push($itens, ['id' => $produto->id, 
		                      'produto_id' => $produto->produto_id,
		                      'nome' => $produto->produto->nome,
		                      'qtd' => $produto->qtd,
		                      'preco' => $produto->produto->preco]);
		  $produto ? $count = count($itens) : $total = 0;
		  }
		  array_push($pedidos, ['pedido' => $pedido->id , 'status' => $pedido->status, 
		                        'itens' => $itens,
		                        'total' => $total, 'count' => $count ]);
		  

		unset($itens);
		}
		return $pedidos;
	}

	public function pedidoByUser() {
		#return json_encode(Pedido::with('user')->wherePedidosUserId(Auth::user()->id)->get());

		$pedidos = [];
		foreach (Pedido::with('user')->wherePedidosUserId(Auth::user()->id)->get() as $pedido)
		{
		$itens = [];
		$total = 0;
		$count = 0;
		foreach (PedidoItem::with('produto')->where('pedido_id', $pedido->id )->get() as $produto)
		  {
		  $produto ? $total += $produto->qtd*$produto->produto->preco : $total = 0;
		  array_push($itens, ['id' => $produto->id, 
		                      'produto_id' => $produto->produto_id,
		                      'nome' => $produto->produto->nome,
		                      'qtd' => $produto->qtd,
		                      'preco' => $produto->produto->preco]);
		  $produto ? $count = count($itens) : $total = 0;
		  }
		  array_push($pedidos, ['pedido' => $pedido->id , 'status' => $pedido->status, 
		                        'itens' => $itens,
		                        'total' => $total, 'count' => $count,
		                        'proprietario' => $pedido->user ]);
		  

		unset($itens);
		}
		#return $pedidos;
		return view('page',compact('pedidos'));

	}
}