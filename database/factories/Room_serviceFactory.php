<?php

namespace Database\Factories;

use App\Models\Room_service;
use Illuminate\Database\Eloquent\Factories\Factory;

class Room_serviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room_service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_id'=>rand(1,5),
            'service_id'=>rand(1,5),
            'additional_price'=>rand(0,200)
        ];
    }
}
