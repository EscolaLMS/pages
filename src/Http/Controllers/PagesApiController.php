<?php

namespace EscolaLms\Pages\Http\Controllers;

use EscolaLms\Core\Http\Controllers\EscolaLmsBaseController;
use EscolaLms\Pages\Http\Controllers\Contracts\PagesApiContract;
use EscolaLms\Pages\Http\Requests\PageDeleteRequest;
use EscolaLms\Pages\Http\Requests\PageInsertRequest;
use EscolaLms\Pages\Http\Requests\PageListingRequest;
use EscolaLms\Pages\Http\Requests\PageUpdateRequest;
use EscolaLms\Pages\Http\Requests\PageViewRequest;
use EscolaLms\Pages\Http\Services\Contracts\PageServiceContract;
use Illuminate\Http\JsonResponse;

class PagesApiController extends EscolaLmsBaseController implements PagesApiContract
{
    private PageServiceContract $pageService;

    public function __construct(PageServiceContract $pageService)
    {
        $this->pageService = $pageService;
    }

    public function list(PageListingRequest $request): JsonResponse
    {
        $pages = $this->pageService->listAll();
        return response()->json($pages);
    }

    public function read(PageViewRequest $request): JsonResponse
    {
        $slug = $request->getSlug();
        $page = $this->pageService->getBySlug($slug);
        if ($page->exists) {
            return response()->json($page);
        } else {
            return response()->json(
                sprintf("Page identified by '%s' doesn't exists",$slug),
                404
            );
        }
    }

    public function insert(PageInsertRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented', 404);
    }

    public function delete(PageDeleteRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented', 404);
    }

    public function update(PageUpdateRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented', 404);
    }

}
