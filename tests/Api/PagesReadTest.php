<?php

namespace EscolaLms\Pages\Tests\Model;

use EscolaLms\Pages\Tests\TestCase;

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
