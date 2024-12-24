@extends('layouts.app')
@php
    $STT=1;
@endphp
@section('content')
    <h1 class="header__title" style="text-align: center">Trang quản lý sách</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Thêm Sách
      </button>
      
      <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm sách</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('book.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="" class="form-lable">Tên sách</label>
                            <input type="text" class="form-control" name='name' placeholder='Nhập tên sách'>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Tên tác giả</label>
                            <input type="text" class="form-control" name='author' placeholder='Nhập tên tác giả'>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Thể loại</label>
                            <input type="text" class="form-control" name='category'placeholder='Nhập thể loại sách'>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Năm sáng tác</label>
                            <input type="text" class="form-control" name='year' placeholder='Nhập năm sáng tác' >
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-lable">Số lượng</label>
                            <input type="text" class="form-control" name='quantity' placeholder='Nhập số lượng'>
                        </div>
                        <button class="btn btn-success" type="submit">Thêm sách</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Mã Sách</th>
            <th scope="col">Tên Sách</th>
            <th scope="col">Tác Giả</th>
            <th scope="col">Thể Loại</th>
            <th scope="col">Năm sáng tác</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Thời gian cập nhật</th>
            <th scope="col">Hoạt động</th>
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
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModel-{{ $item->id }}">
                            Xóa
                        </button>
                        
                        <div class="modal fade" id="deleteModel-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModelLabel">Bạn muốn xóa bản tin này?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color: red;">Nếu bạn xóa bản ghi này sẽ không thể khôi phục</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <form action="{{ route('book.destroy', ['book' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Xác nhận</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </td>
                </tr>
                @php
                    ++$STT;
                @endphp
          @endforeach
          
        </tbody>
    </table>
    
@endsection
{{-- {{ dd($books) }} --}}
@if(session('success'))
<div class="toast align-items-center show" id="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 10px; right: 10px; z-index: 1050;">
    <div class="d-flex">
        <div class="toast-body">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
@endif
<script>
    // Hiển thị toast nếu có
    window.onload = function() {
        var toast = document.getElementById('toast');
        if (toast) {
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3000); // 3 giây để ẩn toast
        }
    }
</script>