<?php

namespace EscolaLms\Pages\Http\Requests;

use EscolaLms\Core\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class PageCreateRequest extends FormRequest
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
        return $user!==null && $user->can('create:pages', 'api');
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
     * @return string
     */
    public function getParamSlug()
    {
        return $this->route('slug');
    }

    /**
     * @return string
     */
    public function getParamTitle()
    {
        return $this->get('title');
    }

    /**
     * @return string
     */
    public function getParamContent()
    {
        return $this->get('content', '');
    }
}