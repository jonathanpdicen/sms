<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user'))
            ],
        ];
    }
}
