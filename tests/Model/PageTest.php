<?php

namespace EscolaLms\Pages\Tests\Model;

use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Tests\TestCase;

class PagesModelPageTest extends TestCase
{
    public function testCanList()
    {
        Page::factory()
            ->count(10)
            ->create()
        ;
        self::assertCount(10, Page::all());
    }
}
