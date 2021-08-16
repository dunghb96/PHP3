@extends('admin.layouts.main')
@section('content')
<br>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"> Danh sách người dùng</h2>
            <div class="card-tools">
                @hasanyrole('admin|editor')<a class="btn btn-success" href="{{ route('user.add') }}"><i
                    class="fas fa-plus-circle"></i> Thêm</a> @else @endhasanyrole
            </div>
        </div>
        <table class="table table-striped">
            <thead class="">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">tên User</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $p)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>
                            @isset($p->roles)
                                @foreach ($p->roles as $r)
                                    <span class="badge badge-secondary"> {{ $r->name }} </span><br>
                                @endforeach
                            @endisset
                        </td>
                        <td>
                            @if (Auth::user() != null && Auth::user()->id == $p->id) <a
                                    class="btn btn-info" href="{{ route('user.edit-pass', ['id' => $p->id]) }}">Đổi mật
                                khẩu</a> @else @endif
                            @hasrole('admin')<a class="btn btn-primary"
                                href="{{ route('user.edit', ['id' => $p->id]) }}">Sửa</a>@endhasrole
                            @hasanyrole('admin|moderato') <a class="btn btn-danger" href="{{ route('user.remove',['id'=>$p->id]) }}">Xóa</a> @endhasanyrole

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
    <br>
@endsection
