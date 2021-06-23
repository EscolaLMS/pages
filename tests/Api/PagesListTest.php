<?php

namespace EscolaLms\Pages\Tests\Api;

use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Tests\TestCase;

class PagesListTest extends TestCase
{
    private string $uri = '/api/pages';

    public function testAdminCanListEmpty()
    {
        $this->authenticateAsAdmin();

        $response = $this->getJson($this->uri);
        $response->assertOk();
        $response->assertJsonCount(0);
    }

    public function testAdminCanList()
    {
        $this->authenticateAsAdmin();

        $pages = Page::factory()
            ->count(10)
            ->create()
        ;
        $response = $this->getJson($this->uri);
        $response->assertOk();
        $response->assertJson(
            $pages->map(fn(Page $p) => $p->attributesToArray())
                ->keyBy('slug')
                ->map(fn(array $attributes) => collect($attributes)->except(['slug','id'])->all())
                ->all()
        );
    }
}
