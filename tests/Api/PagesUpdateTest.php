<?php

namespace EscolaLms\Pages\Tests\Api;

use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Repository\PageRepository;
use EscolaLms\Pages\Tests\TestCase;

class PagesUpdateTest extends TestCase
{
    private function uri(string $slug): string
    {
        return sprintf('/api/pages/%s', $slug);
    }

    public function testAdminCanUpdateExistingPage()
    {
        $this->authenticateAsAdmin();

        $page = Page::factory()->createOne();
        $pageNew = Page::factory()->makeOne();

        $response = $this->actingAs($this->user, 'api')->patchJson(
            $this->uri($page->slug),
            [
                'title' => $pageNew->title,
                'content' => $pageNew->content,
            ]
        );
        $response->assertOk();
        $page->refresh();

        $this->assertEquals($pageNew->title, $page->title);
        $this->assertEquals($pageNew->content, $page->content);
    }

    public function testAdminCannotUpdateExistingPageWithMissingTitle()
    {
        $this->authenticateAsAdmin();

        $page = Page::factory()->createOne();
        $pageNew = Page::factory()->makeOne();
        $oldTitle = $page->title;
        $oldContent = $page->content;

        $response = $this->actingAs($this->user, 'api')->patchJson(
            $this->uri($page->slug),
            [
                'content' => $pageNew->content,
            ]
        );
        $response->assertStatus(422);
        $page->refresh();

        $this->assertEquals($oldTitle, $page->title);
        $this->assertEquals($oldContent, $page->content);
    }

    public function testAdminCannotUpdateExistingPageWithMissingContent()
    {
        $this->authenticateAsAdmin();

        $page = Page::factory()->createOne();
        $pageNew = Page::factory()->makeOne();
        $oldTitle = $page->title;
        $oldContent = $page->content;

        $response = $this->actingAs($this->user, 'api')->patchJson(
            $this->uri($page->slug),
            [
                'title' => $pageNew->title,
            ]
        );
        $response->assertStatus(422);
        $page->refresh();

        $this->assertEquals($oldTitle, $page->title);
        $this->assertEquals($oldContent, $page->content);
    }

    public function testAdminCannotUpdateMissingPage()
    {
        $this->authenticateAsAdmin();

        $page = Page::factory()->makeOne();

        $response = $this->actingAs($this->user, 'api')->patchJson(
            $this->uri($page->slug),
            [
                'title' => $page->title,
                'content' => $page->content,
            ]
        );
        $response->assertStatus(400);
        $this->assertEquals(0,$page->newQuery()->where('slug',$page->slug)->count());
    }

    public function testGuestCannotUpdateExistingPage()
    {
        $page = Page::factory()->createOne();
        $pageNew = Page::factory()->makeOne();

        $oldTitle = $page->title;
        $oldContent = $page->content;

        $response = $this->patchJson(
            $this->uri($page->slug),
            [
                'title' => $pageNew->title,
                'content' => $pageNew->content,
            ]
        );
        $response->assertUnauthorized();
        $page->refresh();

        $this->assertEquals($oldTitle, $page->title);
        $this->assertEquals($oldContent, $page->content);
    }
}
