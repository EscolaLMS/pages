<?php

namespace EscolaLms\Pages\Tests\Model;

use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesListTest extends TestCase
{
    private string $uri = '/api/pages';

    public function testCanListEmpty()
    {
        $response = $this->getJson($this->uri);
        $response->assertOk();
        $response->assertJsonCount(0);
    }

    public function testCanList()
    {
        $pages = Page::factory()
            ->count(10)
            ->create()
        ;
        $response = $this->getJson($this->uri);
        $response->assertOk();
        $response->assertJson(
            $pages->map(fn(Page $p)=>$p->attributesToArray())->all()
        );
    }
}
