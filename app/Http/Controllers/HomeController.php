<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class HomeController extends Controller
{
    public function index() {
        $books = Books::all();
        return view('Guest.index', compact('books'));
    }
}
