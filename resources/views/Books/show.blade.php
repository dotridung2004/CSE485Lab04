@extends('layouts.app')
<h1 style="padding: 25px 0 25px 0; background: pink; text-align:center; margin-bottom:20px">Trang chi tiết</h1>

@section('content')
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                Tên: {{ $book['name'] }}
            </div>
            <div class="card-body">
                Tác giả: {{ $book['author'] }}
            </div>
            <div class="card-footer">
                Danh mục: {{ $book['category'] }}
            </div>
        </div>
        
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                Năm sáng tác: {{ $book['year'] }}
            </div>
            <div class="card-body">
                Số lượng: {{ $book['quantity'] }}
            </div>
            <div class="card-footer">
                Thời gian cập nhật mới nhất: {{ $book['updated_at'] }}
            </div>
        </div>
    </div>
</div>
    
@endsection