<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CarsFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'price' => $this->faker->word(),
            'model' => $this->faker->word(),
            'date' => Carbon::now(),
            'brand' => $this->faker->word(),
            'state' => $this->faker->word(),
        ];
    }
}
