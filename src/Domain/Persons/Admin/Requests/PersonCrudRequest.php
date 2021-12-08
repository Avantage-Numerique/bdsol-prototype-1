<?php

namespace Domain\Persons\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonCrudRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow creates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            //'avatar' => 'mimes:jpeg,jpg,png|image|max:3000'
        ];
    }
}
