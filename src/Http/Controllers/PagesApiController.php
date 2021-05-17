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
        $pages = $this->pageService->listAll();
        return response()->json($pages);
    }

    public function create(PageCreateRequest $request): JsonResponse
    {
        $slug = $request->getParamSlug();
        $title = $request->getParamTitle();
        $content = $request->getParamContent();

        $user = Auth::user();
        $page = $this->pageService->insert($slug,$title,$content,$user->id);
        return response()->json($page);
    }

    public function update(PageUpdateRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented', 404);
    }

    public function delete(PageDeleteRequest $request): JsonResponse
    {
        $this->pageService->delete($request->getParamSlug());
        return response()->json('ok',200);
    }

    public function read(PageReadRequest $request): JsonResponse
    {
        $slug = $request->getParamSlug();
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
}
