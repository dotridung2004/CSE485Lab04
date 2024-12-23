<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booksReverse = Books::all();
        $books = $booksReverse->reverse();
        return view('Books.index', compact('books'));
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
            Books::create($request->all());

        }
        return redirect()->route('book.index')->with('success', 'Thêm sách thành công');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Books::find($id);
        return view('Books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booksReverse = Books::all();
        $books = $booksReverse->reverse();
        $bookByID = Books::find($id);
        return view('Books.edit', compact('bookByID', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Books::find($id);
        $book->update($request->all());
        return redirect()->route('book.index')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Xóa thành công');
    }
}
