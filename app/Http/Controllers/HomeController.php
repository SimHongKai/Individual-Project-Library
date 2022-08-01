<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application home screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $popularBooks = Book::all();
        $newBooks = Book::all();
        $recentBooks = Book::all();
        return view('home')->with(compact('popularBooks', 'newBooks', 'recentBooks'));
    }


}
