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
        /** @var Page $page */
        $page = Page::factory()->newModel([
            'slug'=>$slug,
            'title'=>$title,
            'author_id'=>$userId,
            'content'=>$content,
        ]);
        $this->repository->insert($page);
        if (!$page->exists()) {
            throw new PageAlreadyExistsException($page);
        }
        return $page;
    }

    public function delete(string $slug): bool {
        return $this->repository->deletePage($slug);
    }

    public function update(string $slug, string $title, string $content): bool {
        $page = $this->repository->getBySlug($slug);
        if (!$page->exists) {
            return false;
        }
        $page->title = $title;
        $page->content = $content;
        return $this->repository->save($page);
    }
}
