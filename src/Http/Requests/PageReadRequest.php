<?php

namespace EscolaLms\Pages\Http\Requests;

use EscolaLms\Pages\Enums\PagesPermissionsEnum;
use Illuminate\Foundation\Http\FormRequest;

class PageReadRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = $this->user();
        return $user->can(PagesPermissionsEnum::PAGE_READ, 'api');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    public function getParamSlug()
    {
        return $this->route('slug');
    }
}
