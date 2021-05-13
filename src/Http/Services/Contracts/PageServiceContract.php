<?php

namespace EscolaLms\Pages\Http\Services\Contracts;

use EscolaLms\Pages\Models\Page;

/**
 * Interface PageServiceContract
 * @package EscolaLms\Pages\Http\Services\Contracts
 */
interface PageServiceContract
{
    public function listAll();
    public function getBySlug(string $slug): Page;
}
