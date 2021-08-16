<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignUpFormRequest extends FormRequest
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
       
        
            $ruleArr = [
                'name' => [
                    'required',
                    Rule::unique('users')->ignore($this->id)
                ],
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($this->id)
                ],
                'password' => 'min:6',
                'password_confirmation' => 'required_with:password|same:password|min:6'
            ];
            return $ruleArr;
       
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'name.unique' => 'Tên này đã được sử dụng',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password_confirmation.required' => 'Bạn cần xác nhận lại mật khẩu',
            'password_confirmation.same' => 'Bạn cần nhập đúng mật khẩu đã nhập',
        ];
    }
}
