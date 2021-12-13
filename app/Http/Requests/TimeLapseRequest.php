<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class TimeLapseRequest extends FormRequest
{

    public function rules()
    {
        return[
            'time_lapse' => 'required|max:255'
        ];
    }
}