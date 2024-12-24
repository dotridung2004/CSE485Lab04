<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booksReverse = Book::all();
        $books = $booksReverse->reverse();
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        if(isset($request)){
            Book::create($request->all());

        }
        return redirect()->route('book.index')->with('success', 'Thêm sách thành công');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booksReverse = Book::all();
        $books = $booksReverse->reverse();
        $bookByID = Book::find($id);
        return view('book.edit', compact('bookByID', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);
        $book->update($request->all());
        return redirect()->route('book.index')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Xóa thành công');
    }
}