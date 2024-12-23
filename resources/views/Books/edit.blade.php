@extends('layouts.app')
@php
    $STT=1;
@endphp
@section('content')
    <h1 class="header__title" style="text-align: center">Trang Admin</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Thêm
      </button>
      
      <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm sách</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('book.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-lable">Tên sách</label>
                            <input type="text" class="form-control" name='name'>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Tên tác giả</label>
                            <input type="text" class="form-control" name='author'>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Thể loại</label>
                            <input type="text" class="form-control" name='category'>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Năm sáng tác</label>
                            <input type="text" class="form-control" name='year'>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Số lượng</label>
                            <input type="text" class="form-control" name='quantity'>
                        </div>
                        <button class="btn btn-success" type="submit">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>     --}}
    <table class="table">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Name</th>
            <th scope="col">Author</th>
            <th scope="col">Category</th>
            <th scope="col">Year</th>
            <th scope="col">Quantity</th>
            <th scope="col">Time Update</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($books as $item)
                <tr>
                    <td>{{ $STT }}</td>
                    <td>{{ $item['name']}}</td>
                    <td>{{ $item['author']}}</td>
                    <td>{{ $item['category'] === 0 ? 'Out of Stock' : $item['category'] }}</td>
                    <td>{{ $item['year']}}</td>
                    <td>{{ $item['quantity']}}</td>
                    <td>{{ $item['updated_at']}}</td>
                    <td >
                        <a href="{{ route('book.show', $item->id) }}" class="btn btn-info">Xem</a>
                        <a href="{{ route('book.edit', ['book' => $item->id])}}" class="btn btn-warning">
                            Sửa
                        </a>
                        <button class="btn btn-danger">Xóa</button>
                    </td>
                </tr>
                @php
                    ++$STT;
                @endphp
          @endforeach
          
        </tbody>
    </table>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('book.update', ['book' => $bookByID->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-lable">Tên sách</label>
                            <input type="text" class="form-control" name='name' value="{{ $bookByID['name'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Tên tác giả</label>
                            <input type="text" class="form-control" name='author' value="{{ $bookByID['author'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Thể loại</label>
                            <input type="text" class="form-control" name='category' value="{{ $bookByID['category'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Năm sáng tác</label>
                            <input type="text" class="form-control" name='year' value="{{ $bookByID['year'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Số lượng</label>
                            <input type="text" class="form-control" name='quantity' value="{{ $bookByID['quantity'] }}">
                        </div>
                        <button class="btn btn-success" type="submit">Sửa</button>
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
        const regex = /\/book\/(\d+)\/edit/;
        const match = currentUrl.match(regex);

        if (match) {
            const bookId = match[1];

            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();

            const modalElement = document.getElementById('editModal');
            modalElement.addEventListener('hide.bs.modal', function () {
                window.location.href = '/book'; 
            });
        }
    });
</script>
