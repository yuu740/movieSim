<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    public function episodes() {
        return $this->hasMany(Episodes::class, 'movie_id');
    }
}
