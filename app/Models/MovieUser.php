<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MovieUser extends Pivot
{
    use HasFactory;

    protected $fillable = ['user_id', 'movie_id'];

    protected $table = 'movie_users';
}
