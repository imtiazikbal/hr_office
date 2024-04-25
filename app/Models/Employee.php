<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function position(){
        return $this->belongsTo(Position::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
}
