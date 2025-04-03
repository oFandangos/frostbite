<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_prod',
        'valor_prod',
        'category_id',
        'user_id'
     ];
      

     public function category(){
        return $this->belongsTo('App\Models\Category');
     }

     public function users(){
      return $this->belongsTo('App\Models\User');
     }

     public function files(){
      return $this->hasMany('App\Models\File');
     }


}
