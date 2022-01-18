<?php

namespace EscolaLms\Pages\Http\Requests;

use EscolaLms\Pages\Models\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('update', Page::class);
    }

    public function rules(): array
    {
        return [
            'slug' => ['string', Rule::unique('pages')->ignore($this->route('id'))],
            'title' => ['string'],
            'content' => ['string'],
        ];
    }

    public function getParamSlug(): string
    {
        return $this->get('slug');
    }

    public function getParamTitle(): string
    {
        return $this->get('title');
    }

    public function getParamContent(): string
    {
        return $this->get('content');
    }
}
