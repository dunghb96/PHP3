<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $no='NO ';
        $no2=$no.rand(1,8);
        return [
            'room_no'=>$no2,
            'floor'=>rand(1,5),
            'image'=>'https://picsum.photos/640/480',
            'detail'=>$this->faker->text($maxNbChars = 200),
            'price'=>rand(0,500),
        ];
    }
}
