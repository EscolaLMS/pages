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
            $pages = $this->pageService->listAll();
            return response()->json($pages);
        } catch (Renderable $e) {
            return $e->render();
        }
    }

    public function create(PageCreateRequest $request): JsonResponse
    {
        try {
            $slug = $request->getParamSlug();
            $title = $request->getParamTitle();
            $content = $request->getParamContent();

            $user = Auth::user();
            $page = $this->pageService->insert($slug,$title,$content,$user->id);
            return response()->json($page);
        } catch (Renderable $e) {
            return $e->render();
        }
    }

    public function update(PageUpdateRequest $request): JsonResponse
    {
        try {
            $slug = $request->getParamSlug();
            $title = $request->getParamTitle();
            $content = $request->getParamContent();

            $updated = $this->pageService->update($slug, $title, $content);
            if (!$updated) {
                return response()->json(sprintf("Page with slug '%s' doesn't exists", $slug), 400);
            } else {
                return response()->json('ok',200);
            }
        } catch (Renderable $e) {
            return $e->render();
        }
    }

    public function delete(PageDeleteRequest $request): JsonResponse
    {
        try {
            $slug = $request->getParamSlug();

            $deleted = $this->pageService->deleteBySlug($slug);
            if (!$deleted) {
                return response()->json(sprintf("Page with slug '%s' doesn't exists", $slug), 400);
            } else {
                return response()->json('ok',200);
            }
        } catch (Renderable $e) {
            return $e->render();
        }
    }

    public function read(PageReadRequest $request): JsonResponse
    {
        try {
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
        } catch (Renderable $e) {
            return $e->render();
        }
    }
}
