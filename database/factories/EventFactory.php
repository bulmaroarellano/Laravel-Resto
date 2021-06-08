<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'guests_number' => $this->faker->randomNumber(0),
            'date' => $this->faker->dateTime,
            'start_our' => $this->faker->time,
            'start_end' => $this->faker->time,
            'customer_id' => \App\Models\Customer::factory(),
        ];
    }
}
