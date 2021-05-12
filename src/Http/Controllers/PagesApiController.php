<?php

namespace EscolaLms\Pages\Http\Controllers;

use EscolaLms\Core\Http\Controllers\EscolaLmsBaseController;
use EscolaLms\Pages\Http\Controllers\Contracts\PagesApiContract;
use EscolaLms\Pages\Http\Requests\PageDeleteRequest;
use EscolaLms\Pages\Http\Requests\PageInsertRequest;
use EscolaLms\Pages\Http\Requests\PageListingRequest;
use EscolaLms\Pages\Http\Requests\PageUpdateRequest;
use EscolaLms\Pages\Http\Requests\PageViewRequest;
use Illuminate\Http\JsonResponse;

class PagesApiController extends EscolaLmsBaseController implements PagesApiContract
{
    public function list(PageListingRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented', 404);
    }

    public function insert(PageInsertRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented', 404);
    }

    public function update(PageUpdateRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented', 404);
    }

    public function delete(PageDeleteRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented', 404);
    }

    public function view(PageViewRequest $request): JsonResponse
    {
        return $this->sendError('Not implemented', 404);
    }

}
