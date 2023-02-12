<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoundRequest extends FormRequest
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
            'name' => 'required|unique:round,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên vòng thi không được trống !',
            'name.unique'  => 'Tên vòng thi đã tồn tại',
        ];
    }
}
