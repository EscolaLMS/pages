<?php

namespace EscolaLms\Pages\Http\Requests;

use EscolaLms\Pages\Enums\PagesPermissionsEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
{


    /**
     * @return bool
     */
    public function authorize()
    {
        /** @var User $user */
        $user = $this->user();
        return $user->can(PagesPermissionsEnum::PAGE_UPDATE, 'api');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => ['string', Rule::unique('pages')->ignore($this->route('id'))],
            'title' => ['string'],
            'content' => ['string'],
        ];
    }

    /**
     * @returns string
     */
    public function getParamSlug()
    {
        return $this->get('slug');
    }
    /**
     * @returns string
     */
    public function getParamTitle()
    {
        return $this->get('title');
    }

    /**
     * @returns string
     */
    public function getParamContent()
    {
        return $this->get('content');
    }
}
