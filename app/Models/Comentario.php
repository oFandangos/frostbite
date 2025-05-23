<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produto;

class Comentario extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getCreatedAtAttribute($value){
        return $this->value = Carbon::parse($value)->format('d/m/Y');
    }

    public function user(){
        return $this->belongsTo(User::class, 'comentario_usuario_id');
    }

    public function produto(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }


}
