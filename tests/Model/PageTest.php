<?php

namespace EscolaLms\Pages\Tests\Model;

use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Tests\TestCase;

class PagesModelPageTest extends TestCase
{
    public function testCanList()
    {
        $this->assertGreaterThan(0, Page::all()->count());
    }
}
