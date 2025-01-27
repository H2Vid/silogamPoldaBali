<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Modules\Article\Models\Article;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ArticleFactory extends Factory
{

    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence(rand(3, 8));
        $timestamp = date('Y-m-d H:i:s', strtotime('-'.rand(1, 30).' days'));
        return [
            'title' => $title,
            'category_id' => rand(1, 5),
            'slug' => slugify($title),
            'excerpt' => fake()->realText(150),
            'description' => '<p>'. fake()->text(400) .'</p>' . '<p>'. fake()->text(800) .'</p>' . '<p>'. fake()->text(300) .'</p>' . '<p>'. fake()->text(600) .'</p>',
            'image' => 'default.jpg',
            'is_active' => true,
            'is_limited' => rand(1, 10) > 7 ? true : false,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];
    }

}
