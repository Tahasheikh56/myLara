<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chatModel extends Model
{
    use HasFactory;
    protected $table = "chat";
    protected $fillable = ["senderId","receverId","message","time"];
}