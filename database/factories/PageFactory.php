<?php
namespace Database\Factories\EscolaLms\Pages\Models;

use Database\Factories\EscolaLms\Core\Models\UserFactory;
use EscolaLms\Pages\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition()
    {
        $title = $this->faker->catchPhrase;
        return [
            'slug' => Str::slug($title, '-'),
            'title' => $title,
            'author_id' => UserFactory::new(),
            'content' => $this->faker->randomHtml(),
        ];
    }
}
