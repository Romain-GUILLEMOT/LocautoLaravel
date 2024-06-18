<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'model', 'brand', 'price', 'state', 'date', 'available'];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
