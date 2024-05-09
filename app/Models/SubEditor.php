<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEditor extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function reporter(){
        return $this->belongsTo(User::class,'reporter_id');
        
    }
    public function track(){
        return $this->belongsTo(User::class);      
    }
    public function logs(){
        return $this->belongsTo(User::class);      
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function logss()
{
    return $this->belongsToMany(User::class, 'sub_editor_logs')->withTimestamps();
}
    


  
}
