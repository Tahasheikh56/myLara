<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class regModel extends Model
{
    use HasFactory;
    protected $table = "reg";
    protected $fillable = ["name","phone","email","password","image"];

    //password hidden query
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
      */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];
}
