<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reader;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $readersReverse = Reader::all();
        $readers = $readersReverse->reverse();
        return view('Reader.index', compact('readers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(isset($request)){
            Reader::create($request->all());
        }
        return redirect()->route('reader.index')->with('success', 'Add successful');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $readersReverse = Reader::all();
        $readers = $readersReverse->reverse();
        $readerByID = Reader::find($id);
        return view('Reader.edit', compact('readers', 'readerByID'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reader = Reader::find($id);
        $reader->update($request->all());
        return redirect()->route('reader.index')->with('success', 'Edit successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reader = Reader::find($id);
        $reader->delete();
        return redirect()->route('reader.index')->with('success', 'Deleted successful');
    }
}
