<?php

namespace EscolaLms\Pages\Repository;

use EscolaLms\Core\Repositories\BaseRepository;
use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Repository\Contracts\PageRepositoryContract;
use Illuminate\Support\Collection;

class PageRepository extends BaseRepository implements PageRepositoryContract
{

    public function model()
    {
        return Page::class;
    }

    public function getFieldsSearchable()
    {
        return [];
    }

    public function all(array $search = [], ?int $skip = null, ?int $limit = null, array $columns = ['*'], string $orderDirection = 'asc', string $orderColumn = 'id')
    {
        return parent::all($search, $skip, $limit, $columns, $orderDirection, $orderColumn);
    }

    /**
     * @param string $slug
     * @return Page
     */
    public function getBySlug(string $slug): Page {
        return $this->model->newQuery()->where('slug', $slug)->firstOrNew();
    }

    /**
     * @param Page $page
     * @return Page
     */
    public function insert(Page $page): Page
    {
        return $this->createUsingModel($page);
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function deletePage(string $slug): bool {
        return $this->model->newQuery()->where('slug', $slug)->delete();
    }
}
