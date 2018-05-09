<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
{
    protected $fillable = ['id', 'nome'];
   	public $timestramps = false;

   	public function produtos()
    {
      return $this->hasMany('App\Produto', 'categoria_id');
    }

}
