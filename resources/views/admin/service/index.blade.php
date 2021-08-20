@extends("admin.layouts.main")
@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"> Danh sách dịch vụ</h2>
            <div class="card-tools">
                @can('add services')
                    <a class="btn btn-success" href="{{ route('room.add') }}"><i
                    class="fas fa-plus-circle"></i> Thêm</a>
                @endcan
            </div>
        </div>
        <table class="table" style="margin-left: 20px;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">icon</th>
                    <th scope="col"> Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $c)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $c->name }}</td>
                        <td><img src="{{ asset('storage/' . $c->icon) }}" width="70" alt=""></td>
                        <td>
                            @can('edit services')
                            <a class="btn btn-primary" href="{{ route('service.edit', ['id' => $c->id]) }}">Sửa</a>
                            @endcan
                            - @can('remove services')
                                <a onclick="return confirm('có chắc muốn xóa không?')"
                            class="btn btn-danger" href="{{ route('service.remove', ['id' => $c->id]) }}">Xóa</a>
                            @endcan </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $list->links() }}
@endsection
