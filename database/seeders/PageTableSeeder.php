<?php

namespace EscolaLms\Pages\Database\Seeders;

use EscolaLms\Pages\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class PageTableSeeder extends Seeder
{
    use WithFaker;

    public function run()
    {
        $this->faker = $this->makeFaker();

        Page::factory()
            ->count(10)
            ->create()
        ;
    }
}
