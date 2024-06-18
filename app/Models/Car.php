<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'model', 'brand', 'price', 'state', 'date'];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
