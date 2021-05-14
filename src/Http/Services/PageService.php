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

    public function listAll(): array
    {
        return $this->repository->all()
            ->map(fn(Page $p) => $p->attributesToArray())
            ->keyBy('slug')
            ->map(fn(array $attributes) => collect($attributes)->except(['slug','id'])->all())
            ->all();
    }

    public function getBySlug(string $slug): Page
    {
        return $this->repository->getBySlug($slug);
    }
}
