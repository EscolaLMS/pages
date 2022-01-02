<?php

namespace EscolaLms\Pages\Http\Requests;

use EscolaLms\Core\Models\User;
use EscolaLms\Pages\Enums\PagesPermissionsEnum;
use Illuminate\Foundation\Http\FormRequest;

class PageCreateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = $this->user();
        return $user->can(PagesPermissionsEnum::PAGE_CREATE, 'api');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'slug' => 'string|required|unique:pages',
            'title' => 'string|required',
            'content' => 'string|required',
        ];
    }

    /**
     * @return string
     */
    public function getParamTitle(): string
    {
        return $this->get('title');
    }

    /**
     * @return string
     */
    public function getParamSlug(): string
    {
        return $this->get('slug');
    }

    /**
     * @return string
     */
    public function getParamContent(): string
    {
        return $this->get('content', '');
    }
}
