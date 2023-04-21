<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    protected function failedValidation(Validator $validator)
    {

        // dd($validator->errors());
        //  if ($this->ajax() or $this->routeIs('api/*'))
        if ($this->ajax())
            throw new HttpResponseException(
                response()->json([
                    'message' => 'validation Error',
                    'data' => implode(',', $validator->errors()->all())
                ])
            );
        else {
            throw new HttpResponseException(
                back()->withErrors($validator->errors()->all())
            );
        }
    }
}
