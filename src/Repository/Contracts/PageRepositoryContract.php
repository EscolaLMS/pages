<?php

namespace EscolaLms\Pages\Repository\Contracts;

use EscolaLms\Pages\Models\Page;

interface PageRepositoryContract
{
    public function all();
    public function getBySlug(string $slug): Page;
    public function deletePage(int $id): bool;
}
