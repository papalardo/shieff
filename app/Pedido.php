<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['id', 'status', 'pagamento', 'endereco', 'observacao', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function itens()
    {
        return $this->hasMany(PedidoItem::class, 'pedido_id', 'id');
    }

    public function produto()
    {
        return $this->hasManyThrough(PedidoItem::class, Produto::class, 'id', 'produto_id');
    }
    /*
    public static function enumValues($name){
        $instance = new static; // create an instance of the model to be able to get the table name
        $type = DB::select( DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$name.'"') )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach(explode(',', $matches[1]) as $value){
            $v = trim( $value, "'" );
            $enum[] = $v;
        }
        return $enum;
    }
    */
}
