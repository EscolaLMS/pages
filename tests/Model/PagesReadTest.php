<?php

namespace EscolaLms\Pages\Tests\Model;

use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesReadTest extends TestCase
{
    private function uri(string $slug): string
    {
        return sprintf('/api/pages/%s', $slug);
    }

    public function testCanReadExisting()
    {
    }

    public function testCannotFindMissing()
    {
    }
}
