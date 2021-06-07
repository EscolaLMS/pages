<?php


namespace EscolaLms\Pages\Http\Exceptions;


use Symfony\Component\HttpFoundation\Response;
use EscolaLms\Pages\Models\Page;

class PageAlreadyExistsException extends \Exception
{
    private string $slug;

    public function __construct(Page $page)
    {
        parent::__construct(sprintf("Page with slug '%s' already exists", $page->slug));
        $this->slug = $page->slug;
    }

    public function render(): Response
    {
        return response()->json($this->message, 409);
    }
}
