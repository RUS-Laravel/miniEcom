<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class InformationRequest extends BaseRequest
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
            'user_id' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
        ];
    }
}
