@extends("admin.layouts.main")
@section("content")
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function addServices(e) {
        e.preventDefault();
        $("#log").append(`
        <div class="row">
            <div class="col-md-5">
                <select name="service_id[]" class="form-select form-control">
                    @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <input type="text" name="additional_price[]" class="form-control" placeholder="Giá dịch vụ">
            </div>
            <div class="col-md-2">
                <button type="button" class="delete_services detailbtn mb-2 btn btn-danger mr-2">Xóa</button>
            </div>
        </div>`);
    }

    function deleteServices(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    }
    $(function() {
        $(document).on("click", '.add_services', addServices);
        $(document).on('click', '.delete_services', deleteServices);
    })
</script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
<h2>them phòng moi</h2>
<form action="" class="add-new-post" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Tên phòng</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">name</span>
                </div>
                <input type="text" name="room_no" class="form-control" value="{{old('name')}}">
            </div>
            @error('room_no')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="iputName" class="text-muted d-block mb-2">Tên dịch vụ</label>
            <div id="log">
                <!-- <div class="row">
                            <div class="col-md-5">
                                <select class="form-select form-control">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" placeholder="Nhập tên phòng">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="mb-2 btn btn-danger mr-2">Primary</button>
                            </div>
                        </div>  -->
            </div>
            <a href="" class="mb-2 btn btn-primary mr-2 add_services">Thêm dịch vụ</a>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="price" class="text-muted d-block mb-2">Giá phòng</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" value="{{old('price')}}" name="price" id="price" class="form-control" placeholder="Nhập gia">

            </div>
            @error('price')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="floor" class="text-muted d-block mb-2">Số tầng</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">#</span>
                </div>
                <input min="1" max="30" value="{{old('floor')}}" type="number" name="floor" id="floor" class="form-control" placeholder="Số tầng">

            </div>
            @error('floor')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="image" class="text-muted d-block mb-2">Ảnh phòng</label>
            <div class="input-group mb-3">
                <input type="file" name="image" id="image">

            </div>
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <label class="text-muted d-block mb-2" for="">Chọn tệp ảnh phòng</label>
        <table class="table table-stripped">
            <thead>
                <th>File</th>
                <th>Thumbnail</th>
                <th><button class="btn btn-success add_img" type="button">Thêm ảnh</button></th>
            </thead>
            <tbody id="gallery">

            </tbody>

        </table>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputState" class="text-muted d-block mb-2">Mô tả phòng</label>
            <textarea class="form-control my-editor" id="mytextarea" name="detail" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="mb-2 btn btn-success mr-2">Thêm</button>
        <a href="" class="mb-2 btn btn-danger mr-2">Hủy</a>
    </div>
</form>
@endsection
@section('pagejs')
<script>
    $(document).ready(function() {
        $('.add_img').click(function() {

            var rowId = Date.now()
            $('#gallery').append(`
                <tr id="${rowId}">
                    <td>
                        <div class="form-group">
                            <input row_id="${rowId}" type="file" name="galleries[]" onchange="loadFile(event, ${rowId})">
                        </div>
                    </td>
                    <td>
                        <img row_id="${rowId}" src="" width="80" alt="" >
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="removeImg(this)">Xóa</button>
                    </td>
                </tr>

            `)
        })
    })

    function loadFile(event, el_rowId) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.querySelector(`img[row_id="${el_rowId}"]`);
            output.src = reader.result;
        };
        if (event.target.files[0] == undefined) {
            output.src = ""
            return false
        } else {
            reader.readAsDataURL(event.target.files[0]);
        }

    };

    function removeImg(e) {
        $(e).parent().parent().remove()
    }
</script>
@endsection
