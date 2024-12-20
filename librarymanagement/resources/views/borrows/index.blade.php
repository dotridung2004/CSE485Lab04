<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center m-3">Bảng Mượn Trả Sách</h3>
                <input type="submit" Value="Thêm mới" name="btn-create" class="btn btn-outline-primary m-3" data-bs-toggle="modal" data-bs-target="#btn-add-Modal">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Mã Mượn Trả</th>
                            <th>Mã Người đọc</th>
                            <th>Mã Sách</th>
                            <th>Ngày Mượn</th>
                            <th>Ngày Trả</th>
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
                                <td>{{$borrow -> borrow_date}}</td>
                                <td>{{$borrow -> return_date}}</td>
                                <td>{{$borrow ? '0' : '1' }}</td>
                                <td>
                                    <input type="submit" name="btn-edit" id="" class="btn btn-outline-warning" Value="Sửa">
                                    <input type="submit" name="btn-delete" id="" class="btn btn-outline-danger" Value="Xóa">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Model-AddBorrow -->
            <div class="modal fade" id="btn-add-Modal" tabindex="-1" aria-labelledby="btn-add-ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="btn-add-ModalLabel">Thêm mượn sách</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mx-auto" style="width: 400px;">
                                    <label>Mã người đọc</label>
                                    <select class="form-select" id="inputGroupSelect01">
                                        @foreach($borrows as $borrow)
                                            <option>{{$borrow -> reader_id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="text" name = "book_id" class="form-control" placeholder="Mã Sách" id="add_MaSach" required><br>
                                    <label for="add_MaSach">Mã Sách</label>
                                </div>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="text" class="form-control" placeholder="Ngày Mượn" id="add_NgayMuon" name="borrow_date" required>
                                    <label for="add_NgayMuon">Ngày Mượn</label>
                                </div>
                                <br>
                                <div class="form-floating mx-auto" style="width: 400px;">
                                    <input type="text" class="form-control" placeholder="Ngày Trả" id="add_NgayTra" name="return_date" required>
                                    <label for="add_NgayTra">Ngày Trả</label>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <input type="submit" class="btn btn-primary" value="Lưu thay đổi" name="btn-add">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
