<?php

namespace Database\Factories;

use App\Models\Donatur;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonaturFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donatur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'gender' => 'L',
            'phone' => $this->faker->phoneNumber,
            'pekerjaan' => 'Staff'
        ];
    }
}
