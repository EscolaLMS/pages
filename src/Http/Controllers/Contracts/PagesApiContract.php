<?php

namespace EscolaLms\Pages\Http\Controllers\Contracts;

use EscolaLms\Pages\Http\Requests\PageDeleteRequest;
use EscolaLms\Pages\Http\Requests\PageInsertRequest;
use EscolaLms\Pages\Http\Requests\PageListingRequest;
use EscolaLms\Pages\Http\Requests\PageUpdateRequest;
use EscolaLms\Pages\Http\Requests\PageViewRequest;
use Illuminate\Http\JsonResponse;

/**
 * SWAGGER_VERSION
 */
interface PagesApiContract
{
    public function list(PageListingRequest $request): JsonResponse;
    public function insert(PageInsertRequest $request): JsonResponse;
    public function update(PageUpdateRequest $request): JsonResponse;
    public function delete(PageDeleteRequest $request): JsonResponse;
    public function view(PageViewRequest $request): JsonResponse;
}
