@extends('layouts.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../resources/css/index.css">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center m-2">Quản Lý Mượn Trả Sách</h3>
                <input type="submit" value="Thêm mới" name="btn-create" class="btn btn-outline-primary m-3" data-bs-toggle="modal" data-bs-target="#btn-add-Modal">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Mã Mượn Trả</th>
                            <th>Mã Người Đọc</th>
                            <th>Mã Sách</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td>{{$borrow -> id}}</td>
                                <td>{{$borrow -> reader_id}}</td>
                                <td>{{$borrow -> book_id}}</td>
                                <td>{{$borrow -> status == 1 ? 'Đã Trả' : 'Chưa Trả' }}</td>
                                <td>
                                    <input type="submit" name="btn-show" id="" class="btn btn-outline-secondary" value="Xem" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#btn-show-Modal-{{ $borrow->id }}">
                                    <input type="submit" name="btn-edit" id="" class="btn btn-outline-warning" value="Sửa" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#btn-edit-Modal-{{ $borrow->id }}">
                                    <input type="submit" name="btn-delete" id="" class="btn btn-outline-danger" value="Xóa" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#btn-delete-Modal-{{ $borrow->id }}">
                                </td>
                                <div class="modal fade" id="btn-delete-Modal-{{ $borrow->id }}" tabindex="-1" aria-labelledby="btn-delete-ModalLabel-{{ $borrow->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{route('borrows.destroy',$borrow -> id)}}" method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="btn-delete-ModalLabel-{{ $borrow->id }}">Xóa mượn trả sách</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 for="" class="text-center">Bạn có chắc chắn muốn xóa bản ghi</h5>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    <input type="submit" class="btn btn-primary" value="Xóa bản ghi" name="btn-delete">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
@endsection

            <!-- Modal-ShowBorrow -->
            @foreach ($borrows as $borrow)
            <div class="modal fade" id="btn-show-Modal-{{ $borrow->id }}" tabindex="-1" aria-labelledby="btn-show-Modal-{{ $borrow->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('borrows.update', $borrow->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="btn-show-Modal-{{ $borrow->id }}">Sửa thông tin mượn trả sách</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="text" class="form-control" placeholder="Mã Ngz" id="reader_id" name="reader_id" value="{{$borrow -> reader_id}}" readonly required>
                                    <label for="reader_id">Mã Người Đọc</label>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="text" class="form-control" placeholder="Mã Sách" id="book_id" name="book_id" value="{{$borrow -> book_id}}" readonly required>
                                    <label for="book_id">Mã Sách</label>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="date" class="form-control" placeholder="Ngày Mượn" id="borrow_date" name="borrow_date" value="{{$borrow -> borrow_date}}" readonly required>
                                    <label for="borrow_date">Ngày Mượn</label>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="date" class="form-control" placeholder="Ngày Trả" id="return_date" name="return_date" value="{{$borrow -> return_date}}" readonly required>
                                    <label for="return_date">Ngày Trả</label>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="text"  class="form-control" value="{{ $borrow->status}}" placeholder="Trạng Thái" id="status" name="status" readonly required></input>
                                    <label for="status">Trạng Thái</label>
                                </div>
                            </div>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach

            <!-- Model-AddBorrow -->
            <div class="modal fade" id="btn-add-Modal" tabindex="-1" aria-labelledby="btn-add-ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{route('borrows.store')}}" method="POST" >
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="btn-add-ModalLabel">Thêm mượn sách</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mx-auto" style="width: 400px;height:60px">
                                    <select class="form-select" id="reader_id" name="reader_id" required>
                                        <option value="">Mã Người Đọc</option>
                                        @foreach($readers as $reader)
                                            <option value="{{$reader -> id}}">{{$reader -> id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="input-group mx-auto" style="width: 400px;height:60px">
                                    <select class="form-select" id="book_id" name="book_id"required>
                                        <option value="">Mã Sách</option>
                                        @foreach($books as $book)
                                            <option value="{{ $book->id }}">{{$book -> id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="date" class="form-control" placeholder="Ngày Mượn" id="add_NgayMuon" name="borrow_date" required>
                                    <label for="add_NgayMuon">Ngày Mượn</label>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="date" class="form-control" placeholder="Ngày Trả" id="add_NgayTra" name="return_date" required>
                                    <label for="add_NgayTra">Ngày Trả</label>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <input type="submit" class="btn btn-primary" value="Thêm mới" name="btn-add">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Thông báo thêm mới -->
            @if(session('create'))
                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Thông báo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                {{ session('create') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var successModal = new bootstrap.Modal(document.getElementById('createModal'));
                        successModal.show();
                    });
                </script>
            @endif

            <!-- Modal-UpdateBorrow -->
            @foreach ($borrows as $borrow)
            <div class="modal fade" id="btn-edit-Modal-{{ $borrow->id }}" tabindex="-1" aria-labelledby="btn-edit-Modal-{{ $borrow->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('borrows.update', $borrow->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="btn-edit-Modal-{{ $borrow->id }}">Sửa thông tin mượn trả sách</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="text" class="form-control" placeholder="Mã Ngz" id="reader_id" name="reader_id" value="{{$borrow -> reader_id}}" required>
                                    <label for="reader_id">Mã Người Đọc</label>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="text" class="form-control" placeholder="Mã Sách" id="book_id" name="book_id" value="{{$borrow -> book_id}}" required>
                                    <label for="book_id">Mã Sách</label>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="date" class="form-control" placeholder="Ngày Mượn" id="borrow_date" name="borrow_date" value="{{$borrow -> borrow_date}}" required>
                                    <label for="borrow_date">Ngày Mượn</label>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="date" class="form-control" placeholder="Ngày Trả" id="return_date" name="return_date" value="{{$borrow -> return_date}}" required>
                                    <label for="return_date">Ngày Trả</label>
                                </div>
                                <br>
                                <div class="input-group mx-auto" style="width: 400px;height:60px">
                                    <select class="form-select" id="status" name="status"required>
                                        <label for="">Trạng Thái</label>
                                        <option value="0" {{ $borrow->status == 0 ? 'selected' : '' }}>Chưa Trả</option>
                                        <option value="1" {{ $borrow->status == 1 ? 'selected' : '' }}>Đã Trả</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <input type="submit" class="btn btn-primary" value="Lưu thay đổi" name="btn-update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach

            <!-- thông báo cập nhật -->
            @if(session('update'))
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Thông báo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                {{ session('update') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var successModal = new bootstrap.Modal(document.getElementById('updateModal'));
                        successModal.show();
                    });
                </script>
            @endif

            <!-- thông báo xóa -->
            @if(session('delete'))
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Thông báo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                {{ session('delete') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var successModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                        successModal.show();
                    });
                </script>
            @endif
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
