<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date_in',
        'date_out',
        'status',
        'car_id',
        'user_id',
    ];

    protected $casts = [
        'date_in' => 'date',
        'date_out' => 'date',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($reservation) {
            $reservation->invoices()->delete();
        });
    }
}
