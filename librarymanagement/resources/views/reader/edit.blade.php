@extends('layouts.App')
@php
    $STT = 1;
@endphp
@section('content')
    <h1 style="text-align: center">Trang quản lý đọc giả</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Thêm người đọc
      </button>
      
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Mã Sách</th>
            <th scope="col">Tên</th>
            <th scope="col">Ngày sinh</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Hoạt động</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($readers as $item)
                <tr>
                    <td>{{ $STT }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['birthday'] }}</td>
                    <td>{{ $item['address'] }}</td>
                    <td>{{ $item['phone'] }}</td>
                    <td>{{ $item['created_at'] }}</td>
                    <td>
                        <a href="{{ route('reader.edit', ['reader' => $item->id]) }}" class="btn btn-warning">Sửa</a>
                        <a href="" class="btn btn-danger">Xóa</a>
                    </td>
                    @php
                        $STT++;
                    @endphp
                </tr>
            @endforeach
        </tbody>
      </table>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Sửa thông tin người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reader.update', ['reader' => $readerByID->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-lable">Tên</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter the name" value="{{ $readerByID['name'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-lable">Ngày sinh</label>
                            <input type="date" id="birthday" name="birthday" class="form-control" placeholder="Enter the birthday" value="{{ $readerByID['birthday'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-lable">Địa chỉ</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Enter the address" value="{{ $readerByID['address'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-lable">Điện thoại</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter the phone" value="{{ $readerByID['phone'] }}">
                        </div>
                        <button class="btn btn-success">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Kiểm tra URL hiện tại
        const currentUrl = window.location.href;

        // Kiểm tra xem URL có chứa định dạng '/book/{id}/edit' không
        const regex = /\/reader\/(\d+)\/edit/;
        const match = currentUrl.match(regex);

        if (match) {
            const bookId = match[1];

            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();

            const modalElement = document.getElementById('editModal');
            modalElement.addEventListener('hide.bs.modal', function () {
                window.location.href = '/reader'; 
            });
        }
    });
</script>