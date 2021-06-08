<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomNumber(2),
            'due_at' => $this->faker->date,
            'paid_at' => $this->faker->date,
            'customer_id' => \App\Models\Customer::factory(),
            'event_id' => \App\Models\Event::factory(),
        ];
    }
}
