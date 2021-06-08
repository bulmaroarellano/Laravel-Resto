<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'article' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'code' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(2, 0, 9999),
        ];
    }
}
