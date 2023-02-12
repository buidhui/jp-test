<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationTeacher extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:teachers,email',
            'phone' => 'required|numeric|digits:10'

        ];
    }

    public function messages()
    {
        return [
            'email.unique'  => 'Email đã tồn tại',
            'phone.digits' => 'Số điện thoại không hợp lệ'
        ];
    }
}
