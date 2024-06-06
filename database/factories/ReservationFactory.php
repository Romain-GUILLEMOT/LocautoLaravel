<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'date_in' => Carbon::now(),
            'date_out' => Carbon::now(),
            'status' => $this->faker->word(),
            'cars_id' => Car::factory(),
            'user_id' => User::factory(),
        ];
    }
}
