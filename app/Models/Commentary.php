<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_emmiter', 
        'user_receiver',
        'commentary'
    ];
}
