@extends("admin.layouts.main")
@section("content")

<h2>Đổi mật khẩu</h2>
<form action="" class="add-new-post" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Password cũ</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Pass</span>
                </div>
                <input type="password" name="password_old" value="{{old('password')}}" class="form-control" placeholder="Nhập password cũ">
            </div>
            @if(session('msg')!= null)
                <span class="text-danger">{{session('msg')}}</span>
            @endif
            @error('password_old')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    </div>

    {{-- update lần 2 --}}
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Password mới</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">***</span>
                </div>
                <input type="password" name="password"  class="form-control" placeholder="New password">
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Confirm password mới</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">***</span>
                </div>
                <input type="password" name="password_confirmation"  class="form-control" placeholder=" Confirm new password">
            </div>
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <button type="submit" class="mb-2 btn btn-success mr-2">Thêm</button>
    <a href="{{route('user.list')}}" class="mb-2 btn btn-danger mr-2">Hủy</a>
</form>
@endsection
