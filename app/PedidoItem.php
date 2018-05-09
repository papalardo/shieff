<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $fillable = ['id', 'pedido_id', 'produto_id', 'qtd'];
    protected $table = 'pedido_itens';
    public $timestamps  = false;

    public function produto()
    {
    	return $this->belongsTo('App\Produto', 'produto_id');
    }
}
