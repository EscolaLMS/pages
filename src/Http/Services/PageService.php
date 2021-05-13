<?php

namespace EscolaLms\Pages\Http\Services;

use EscolaLms\Pages\Http\Services\Contracts\PageServiceContract;
use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Repository\Contracts\PageRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class PageService implements PageServiceContract
{
    private PageRepositoryContract $repository;

    public function __construct(PageRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function listAll(): Collection
    {
        return $this->repository->all();
    }

    public function getBySlug(string $slug): Page
    {
        return $this->repository->getBySlug($slug);
    }
}
