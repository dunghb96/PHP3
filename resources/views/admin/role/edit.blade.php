@extends('admin.layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Sửa Roles</h2>
    </div>
    <div class="main-content-container container-fluid px-4">
        <form action="" class="add-new-post" method="POST">
            @csrf
                <div class="form-group col-md-6">
                    <label for="iputName" class="text-muted d-block mb-2">Tên role</label>
                    <div class="input-group mb-3">
                        <input type="text" name="name" id="iputName" class="form-control" value="{{ $role->name }}" >
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <label> Chọn quyền </label>
                <div class="row">
                    @foreach ($permissions as  $p)
                        <div class="col-3">
                            <input type="checkbox"
                            @foreach ($role->permissions as $per)
                                @if ($per->id==$p->id)
                                    checked
                                @endif
                            @endforeach
                            name="permissions[]" value="{{ $p->id }}">  <span>{{ $p->name }}</span>
                        </div>
                    @endforeach
                </div>
                <br><br>
                &nbsp;&nbsp;
                <button type="submit" class="mb-2 btn btn-success mr-2">Sửa</button>
                <a href="{{ route('role.list') }}" class="mb-2 btn btn-danger mr-2">Hủy</a>
        </form>
    </div>
</div>

@endsection
