@extends('layouts.App')
@php
    $STT = 1;
@endphp
@section('content')
    <h1 style="text-align: center">Reader management page</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Reader
      </button>
      
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
                        <a href="" class="btn btn-danger">Delete</a>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reader.update', ['reader' => $readerByID->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-lable">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter the name" value="{{ $readerByID['name'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-lable">Birthday</label>
                            <input type="date" id="birthday" name="birthday" class="form-control" placeholder="Enter the birthday" value="{{ $readerByID['birthday'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-lable">Address</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Enter the address" value="{{ $readerByID['address'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-lable">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter the phone" value="{{ $readerByID['phone'] }}">
                        </div>
                        <button class="btn btn-success">Edit</button>
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