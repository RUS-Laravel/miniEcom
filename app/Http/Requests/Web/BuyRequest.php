<?php

namespace App\Http\Requests\Web;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BuyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('client')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address' => ['required'],
            'telephone' => ['required'],
            'payment_type' => ['required'],
        ];
    }

    public function validatedData()
    {
        $this->merge([
            'user_id' => auth('client')->id(),
            'status' => 'Processing',
            'payment_status' => 'Processing',
            'no' => uniqid(),
            'discount' => Cart::discount(2, '.', ''),
            'total' => Cart::total(2, '.', ''),
        ]);
        return $this->all();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            back()->withErrors($validator->errors()->all())
        );
    }
}
