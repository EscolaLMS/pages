<?php

namespace EscolaLms\Pages\Http\Controllers\Contracts;

use EscolaLms\Pages\Http\Requests\PageFrontListingRequest;
use EscolaLms\Pages\Http\Requests\PageFrontReadRequest;
use Illuminate\Http\JsonResponse;

interface PagesApiContract
{
    /**
     * @OA\Get(
     *     path="/api/pages",
     *     summary="Lists available pages",
     *     tags={"Pages"},
     *     @OA\Response(
     *         response=200,
     *         description="list of available pages",
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *                type="object",
     *                description="map of pages identified by a slug value",
     *                @OA\AdditionalProperties(
     *                    ref="#/components/schemas/Page"
     *                )
     *            )
     *         )
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="endpoint requires authentication",
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="user doesn't have required access rights",
     *      ),
     *     @OA\Response(
     *          response=500,
     *          description="server-side error",
     *      ),
     * )
     */
    public function list(PageFrontListingRequest $request): JsonResponse;

    /**
     * @OA\Get(
     *     path="/api/pages/{slug}",
     *     summary="Read a page identified by a given slug identifier",
     *     tags={"Pages"},
     *     @OA\Parameter(
     *         description="Unique human-readable page identifier",
     *         in="path",
     *         name="slug",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(ref="#/components/schemas/Page")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="endpoint requires authentication",
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="user doesn't have required access rights",
     *      ),
     *     @OA\Response(
     *          response=500,
     *          description="server-side error",
     *      ),
     * )
     */
    public function read(PageFrontReadRequest $request): JsonResponse;
}
