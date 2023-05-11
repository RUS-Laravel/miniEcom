<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->title // str($this->title)->slug()->toString()
        ]);
    }

    public function rules()
    {
        return
         [
            'title' => ['required', "unique:products,title"],
            'category_id' => ['required'],
            'code' => ['required'],
            'price' => ['required'],
            'stock' => ['required'],
            'slug' => ['required', "unique:products,slug"],
            'status' => ['required', 'in:1,2'],
            'discount' => ['nullable'],
            'description' => ['nullable'],
            'tags' => ['required'],
            'product_recevied' => ['required'],

        
        ];
    }
}
