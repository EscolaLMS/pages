<?php

namespace EscolaLms\Pages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageReadRequest extends FormRequest
{


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
        ];
    }

    public function getParamSlug()
    {
        return $this->route('slug');
    }
}
