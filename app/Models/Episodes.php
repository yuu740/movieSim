<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    public function movie() {
        return $this->belongsTo(Movies::class);
    }
}
