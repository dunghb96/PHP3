<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceFormRequest extends FormRequest
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
                Rule::unique('services')->ignore($this->id)
            ],
        ];
        if ($this->id == null) {
            $ruleArr['icon'] = 'required|mimes:jpg,bmp,png,jpeg';
        } else {
            $ruleArr['icon'] = 'mimes:jpg,bmp,png,jpeg';
        }
        return $ruleArr;
    }
    public function messages()
    {
        return [
            'name.required' => 'chưa nhập tên phong',
            'name.unique'  => 'tên phong da tồn tại',
            'icon.required' => 'bạn chưa chọn ảnh',
            'icon.mimes' => 'file ảnh không đúng định dạng (jpg,bmp,png,jpeg)'
        ];
    }
}
