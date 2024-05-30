<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cars extends Model
{
    use HasFactory;

    protected function casts()
    {
        return [
            'date' => 'date',
        ];
    }
}
