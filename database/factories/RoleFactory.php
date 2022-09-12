<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = ['Admin', 'User', 'Subscriber'];
        return [
            'name' => $roles[round(rand(1,2))],
            'slug' => 'test'
        ];
    }
}
