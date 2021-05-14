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
    public function getBySlug(string $slug) {
        return $this->model->newQuery()->where('slug', $slug)->firstOrNew();
    }

    public function insert(Page $page)
    {
        return $this->createUsingModel();
    }
}
