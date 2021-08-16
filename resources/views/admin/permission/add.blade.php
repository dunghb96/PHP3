@extends("admin.layouts.main")
@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"> Thêm quyền</h2>
            <div class="card-tools">
            </div>
        </div><br>

        <form action="" class="add-new-post" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Tên Permission</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="Permissons name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <br><button class="btn btn-success" type="submit">Thêm</button>
                </div>
            </div>
        </form>
    </div>


@endsection
