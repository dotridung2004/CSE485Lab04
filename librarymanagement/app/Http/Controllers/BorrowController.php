<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Reader;
use App\Models\Book;
class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowsReverse = Borrow::all();
        $borrows = $borrowsReverse->reverse();
        $readers = Reader::all();
        $books = Book::all();
        return view('borrows.index',compact('borrows','readers','books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $readers = Reader::all();
        $books = Book::all();
        return view('borrows.index',compact('readers','books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reader_id' => 'required',
            'book_id' => 'required',
            'borrow_date' => 'required',
            'return_date' => 'required|after:borrow_date'
        ]);
        Borrow::create($request->all());
        return redirect()->route('borrows.index') -> with('create','Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        return view('borrows.show',compact('borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrow $borrow)
    {
        $readers = Reader::all();
        $books = Book::all();
        return view('borrows.index',compact('borrow','readers','books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrow $borrow)
    {
        $request -> validate([
            'reader_id' => 'required',
            'book_id' => 'required',
            'borrow_date' => 'required',
            'return_date' => 'required|after:borrow_date',
            'status' => 'required'
        ]);
        $borrow -> update($request -> all());
        return redirect()->route('borrows.index') -> with('update','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        $borrow -> delete();
        return redirect() -> route('borrows.index') -> with ('delete','Xóa thành công');
    }
}
