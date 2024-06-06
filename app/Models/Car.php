<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public static function create(array $all)
    {
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
