<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPermissionTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasPermissionTrait;

public function employee(){
    return $this->hasMany(Employee::class);
}
public function reading(){
    return $this->hasMany(Reading::class);
    
}

public function news(){
    return $this->hasMany(News::class);   
}

public function track(){
    return $this->hasMany(SubEditor::class,'track_id');
    
}
public function logs(){
    return $this->hasMany(SubEditor::class,'logs_id');
    
}
public function user(){

    return $this->hasMany(RawNews::class);   
}

public function employeeDetails(){

    return $this->hasMany(EmployeeDetails::class);
    
}
public function subEditors()
{
    return $this->belongsToMany(SubEditor::class);
}

public function subEditorLogs()
{
    return $this->belongsToMany(SubEditor::class, 'sub_editor_logs')->withTimestamps();
}
//Reading central updated log user




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
