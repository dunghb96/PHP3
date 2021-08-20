@extends("admin.layouts.main")
@section('content')

    <br>
    <fieldset>
        <form>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <div class="col">
                        <label for="inputEmail4">Room No</label>
                        <input class="form-control" @isset($searchData['keyword']) value="{{ $searchData['keyword'] }}"
                            @endisset type="text" name="keyword">
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Services</label>
                        <select class="form-control" name="service_id">
                            <option value="">Để trống</option>
                            @foreach ($services as $c)
                                <option
                                @if(isset($searchData['service_id']) && $c->id == $searchData['service_id']) selected @endif
                                value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="col">
                        <label for="inputPassword4">Lọc theo</label>
                        <select class="form-control" name="order_by">
                            <option value="">Mặc định</option>
                            <option @if (isset($searchData['order_by']) && $searchData['order_by'] == 1) selected @endif value="1">Tên alphabet</option>
                            <option @if (isset($searchData['order_by']) && $searchData['order_by'] == 2) selected @endif value="2">Tên giảm dần alphabet</option>
                            <option @if (isset($searchData['order_by']) && $searchData['order_by'] == 3) selected @endif value="3">Giá tăng dần</option>
                            <option @if (isset($searchData['order_by']) && $searchData['order_by'] == 4) selected @endif value="4">Giá giảm dần</option>
                        </select><br>
                    </div>
                    <div class="col">
                        <button class="btn btn-info float-right" type="submit">Submit</button>
                    </div>
                </div>
                <div class="form-group col-md-4">

                </div>
            </div>
        </form>
    </fieldset>
    <div class="card">
    <div class="card-header">
        <h2 class="card-title"> Danh sách phòng</h2>
        <div class="card-tools">
            @can('add rooms')<a class="btn btn-success" href="{{ route('room.add') }}"><i class="fas fa-plus-circle"></i> Thêm</a> @endcan
        </div>
    </div>
    <table class="table" style="margin-left: 20px;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">room NO</th>
                <th scope="col">floor</th>
                <th scope="col">image</th>
                <th scope="col">Room price</th>
                <th scope="col">services</th>
                <th scope="col">Total price</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $c)
                <tr>
                    <th scope="row">{{ ($rooms->currentPage() - 1) * $pageSize + $loop->iteration }}</th>
                    {{-- công thức tính để khi chuyển trang không bị reset lại stt bản ghi --}}
                    <td>{{ $c->room_no }}</td>
                    <td>{{ $c->floor }}</td>
                    <td><img src="{{ asset('storage/' . $c->image) }}" width="70" alt=""></td>
                    <td>{{ $c->price }} $</td>
                    <td>
                        @isset($c->services)
                            @foreach ($c->services as $servies)
                                <span class="badge badge-secondary"> {{$servies->name}} </span><br>
                            @endforeach
                        @endisset
                    </td>
                    <td>
                        <?php
                        $dem = 0;
                        foreach ($c->room_services as $v) {
                        $dem += $v->additional_price;
                        }
                        echo $dem + $c->price . ' ' . '$';
                        ?>
                    </td>
                    <td>
                        @can('edit rooms')<a class="btn btn-primary"
                        href="{{ route('room.edit', ['id' => $c->id]) }}">Sửa</a>@endcan
                        - @can('remove rooms')<a onclick="return confirm('có chắc muốn xóa không?')"
                        class="btn btn-danger" href="{{ route('room.remove', ['id' => $c->id]) }}">Xóa</a>@endcan </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    {{ $rooms->links() }}
@endsection
