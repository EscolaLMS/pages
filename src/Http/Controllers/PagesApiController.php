<?php

namespace EscolaLms\Pages\Http\Controllers;

use EscolaLms\Core\Http\Controllers\EscolaLmsBaseController;
use EscolaLms\Pages\Http\Controllers\Contracts\PagesApiContract;
use EscolaLms\Pages\Http\Requests\PageDeleteRequest;
use EscolaLms\Pages\Http\Requests\PageCreateRequest;
use EscolaLms\Pages\Http\Requests\PageListingRequest;
use EscolaLms\Pages\Http\Requests\PageUpdateRequest;
use EscolaLms\Pages\Http\Requests\PageReadRequest;
use EscolaLms\Pages\Http\Services\Contracts\PageServiceContract;
use EscolaLms\Pages\Http\Exceptions\Contracts\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PagesApiController extends EscolaLmsBaseController implements PagesApiContract
{
    private PageServiceContract $pageService;

    public function __construct(PageServiceContract $pageService)
    {
        $this->pageService = $pageService;
    }

    public function list(PageListingRequest $request): JsonResponse
    {
        try {
            $pages = $this->pageService->listAll(['active'=>true]);
            return $this->sendResponse($pages, "pages list retrieved successfully");
        } catch (Renderable $e) {
            return $this->sendError($e->getMessage());
        }
    }


    public function read(PageReadRequest $request): JsonResponse
    {
        try {
            $slug = $request->getParamSlug();
            $page = $this->pageService->getBySlug($slug);
            if ($page->exists) {
                if (!$page->active) {
                    return $this->sendError(sprintf("You don't have access to page with slug '%s'", $slug), 403);
                }
                return $this->sendResponse($page, "page fetched successfully");
            }
            return $this->sendError(sprintf("Page with slug '%s' doesn't exists", $slug), 404);
        } catch (Renderable $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
