<?php

namespace Database\Factories;

use App\Models\Invoices;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InvoicesFactory extends Factory
{
    protected $model = Invoices::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'uuid' => $this->faker->uuid(),

            'user_id' => User::factory(),
            'reservation_id' => Reservation::factory(),
        ];
    }
}
