<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserEditRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'id' => ['required'],
            'name' => ['nullable'],
            'surname' => ['nullable'],
            'email' => ['required', 'email', "unique:users,id,{$this->id}"],
            'password' => ['nullable'],
            'is_user' => ['required', 'in:1,2'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'message' => 'Validation Error',
                    'status' => false,
                    'data' =>$validator->errors()->all()
                ]
            )
        );
    }
}
