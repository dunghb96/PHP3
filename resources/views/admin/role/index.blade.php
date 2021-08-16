@extends("admin.layouts.main")
@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"> Danh sách roles</h2>
            <div class="card-tools">
                @hasanyrole('admin|editor')<a class="btn btn-success" href="{{ route('role.add') }}"><i class="fas fa-plus-circle"></i> Thêm Role</a> @else @endhasanyrole
            </div>
        </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                {{-- <th scope="col">Permissions</th> --}}
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($model as $v)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $v->name }}</td>
                    {{-- <td>
                        @isset($v->permissions)
                            @foreach ($v->permissions as $p)
                            <span class="badge badge-secondary"> {{ $p->name }} </span><br>

                            @endforeach
                        @endisset
                    </td> --}}
                    <td><a class="btn btn-info" href="{{ route('role.edit',['id'=>$v->id]) }}">Sửa</a> - <a class="btn btn-danger" href="{{ route('role.remove',['id'=>$v->id]) }}">Xóa</a></td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{ $model->links() }}
    </div>


@endsection
