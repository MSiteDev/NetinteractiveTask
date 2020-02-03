<?php

namespace App\Http\Requests;

use App\Model\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
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
            "first_name" => [
                "required",
                "string",
                "alpha",
                "min:2",
                "max:60"
            ],
            "last_name" => [
                "required",
                "string",
                "alpha",
                "min:2",
                "max:60"
            ],
            "email" => [
                "required",
                "email",
                Rule::unique((new User)->getTable(), "email")
            ],
            "pesel" => [
                "required",
                "digits:11"
            ],
            "languages" => [
                "array",
                "min:1"
            ],
            "languages.*" => [
                "string",
                "min:1",
                "max:60"
            ]
        ];
    }
}
