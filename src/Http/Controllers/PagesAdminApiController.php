<?php

namespace EscolaLms\Pages\Http\Controllers;

use EscolaLms\Core\Http\Controllers\EscolaLmsBaseController;
use EscolaLms\Pages\Http\Controllers\Contracts\PagesAdminApiContract;
use EscolaLms\Pages\Http\Requests\PageDeleteRequest;
use EscolaLms\Pages\Http\Requests\PageCreateRequest;
use EscolaLms\Pages\Http\Requests\PageListingRequest;
use EscolaLms\Pages\Http\Requests\PageUpdateRequest;
use EscolaLms\Pages\Http\Requests\PageReadRequest;
use EscolaLms\Pages\Http\Services\Contracts\PageServiceContract;
use EscolaLms\Pages\Http\Exceptions\Contracts\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PagesAdminApiController extends EscolaLmsBaseController implements PagesAdminApiContract
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
            return $this->sendResponse($pages, "pages list retrieved successfully");
        } catch (Renderable $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function create(PageCreateRequest $request): JsonResponse
    {
        try {
            $slug = $request->getParamSlug();
            $title = $request->getParamTitle();
            $content = $request->getParamContent();
            $active = $request->get('active');

            $user = Auth::user();
            $page = $this->pageService->insert($slug, $title, $content, $user->id, $active);
            return $this->sendResponse($page, "page created successfully");
        } catch (Renderable $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function update(PageUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $input = $request->all();

            $updated = $this->pageService->update($id, $input);
            if (!$updated) {
                return $this->sendError(sprintf("Page with slug '%s' doesn't exists", $id), 404);
            }
            return $this->sendResponse($updated, "page updated successfully");
        } catch (Renderable $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function delete(PageDeleteRequest $request, int $id): JsonResponse
    {
        try {
            $deleted = $this->pageService->deleteById($id);
            if (!$deleted) {
                return $this->sendError(sprintf("Page with id '%s' doesn't exists", $id), 404);
            }
            return $this->sendResponse($deleted, "page updated successfully");
        } catch (Renderable $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function read(PageReadRequest $request, int $id): JsonResponse
    {
        try {
            $page = $this->pageService->findById($id);
            if ($page->exists) {
                return $this->sendResponse($page, "page fetched successfully");
            }
            return $this->sendError(sprintf("Page with id '%s' doesn't exists", $id), 404);
        } catch (Renderable $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
