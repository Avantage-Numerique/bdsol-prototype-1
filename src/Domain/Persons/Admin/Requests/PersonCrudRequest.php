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
            'nickname' => 'min:1',
            'address' => 'min:1',
            //'avatar' => 'mimes:jpeg,jpg,png|image|max:3000'
        ];
    }

    // OPTIONAL OVERRIDE
    // public function forbiddenResponse()
    // {
    // Optionally, send a custom response on authorize failure
    // (default is to just redirect to initial page with errors)
    //
    // Can return a response, a view, a redirect, or whatever else
    // return Response::make('Permission denied foo!', 403);
    // }

    // OPTIONAL OVERRIDE
    // public function response()
    // {
    // If you want to customize what happens on a failed validation,
    // override this method.
    // See what it does natively here:
    // https://github.com/laravel/framework/blob/master/src/Illuminate/Foundation/Http/FormRequest.php
    // }
}
