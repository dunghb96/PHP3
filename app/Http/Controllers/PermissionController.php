<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        $model=Permission::paginate(10);
        return view('admin.permission.index',compact('model'));
    }

    public function create()
    {
        return view('admin.permission.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ],[
            'name.required'=>'Bạn chưa nhập tên quyền'
        ]);
        $model= new Permission();
        $model->create($request->all());
        return redirect(route('permission.list'));
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $model=Permission::find($id);
        return view('admin.permission.edit',compact('model'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>[
                'required',
                Rule::unique('permissions')->ignore($id)
            ]
        ],[
            'name.required'=>'Bạn chưa nhập tên quyền',
            'name.unique'=>'Tên này đã tồn tại'
        ]);
        $model=Permission::find($id);
        $model->fill($request->all());
        $model->save();
        return redirect(route('permission.list'));
    }


    public function remove($id)
    {
        $model=Permission::find($id);
        if(!$model){
            return redirect()->back();
        }
        $model->delete();
        return redirect(route('permission.list'));
    }
}
