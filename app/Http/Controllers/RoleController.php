<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $model=Role::paginate(5);
        $model->load('permissions');
        return view('admin.role.index',compact('model'));
    }


    public function add()
    {
        $permissions=Permission::all();
        return view('admin.role.add',compact('permissions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>[
                'required',
                Rule::unique('roles')
            ]
        ],[
            'name.required'=>'Bạn chưa nhập tên',
            'name.unique'=>'Tên này đã được sử dụng'
        ]);

        $roles=   Role::create([
            'name'=>$request->name
        ]);

        if($request->has('permissions')){
            $roles->givePermissionTo($request->permissions);
        }
        return redirect()->route('role.list');
    }



    public function edit($id)
    {
        $role=Role::find($id);
        $permissions=Permission::all();
        return view('admin.role.edit',compact('role','permissions'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>[
                'required',
                Rule::unique('roles')->ignore($id)
            ]
        ],[
            'name.required'=>'Bạn chưa nhập tên',
            'name.unique'=>'Tên này đã được sử dụng'
        ]);
        $role=Role::find($id);
        $role->update([
            'name'=>$request->name
        ]);
        if($request->has('permissions')){

            $role->syncPermissions($request->permissions);
        }
        return redirect(route('role.list'));
    }


    public function remove($id)
    {
        $role=Role::find($id);
        if(!$role){
            redirect()->back();
        }
        $role->delete();
        return redirect(route('role.list'));
    }
}
