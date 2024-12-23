@extends('layouts.App')
@php
    $STT = 1;
@endphp
@section('content')
    <h1 style="text-align: center; margin-bottom: 25px;">Reader management page</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Reader
      </button>
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add reader</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reader.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="name" class="form-lable">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter the name">
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-lable">Birthday</label>
                            <input type="date" id="birthday" name="birthday" class="form-control" placeholder="Enter the birthday">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-lable">Address</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Enter the address">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-lable">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter the phone">
                        </div>
                        <button class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">Birthday</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Create At</th>
            <th scope="col">Action</th>
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
                        <a href="{{ route('reader.edit', ['reader' => $item->id]) }}" class="btn btn-warning">Edit</a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModel-{{ $item->id }}">
                            Xóa
                        </button>
                        
                        <div class="modal fade" id="deleteModel-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModelLabel">Do you want to delete this reader?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color: red;">Once you delete the reader, it cannot be recovered.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <form action="{{ route('reader.destroy', ['reader' => $item->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </td>
                    @php
                        $STT++;
                    @endphp
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection

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