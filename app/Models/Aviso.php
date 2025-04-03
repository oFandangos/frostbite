<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Aviso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'texto',
        'user_id',
        'created_at'
    ];


    // public function getCreatedAtAttribute($value){
        
    // }

    // public function setCreatedAtAttribute($value){
        
    // }

    public function users(){
        return $this->belongsTo('App\Models\User');
    }

}
