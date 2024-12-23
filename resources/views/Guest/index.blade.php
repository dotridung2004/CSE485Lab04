@extends('layouts.app')
@php
    $STT = 0;  
@endphp
{{-- {{ dd($books) }} --}}
@section('content')
    <h1>Trang chủ</h1>
    
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
                        <button class="btn btn-success">Borrow</button>
                    </td>
                </tr>
                @php
                    ++$STT;
                @endphp
          @endforeach
          
        </tbody>

      </table>
@endsection