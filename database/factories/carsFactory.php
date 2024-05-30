<?php

namespace Database\Factories;

use App\Models\cars;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class carsFactory extends Factory
{
    protected $model = cars::class;

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
