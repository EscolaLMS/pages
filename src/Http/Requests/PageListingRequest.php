<?php

namespace EscolaLms\Pages\Http\Requests;

use EscolaLms\Pages\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class PageListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('list', Page::class);
    }

    public function rules(): array
    {
        return [];
    }
}
