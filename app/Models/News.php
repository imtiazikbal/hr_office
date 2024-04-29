<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
     public function log(){
         return $this->belongsTo(User::class,'logs');
     }
     public function forward(){
         return $this->hasMany(NewsForwarding::class);
         
     }
     public function centreNews(){
         return $this->hasMany(CentreNews::class);  
     }
     public function user(){
         return $this->belongsTo(User::class,'user_id');
     }
}
