<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    public function cars(): BelongsTo
    {
        return $this->belongsTo(cars::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts()
    {
        return [
            'date_in' => 'date',
            'date_out' => 'date',
        ];
    }
}
