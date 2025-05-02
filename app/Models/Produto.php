<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use App\Models\Comentario;

class Produto extends Model
{
    use HasFactory;
    protected $guarded = [];

     public function category(){
        return $this->belongsTo('App\Models\Category');
     }

     public function user(){
      return $this->belongsTo('App\Models\User');
     }

     public function files(){
      return $this->hasMany('App\Models\File');
     }

     public function comentarios(){
      return $this->hasMany('App\Models\Comentario', 'produto_id');
     }

}
