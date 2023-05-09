<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryEditRequest extends FormRequest
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
            'description' => ['nullable'],
            'parent_id' => ['nullable'],
            'status' => ['required', 'in:1,2'],
            'tags' => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        # ya json formatında yada view html formatında response type
        throw new HttpResponseException(
            response()->json([
                'message' => 'validation Error',
                'data' => implode(',',$validator->errors()->all())
            ])
        );
    }
}
