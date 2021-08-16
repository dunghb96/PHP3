@extends("admin.layouts.main")
@section("content")
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('admin/custom/style.css')}}"> -->

<h2>them dich vu</h2>
<form action="" class="add-new-post" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Tên dịch vụ</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">name</span>
                </div>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Nhập tên dịch vụ">
                
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            
            <label for="image" class="text-muted d-block mb-2">chọn icon</label>
            <div class="input-group mb-3">
                <input type="file" name="icon" id="image">
                
            </div>
            @error('icon')
                <span class="text-danger">{{ $message }}</span>
                @enderror
        </div>
    </div>
    <button type="submit" class="mb-2 btn btn-success mr-2">Thêm</button>
    <a href="{{route('service.list')}}" class="mb-2 btn btn-danger mr-2">Hủy</a>
</form>


@endsection
