<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();

        return [
            'category_id' => $category ? $category->id : 1,
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->realText(100),
        ];
    }
}



