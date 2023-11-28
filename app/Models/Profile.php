<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name',
        'description',
        'abilities',
        'phone_number',
        'province',
        'contacts_id',
        'ratings_id',
        'users_id',
    ];
}
