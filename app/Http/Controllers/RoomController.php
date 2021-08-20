<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomFromRequest;
use App\Models\Room;
use App\Models\Room_service;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $services=Service::all();
        $pageSize=5;
        $searchData=$request->except('page');
        // searchData = dữ liệu từ form gửi lên mà bỏ qua page để khi chuyển trang cùng dk thì giữ nguyên giữ liệu với các điều kiện đã cho
        if(count($request->all()) == 0 ){
            $rooms = Room::paginate($pageSize);
        }else{
            $roomQuery=Room::where('room_no','like','%'.$request->keyword.'%');

            if($request->has('service_id')&& $request->service_id != ''){
                $roomQuery= $roomQuery->join('room_services', 'rooms.id', '=', 'room_services.room_id')
                                      ->where('service_id','=',$request->service_id);
            }
            if($request->has('order_by')&& $request->order_by>0){
                if($request->order_by == 1){
                    $roomQuery = $roomQuery->orderBy('room_no');
                }else if($request->order_by == 2){
                    $roomQuery = $roomQuery->orderByDesc('room_no');
                }else if($request->order_by == 3){
                    $roomQuery = $roomQuery->orderBy('price');
                }else{
                    $roomQuery = $roomQuery->orderByDesc('price');
                }
            }
            $rooms = $roomQuery->paginate($pageSize)->appends($searchData);
        }
        $rooms->load('services','room_services');
        return view('admin.room.index', compact('rooms','pageSize','services','searchData'));
    }
    public function add()
    {
        $services = Service::all();
        return view('admin.room.add', compact('services'));
    }
    public function addNew(RoomFromRequest $request)
    {
        $model = new Room();
        $model->fill($request->all());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('public/uploads/rooms', uniqid() . '-' . $request->image->getClientOriginalName());
            $model->image = str_replace('public/', '', $path);
        }
        $model->save();
        if ($request->service_id) {
            $request->service_id=array_unique($request->service_id);
            foreach ($request->service_id as $key => $value) {
                $dataCreated = [
                    'room_id' => $model->id,
                    'service_id' => $value,
                    'additional_price' => $request->additional_price[$key],
                ];
                Room_service::create($dataCreated);
            }
            // dd($dataCreated);
        }
        return redirect()->route('room.list')->with('success','Tạo mới thành công');
    }
    public function edit($id)
    {
        $services = Service::all();
        $room = Room::find($id);
        $room_service = Room_service::where('room_id', $id)->get();
        return view('admin.room.edit', compact('room', 'services', 'room_service'));
    }
    public function saveEdit($id, RoomFromRequest $request)
    {
        $model = Room::find($id);
        $path_image = 'storage/' . $model->image;
        if (file_exists($path_image) != 'storage/'.$request->image) {
            unlink($path_image);
        }
        $model->fill($request->all());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('public/uploads/rooms', uniqid() . '-' . $request->image->getClientOriginalName());
            $model->image = str_replace('public/', '', $path);
        }
        $model->save();
        if ($request->service_id) {
            Room_service::where('room_id', $id)->delete();
            $request->service_id=array_unique($request->service_id);
            foreach ($request->service_id as $key => $value) {
                $dataUpdateServiceRoom = [
                    'room_id' => $id,
                    'service_id' => $value,
                    'additional_price' => $request->additional_price[$key],
                ];
                Room_service::create($dataUpdateServiceRoom);
            }
        }
        return redirect()->route('room.list');
    }
    public function remove($id)
    {
        $model = Room::find($id);
        if (!$model) {
            return redirect()->back();
        }
        $path_image = 'storage/' . $model->image;
        if (file_exists($path_image)) {
            unlink($path_image);
        }
        Room_service::where('room_id', $id)->delete();
        $model->delete();
        return redirect()->back();
    }
}
