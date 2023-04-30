<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //\App\Models\User::factory(10)->create()->each(function($user)
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(),
            'post_image' => $this->faker->imageUrl('900', '300'),
            'body' => $this->faker->paragraph()

        ];
    }
}
