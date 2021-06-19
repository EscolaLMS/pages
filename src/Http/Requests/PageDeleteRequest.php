<?php

namespace EscolaLms\Pages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageDeleteRequest extends FormRequest
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
        return $user->can('delete pages', 'api');
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
        ];
    }

    /**
     * @returns string
     */
    public function getParamSlug()
    {
        return $this->route('slug');
    }
}
