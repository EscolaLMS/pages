<?php

namespace EscolaLms\Pages\Http\Exceptions;


use EscolaLms\Pages\Models\Page;
use EscolaLms\Pages\Http\Exceptions\Contracts\Renderable;
use Symfony\Component\HttpFoundation\Response;


class PageDoesNotExistsException extends \Exception implements Renderable
{
    public function __construct(string $slug) {
        parent::__construct(sprintf("Page with slug '%s' doesn't exists", $slug));
    }

    public function render(): Response {
        return response()->json($this->message, 400);
    }
}
