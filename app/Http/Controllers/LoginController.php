<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function PostLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Hãy nhập tài khoản',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Hãy nhập password'
            ]
        );
        $remember = $request->has('remember_me') ? 'true' : 'false';
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('room.list'));
        }
        return redirect()->back()->with('msg', 'sai thong tin');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function registerAdd(Request $request)
    {
        $request->validate(
            [
                'name' => [
                    'required',
                    Rule::unique('users')
                ],
                'email' => 'required|email',
                'password' => 'required|min:6'
            ],
            [
                'name.required' => 'Hãy nhập tên tài khoản',
                'name.unique' => 'Tên này đã được sử dụng',
                'email.required' => 'Hãy nhập email cho tài khoản',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Hãy nhập password',
                'password.min' => 'Password phải từ 6 ký tự' 
            ]
        );
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);
        return redirect(route('login'))->with('status', 'Đăng ký thành công');
    }
}
