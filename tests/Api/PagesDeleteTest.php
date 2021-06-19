<?php

namespace EscolaLms\Pages\Tests\Api;

use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Repository\PageRepository;
use EscolaLms\Pages\Tests\TestCase;

class PagesDeleteTest extends TestCase
{
    private function uri(string $slug): string
    {
        return sprintf('/api/pages/%s', $slug);
    }

    public function testAdminCanDeleteExistingPage()
    {
        $this->authenticateAsAdmin();

        $page = Page::factory()->createOne();
        $response = $this->actingAs($this->user, 'api')->delete($this->uri($page->slug));
        $response->assertOk();
        $this->assertEquals(0,Page::factory()->make()->newQuery()->where('slug',$page->slug)->count());
    }

    public function testAdminCannotDeleteMissingPage()
    {
        $this->authenticateAsAdmin();

        $page = Page::factory()->makeOne();
        $response = $this->actingAs($this->user, 'api')->delete($this->uri($page->slug));
        $response->assertStatus(400);
    }

    public function testGuestCannotDeleteExistingPage()
    {
        $page = Page::factory()->createOne();
        $response = $this->json('delete', $this->uri($page->slug));
        $response->assertUnauthorized();
    }
}
