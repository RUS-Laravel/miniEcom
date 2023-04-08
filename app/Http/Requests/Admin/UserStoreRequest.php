<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required', 'email', "unique:users"],
            'password' => ['required'],
            'is_user' => ['required', 'in:1,2'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // dd($validator->errors()->messages());
        # ya json formatında yada view html formatında response type
        throw new HttpResponseException(
            back()->withErrors($validator->errors()->all())
        );
    }
}
