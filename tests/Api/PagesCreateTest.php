<?php

namespace EscolaLms\Pages\Tests\Api;

use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Repository\PageRepository;
use EscolaLms\Pages\Tests\TestCase;

class PagesCreateTest extends TestCase
{
    private function uri(string $slug): string
    {
        return sprintf('/api/pages/%s', $slug);
    }

    public function testAdminCanCreatePage()
    {
        $this->authenticateAsAdmin();
        $page = Page::factory()->makeOne();
        $response = $this->actingAs($this->user, 'api')->postJson(
            $this->uri($page->slug),
            collect($page->getAttributes())->except('id','slug')->toArray()
        );

        $response->assertOk();
        //TODO: make sure the page exists
    }

    public function testAdminCannotCreatePageWithoutTitle()
    {
        $this->authenticateAsAdmin();

        $page = Page::factory()->makeOne();
        $response = $this->actingAs($this->user, 'api')->postJson(
            $this->uri($page->slug),
            collect($page->getAttributes())->except('id','slug','title')->toArray()
        );
        $response->assertStatus(422);
        //TODO: make sure the page doesn't exists
    }

    public function testAdminCannotCreatePageWithoutContent()
    {
        $this->authenticateAsAdmin();

        $page = Page::factory()->makeOne();
        $response = $this->actingAs($this->user, 'api')->postJson(
            $this->uri($page->slug),
            collect($page->getAttributes())->except('id','slug','content')->toArray()
        );
        $response->assertStatus(422);
        //TODO: make sure the page doesn't exists
    }

    public function testAdminCannotCreateDuplicatePage()
    {
        $this->authenticateAsAdmin();

        $page = Page::factory()->createOne();
        $duplicate = Page::factory()->makeOne($page->getAttributes());
        $response = $this->actingAs($this->user, 'api')->postJson($this->uri($duplicate->slug));
        $response->assertStatus(422);
    }

    public function testGuestCannotCreatePage()
    {
        $page = Page::factory()->makeOne();
        $response = $this->postJson(
            $this->uri($page->slug),
            collect($page->getAttributes())->except('id','slug')->toArray()
        );
        $response->assertUnauthorized();
    }
}
