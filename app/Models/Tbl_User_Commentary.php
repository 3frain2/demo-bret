<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_User_Commentary extends Model
{
    use HasFactory;
    protected $fillable = [
        'profiles_id',
        'commentaries_id',
    ];
}
