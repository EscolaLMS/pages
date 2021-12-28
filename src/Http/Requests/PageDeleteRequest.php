<?php

namespace EscolaLms\Pages\Http\Requests;

use EscolaLms\Pages\Enums\PagesPermissionsEnum;
use Illuminate\Foundation\Http\FormRequest;

class PageDeleteRequest extends FormRequest
{


    /**
     * @return bool
     */
    public function authorize()
    {
        /** @var User $user */
        $user = $this->user();
        return $user->can(PagesPermissionsEnum::PAGE_DELETE, 'api');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
