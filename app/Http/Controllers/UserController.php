<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\SignUpFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct(Role $role ,Permission $permission)
    {
        $this->role=$role;
        $this->permission=$permission;
        $this->middleware('auth');
    }

    public function index()
    {
        $roles=Role::all();
        $users = User::latest()->paginate(5);
        $users->load('roles');
        return view('admin.user.index', compact('users','roles'));
    }
    public function add()
    {
        $roles=Role::all();
        return view('admin.user.add',compact('roles'));
    }
    public function addNew(SignUpFormRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user_id=$user->id;
        $userFind=User::find( $user_id);
            $userFind->assignRole($request->role);
        return redirect(route('user.list'));
    }
    public function edit($id){
        $model = User::find($id);
        $roles=Role::all();
        if (!$model) {
            return redirect()->back();
        }
        return view('admin.user.edit', compact('model','roles'));
    }
    public function saveEdit(Request $request,$id){
        $request->validate(
            [
                'name' => [
                    'required',
                    Rule::unique('users')->ignore($id)
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
        $model = User::find($id);
        if (!$model) {
            return redirect()->back();
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        $model->update($data);
        if($request->has('roles')){
            $model->syncRoles($request->roles);
        }
        return redirect(route('user.list'));
    }

    public function edit_pass($id)
    {
        $model = User::find($id);
        if (!$model) {
            return redirect()->back();
        }
        return view('admin.user.edit-pass', compact($model));
    }
    public function saveNewPass(PasswordRequest $request, $id)
    {
        $model =Auth::user();
        $password_confirmation = Hash::make($request->password_confirmation);
        $password_check = Hash::check($request->password_old, $model->password );
        if ($password_check){
            $data = [
                'password' => $password_confirmation
            ];
            $model->update($data);
            // dd(1);
            return redirect(route('user.list'));
        }
        return redirect()->back()->with('msg','Sai mật khẩu');
    }
    public function remove($id){
        $user=User::find($id);
        if(!$user){
            redirect()->back();
        }
        $user->delete();
        return redirect(route('user.list'));
    }
}

