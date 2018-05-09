<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Pedido;
use App\PedidoItem;
use Cart;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cliente.novoPedido');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = Pedido::create(['pagamento' => $request->pagamento, 'endereco' => $request->endereco,
                                 'observacao' => $request->obs, 'pedidos_user_id' => Auth::user()->id ]);
        foreach(Cart::content() as $item)
            {
            PedidoItem::create(['pedido_id' => $post->id , 'produto_id' => $item->id , 'qtd' => $item->qty ]);
            }
            Cart::destroy();
        return redirect('/meusPedidos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Pedido::find($id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addItemCart(Request $request)
    {
        $produto = Produto::find($request->id);
        $cart = Cart::add(['id' => $produto->id, 'name' => $produto->nome, 'price' => $produto->preco, 'qty' => 1]);
        if ($cart)
        {
        Cart::setTax($cart->rowId, 0);
        return json_encode(['status' => 'ok', 'item' => $produto]);
        } else 
        {
        return json_encode(['status' => 'ok']);
        }
    }

    public function allItemCart()
    {
        return json_encode(['itens' => Cart::content(), 
                            'subtotal' => Cart::subtotal(), 
                            'total' => Cart::total(),
                            'itens_total' => Cart::count()]);
    }

    public function delItemCart($id)
    {
        return Cart::remove($id);
    }

    public function meusPedidos()
    {
        $pedidos = [];
        #foreach (Pedido::with('user')->whereUserId(Auth::user()->id)->get() as $pedido)
        $pedidosArray = Pedido::with('user')
        ->with('itens')->with('produto')
        ->with('itens.produto')
        ->whereUserId(Auth::user()->id)
        ->get();
        $pedidos = $pedidosArray->toJson();
        /*
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
        */
        $pedidos;
        return view('cliente.meusPedidos',compact('pedidos'));
    }
}
