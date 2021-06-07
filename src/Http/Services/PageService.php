<?php

namespace EscolaLms\Pages\Http\Services;

use EscolaLms\Pages\Http\Services\Contracts\PageServiceContract;
use EscolaLms\Pages\Http\Exceptions\PageAlreadyExistsException;
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

    /**
     * @param string $slug
     * @param string $title
     * @param string $content
     * @param int $userId
     * @return Page
     * @throws PageAlreadyExistsException
     */
    public function insert(string $slug, string $title, string $content, int $userId): Page
    {
        $page = $this->repository->getBySlug($slug);
        if ($page->exists()) {
            throw new PageAlreadyExistsException($page);
        }

        $page->fill([
            'slug'=>$slug,
            'title'=>$title,
            'author_id'=>$userId,
            'content'=>$content,
        ]);
        $this->repository->insert($page);
        return $page;
    }
}
