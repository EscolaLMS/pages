<?php

namespace EscolaLms\Pages\Tests\Api;

use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagesListTest extends TestCase
{
    use DatabaseTransactions;

    private string $uri = '/api/pages';

    public function testAdminCanListEmpty(): void
    {
        $this->authenticateAsAdmin();

        $response = $this->actingAs($this->user, 'api')->getJson('/api/admin/pages');
        $response->assertOk();
        $response->assertJsonStructure([
            'success',
            'data',
            'meta',
            'message'
        ]);
        $response->assertJsonCount(0, 'data');
    }

    public function testAdminCanList(): void
    {
        $this->authenticateAsAdmin();

        $pages = Page::factory()
            ->count(10)
            ->create();

        $pagesArr = $pages->map(function (Page $p) {
            return $p->toArray();
        })->toArray();

        $response = $this->actingAs($this->user, 'api')->getJson('/api/admin/pages');
        $response->assertOk();
        $response->assertJsonFragment(
            $pagesArr[0],
        );
    }

    public function testAnonymousCanListEmpty(): void
    {
        $this->authenticateAsAdmin();

        $response = $this->getJson('/api/pages');
        $response->assertOk();
        $response->assertJsonStructure([
            'success',
            'data',
            'meta',
            'message'
        ]);
        $response->assertJsonCount(0, 'data');
    }

    public function testAnonymousCanList(): void
    {
        $this->authenticateAsAdmin();

        $pages = Page::factory()
            ->count(10)
            ->create(['active' => true]);

        $pagesArr = $pages->map(function (Page $p) {
            return $p->toArray();
        })->values()->toArray();


        $response = $this->getJson('/api/pages');
        $response->assertOk();
        $response->assertJsonFragment(
            $pagesArr[0]
        );
    }

    public function testGuestCannotList(): void
    {
        $response = $this->getJson('/api/pages');
        $response->assertUnauthorized();
    }
}
