<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceFormRequest;
use App\Models\Room;
use App\Models\Room_service;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $list=Service::latest()->paginate(5);
        return view('admin.service.index',compact('list'));
    }
    public function add(){
        return view('admin.service.add');
    }
    public function store(ServiceFormRequest $request){
        $model=new Service();
        $model->fill($request->all());


        if($request->hasFile('icon')){
            if ($request->hasFile('icon')) {
                $path = $request->file('icon')->storeAs('public/uploads/services', uniqid() . '-' . $request->icon->getClientOriginalName());
                $model->icon = str_replace('public/', '', $path);
            }
        }
        $model->save();
        return redirect(route('service.list'));
    }
    public function edit($id){
        $model=Service::find($id);
        if(!$model){
            return redirect()->back();
        }
        return view('admin.service.edit',compact('model'));
    }

    public function saveEdit($id,ServiceFormRequest $request){
        $model=Service::find($id);
        $path_image = 'storage/' . $model->icon;
        if (file_exists($path_image) != 'storage/'.$request->image) {
            unlink($path_image);
        }
        if(!$model){
            return redirect()->back();
        }
        $model->fill($request->all());

        if($request->hasFile('icon')){
            if ($request->hasFile('icon')) {
                $path = $request->file('icon')->storeAs('uploads/services', uniqid() . '-' . $request->icon->getClientOriginalName());
                $model->icon = str_replace('public/', '', $path);
            }
        }
        $model->save();
        return redirect(route('service.list'));
    }


    public function remove($id){
        $model=Service::find($id);
        if(!$model){
            return redirect()->back();
        }
        $path_image = 'storage/' . $model->icon;
        if (file_exists($path_image)) {
            unlink($path_image);
        }
        Room_service::where('service_id',$id)->delete();
        $model->delete();
        return redirect()->back();
    }

}
