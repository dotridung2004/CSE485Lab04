<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows = borrow::all();
        return view('borrows.index',compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('borrows.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'borrow_date' => 'required',
            'return_date' => 'required'
        ]);
        borrow::create($request->all());
        return redirect()->route('borrows.index') -> with('success','Borrow created successfully');
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
        return view('borrows.edit',compact('borrow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrow $borrow)
    {
        $request -> validate([
            'borrow_date' => 'required',
            'return_date' => 'required'
        ]);
        $borrow -> update($request -> all());
        return redirect()->route('borrows.index') -> with('success','Borrow updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        $borrow -> delete();
        return redirect() -> route('borrows.index') -> with ('success','Borrow deleted successfully');
    }
}
