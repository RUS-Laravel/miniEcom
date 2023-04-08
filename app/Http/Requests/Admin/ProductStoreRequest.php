<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'category_id' => ['required'],
            'code' => ['required'],
            'price' => ['required'],
            'stock' => ['required'],
            'status' => ['required', 'in:1,2'],
            'discount' => ['nullable'],
            'description' => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            
        ]);
    }
}
