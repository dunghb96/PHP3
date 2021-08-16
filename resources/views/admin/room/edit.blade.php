@extends("admin.layouts.main")
@section("content")
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('admin/custom/style.css')}}">
<script>
    function addServices(e) {
        e.preventDefault();
        $("#log").append('<div class="row"> <div class="col-md-5"><select name="service_id[]" class="form-select form-control">  @foreach ($services as $service)<option value="{{ $service->id }}">{{ $service->name }}</option> @endforeach </select>   </div> <div class="col-md-5"> <input type="text" name="additional_price[]" class="form-control" placeholder="Giá dịch vụ"> </div><div class="col-md-2"> <button type="button"    class="delete_services detailbtn mb-2 btn btn-danger mr-2">Xóa</button> </div></div>');
    }

    function deleteServices(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    }
    $(function() {
        $(document).on("click", '.add_services', addServices);
        $(document).on('click', '.delete_services', deleteServices);
    })
</script>

<h2>sua phòng</h2>
<form action="" class="add-new-post" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Tên phòng</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">name</span>
                </div>
                <input type="text" value="{{ $room->room_no }}" name="room_no" class="form-control" placeholder="Nhập tên phòng">
                @error('room_no')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Tên dịch vụ</label>
            <div id="log">
                @foreach ($room_service as $roomsItem)
                <div class="row">
                    <div class="col-md-5">
                        <select name="service_id[]" class="form-select form-control">
                            @foreach ($services as $service)
                            <option @if ($roomsItem->service_id == $service->id) selected @endif value="{{ $service->id }}">
                                {{ $service->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="text" value="{{ $roomsItem->additional_price }}" name="additional_price[]" class="form-control" placeholder="Giá dịch vụ">
                    </div>
                    <div class="col-md-2"> <button type="button" class="delete_services detailbtn mb-2 btn btn-danger mr-2">Xóa</button> </div>
                </div>
                @endforeach
            </div>
            <a href="" class="mb-2 btn btn-primary mr-2 add_services">Thêm dịch vụ</a>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="price" class="text-muted d-block mb-2">Giá phòng</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" name="price" value="{{ $room->price }}" id="price" class="form-control" placeholder="Nhập gia">
                @error('price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group col-md-6">
            <label for="floor" class="text-muted d-block mb-2">Số tầng</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">#</span>
                </div>
                <input min="1" value="{{ $room->floor }}" max="30" type="number" name="floor" id="floor" class="form-control" placeholder="Số tầng">
                @error('floor')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="add-product-preview-img">
            <img class="image" src="{{asset( 'storage/' . $room->image)}}" alt="">
        </div>
        <div class="form-group col-md-6">
            <label for="image" class="text-muted d-block mb-2">Ảnh phòng</label>
            <div class="input-group mb-3">
                <input type="file" name="image" id="image">
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputState" class="text-muted d-block mb-2">Mô tả phòng</label>
            <textarea class="form-control tinymce_editor_init" name="detail" cols="30" rows="10">{{ $room->detail }}</textarea>
        </div>
    </div>
    <button type="submit" class="mb-2 btn btn-success mr-2">Sửa</button>
    <a href="{{ route('room.list') }}" class="mb-2 btn btn-danger mr-2">Hủy</a>
</form>
@endsection