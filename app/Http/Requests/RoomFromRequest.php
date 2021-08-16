<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\This;

class RoomFromRequest extends FormRequest
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
        
        $ruleArr=[
            'room_no' =>[
                'required',
                Rule::unique('rooms')->ignore($this->id)
            ],
            'price'=>'required|numeric',
            'floor'=>'required|numeric',  
            'detail'=>'required'  
        ];
        if($this->id==null){
            $ruleArr['image'] = 'required|mimes:jpg,bmp,png,jpeg';
        }else{
            $ruleArr['image'] = 'mimes:jpg,bmp,png,jpeg';
        }
        return $ruleArr;
    }
    public function messages(){
        return [
            'room_no.required' =>'chưa nhập tên phong',
            'room_no.unique'  =>'tên phong da tồn tại',
            'price.required'=>'chưa nhập giá',
            'price.numeric'=>'giá không đúng định dạng',
            'floor.numeric'=>'tang phai la so',
            'floor.required'=>'chưa nhập số tang',
            'image.required'=>'bạn chưa chọn ảnh',
            'image.mimes'=>'file ảnh không đúng định dạng (jpg,bmp,png,jpeg)',
            'detail.required'=>'bạn chưa nhập chi tiết',
        ];
    }
}
