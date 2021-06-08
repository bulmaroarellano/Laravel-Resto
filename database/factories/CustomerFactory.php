<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dni' => $this->faker->text(255),
            'firstname' => $this->faker->name,
            'lastname' => $this->faker->text(255),
            'telephone' => $this->faker->tollFreePhoneNumber,
            'email' => $this->faker->email,
            'fiscal_code' => $this->faker->text(255),
            'company_name' => $this->faker->text(255),
        ];
    }
}
