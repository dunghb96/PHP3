<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password_old' => 'required|min:6',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ];
    }
    public function messages()
    {
        return [
            'password_old.required' => 'Bạn chưa nhập mật khẩu cũ',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password_old.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password_confirmation.required' => 'Bạn cần xác nhận lại mật khẩu',
            'password_confirmation.same' => 'Bạn cần nhập đúng mật khẩu đã nhập',
            'password_confirmation.min' => 'Mật khẩu tối thiểu 6 ký tự',
        ];
    }
}
