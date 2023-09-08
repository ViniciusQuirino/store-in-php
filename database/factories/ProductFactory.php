<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = $this->faker->unique();
        $files = File::files(public_path('uploads'));
        return [
            'name' => $this->faker->unique()->word,
            'value' => $this->faker->randomNumber(2),
            'category' => $this->faker->unique()->word,
            'status' => 'DISPONIVEL',
            'stock' => $this->faker->randomNumber(),
            'imagem' => asset('uploads/' . $this->faker->randomElement($files)->getFilename()),
            'seller_id' => User::pluck('id')->random(), //extrair o id
        ];
    }
}
