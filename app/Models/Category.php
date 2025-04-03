<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $fillable = [
        'id',
        'nome_cat'
    ];


    public static function categories(){
        $categories = Category::all();
        return $categories;
     }
  

    public function products(){
        return $this->hasMany('App\Models\Produto');
    }

}
