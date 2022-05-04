<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Bookcase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(30),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'release_date' => $this->faker->date(),
            'bookcase_id' => Bookcase::all()->random()->id,
        ];
    }
}
