@extends('admin.layouts.main')

{{-- @section('js')
    <script src="{{ asset('admins/products/add.js') }}"></script>
@endsection --}}


@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Thêm Roles</h2>
    </div>
    <div class="main-content-container container-fluid px-4">
        <form action="" class="add-new-post" method="POST">
            @csrf
                <div class="form-group col-md-6">
                    <label for="iputName" class="text-muted d-block mb-2">Tên role</label>
                    <div class="input-group mb-3">
                        <input type="text" name="name" id="iputName" value="{{ old('name') }}" class="form-control" placeholder="Nhập tên role" >
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <label> Chọn quyền </label>
                <div class="row">
                    @foreach ($permissions as  $p)
                        <div class="col-3">
                            <input type="checkbox" name="permissions[]" value="{{ $p->id }}">  <span>{{ $p->name }}</span>
                        </div>
                    @endforeach
                </div>
                <br><br>
                &nbsp;&nbsp;
                <button type="submit" class="mb-2 btn btn-success mr-2">Thêm</button>
                <a href="{{ route('role.list') }}" class="mb-2 btn btn-danger mr-2">Hủy</a>
        </form>
    </div>
</div>

@endsection
