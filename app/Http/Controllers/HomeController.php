<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowHistory;
use DB;
use Auth;


class HomeController extends Controller
{
    /**
     * Show the application home screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $popularBooks = $this->getPopularBooks();
        $newBooks = Book::orderBy('created_at', 'desc')->limit(3)->get();
        $recentBooks = $this->getRecentBooks();

        $similarRecs = [];
        if (Auth::check()){
            $similarRecsISBN = app('App\Http\Controllers\RecommendationController')->getSimilarISBNs(Auth::id());
            $similarRecs = Book::findMany($similarRecsISBN);
        }

        $this->sendDueReminderEmails();

        return view('home')->with(compact('popularBooks', 'newBooks', 'recentBooks', 'similarRecs'));
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
                        ->distinct() // distinct to prevent 3 same
                        ->orderBy('borrowed_at', 'desc')
                        ->limit(3)
                        ->pluck('ISBN')->toArray();
        
        $recentBooks = Book::findMany($recentBooks);
        return $recentBooks;
    }


}
