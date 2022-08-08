<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowHistory;
use DB;

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
        $popularBooks = $this->getPopularBooks();
        $newBooks = Book::orderBy('created_at')->limit(3)->get();
        $recentBooks = $this->getRecentBooks();
        return view('home')->with(compact('popularBooks', 'newBooks', 'recentBooks'));
    }

    /**
     * Get Top 3 Borrowed Books
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPopularBooks()
    {
        // get ISBN of Top 3 Borrowed
        $popularBooks = DB::table('borrowHistory')
                        ->select('ISBN', DB::raw('count(*) as total'))
                        ->groupBy('ISBN')
                        ->orderBy('total')
                        ->limit(3)
                        ->pluck('ISBN')->toArray();
        
        $popularBooks = Book::findMany($popularBooks);
        return $popularBooks;
    }

    /**
     * Get 3 Recently Borrowed Books
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getRecentBooks()
    {
        // get ISBN of Top 3 Borrowed
        $recentBooks = DB::table('borrowHistory')
                        ->select('ISBN')
                        ->orderBy('borrowed_at')
                        ->limit(3)
                        ->pluck('ISBN')->toArray();
        
        $recentBooks = Book::findMany($recentBooks);
        return $recentBooks;
    }


}
