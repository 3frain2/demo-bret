<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_Profile_Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'profiles_id',
        'jobs_id',
    ];
}
