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

    /**
     * @throws EscolaLms\Pages\Http\Exception\PageAlreadyExistsException
     */
    public function insert(string $slug, string $title, string $content, int $userId): Page;

    public function delete(string $slug): bool;

    public function update(string $slug, string $title, string $content): bool;
}
