<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bussines_name' => $this->faker->text(255),
            'telephone' => $this->faker->address,
            'email' => $this->faker->email,
            'logo' => $this->faker->text(255),
            'discount_credit_card' => $this->faker->randomNumber(2),
        ];
    }
}