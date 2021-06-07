<?php

namespace EscolaLms\Pages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['slug' => $this->route('slug')]);
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        /** @var User $user */
        $user = $this->user();
        return $user!==null && $user->can('update:pages', 'api');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'string|required',
            'title' => 'string|required',
            'content' => 'string|required',
        ];
    }

    /**
     * @returns string
     */
    public function getParamSlug()
    {
        return $this->route('slug');
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
