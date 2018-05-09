<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model
{
    protected $fillable = ['id', 'nome'];
    protected $table = 'perfil_usuarios';
}
