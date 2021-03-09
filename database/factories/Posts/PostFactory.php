<?php

namespace Database\Factories\Posts;

use App\Models\Posts\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => rand(1,2),
            'subject_id'=>rand(1,3),
            'title'=> $this->faker->sentence(),
            'slug'=>Str::slug($this->faker->sentence()). Str::random(6),
            'body'=>$this->faker->paragraph(15)


        ];
    }
}
