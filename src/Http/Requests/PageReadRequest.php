<?php

namespace EscolaLms\Pages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageReadRequest extends FormRequest
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
        return true;
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

    public function getParamSlug()
    {
        return $this->route('slug');
    }
}
