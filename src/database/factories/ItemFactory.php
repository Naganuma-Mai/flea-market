<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'image' => $this->faker->imageUrl(),
            'condition' => $this->faker->randomElement(['良好', '傷や汚れあり']),
            'name' => $this->faker->randomElement(['ジャケット', 'シャツ', 'スカート', 'ジーンズ', 'ネックレス', 'バッグ', 'スニーカー', '帽子']),
            'explanation' => $this->faker->realText(),
            'price' => $this->faker->numberBetween(1000,15000),
        ];
    }
}
