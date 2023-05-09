<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends BaseRequest
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
            'id' => ['required'],
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required', 'email', "unique:users,id,{$this->id}"],
            'password' => ['required'],
        ];
    }
}
