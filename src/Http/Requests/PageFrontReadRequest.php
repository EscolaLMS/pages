<?php

namespace EscolaLms\Pages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageFrontReadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function getParamSlug()
    {
        return $this->route('slug');
    }
}
