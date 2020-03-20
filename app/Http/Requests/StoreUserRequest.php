<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
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
            'identification' => ['required',
            Rule::unique('users', 'identification')
            ],
            'first_name'     => ['required'],
            'last_name'      => ['required'],
            'email'          => ['required', 'email:rfc,dns'],
            'password'       => ['required', 'password:api']
        ];
    }
}
