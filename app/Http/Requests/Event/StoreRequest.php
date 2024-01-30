<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'description' => [
                'required',
                'string',
                'max:1000'
            ],
            'created_by' => [
                'integer',
                'exists:users,id'
            ],
            'course_id' => [
                'required',
                'integer',
                'exists:courses,id'
            ]
        ];
    }
}
