<?php

namespace Database\Factories;

use App\Domain\Archive\Models\Bookcase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookcaseFactory extends Factory
{
    protected $model = Bookcase::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->asciify('*****'),
        ];
    }
}
