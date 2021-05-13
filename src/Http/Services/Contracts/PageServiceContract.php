<?php

namespace EscolaLms\Pages\Http\Services\Contracts;

use EscolaLms\Pages\Models\Page;

/**
 * Interface PageServiceContract
 * @package EscolaLms\Pages\Http\Services\Contracts
 */
interface PageServiceContract
{
    /**
     * @return Page[]
     */
    public function listAll(): array;

    public function getBySlug(string $slug): Page;
}
