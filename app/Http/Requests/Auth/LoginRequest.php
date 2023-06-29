<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
            'remember_me' => ['nullable'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        dd("e");
        # ya json formatında yada view html formatında response type
        if ($this->is('api/*'))
            throw new HttpResponseException(
                response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST)
            );
        else
            throw new HttpResponseException(
                back()->withErrors($validator->errors()->all())
            );
    }
}
