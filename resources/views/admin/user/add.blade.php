@extends("admin.layouts.main")
@section("content")

<h2>Thêm người dùng</h2>
<form action="" class="add-new-post" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Tên người dùng</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">name</span>
                </div>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Nhập tên người dùng">
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Email</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Nhập email">

            </div>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Password</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Pass</span>
                </div>
                <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Nhập password">
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Confirm Password</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">***</span>
                </div>
                <input type="password" name="password_confirmation"  class="form-control" placeholder="Confirm password">
            </div>
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Roles</label>
            <div class="input-group mb-3">
                <select class="form-control js-example-basic-multiple" name="role[]" multiple="multiple" >
                    <option value=""> Để trống</option>
                    @foreach ($roles as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="mb-2 btn btn-success mr-2">Thêm</button>
    <a href="{{route('user.list')}}" class="mb-2 btn btn-danger mr-2">Hủy</a>
</form>
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endsection
