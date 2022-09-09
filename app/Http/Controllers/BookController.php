<?php

namespace App\Http\Controllers;

use App\Http\Traits\AwardPointsTrait;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Configuration;
use App\Models\Book;
use App\Models\Booking;
use App\Models\Bookmark;
use App\Models\Material;
use Auth;
use DB;

class BookController extends Controller
{
    use AwardPointsTrait;

    /**
     * Return list of Books for Users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('catalog')->with(compact('books'));
    }

    /**
     * Return the view for users to view Book Details
     * 
     * @return \Illuminate\Http\Response
     */
    public function bookDetailsView(Request $request){
        if ($request->ISBN != null){
            $book = Book::find($request->ISBN);
            // check bookmark
            $book->bookmarked = Bookmark::where('user_id', Auth::id())->where('ISBN', $request->ISBN)
                                ->count();
            $materials = Material::where('ISBN', $request->ISBN)->get();

            // check Booking
            $booking = Booking::where('ISBN', $book->ISBN)
                        ->whereIn('status', [1, 2])
                        ->where('user_id', Auth::id())
                        ->first();
            // get number of people in queue
            $bookingQueue = Booking::where('ISBN', $book->ISBN)
                            ->where('status', 2)
                            ->count();

            // run recommendation with FPGrowth
            $recsISBN = app('App\Http\Controllers\RecommendationController')->getRecommendationsISBN($request->ISBN);
            $recs = Book::whereIn('ISBN', $recsISBN)->get();

            // reward authenticated user with points
            if (Auth::id()){
                $this->giveUserPoints(Auth::id(), 10);
            }

            return view('bookDetails')->with(compact('book', 'materials', 'recs', 'booking', 'bookingQueue'));
        }
        else{
            return view('home');
        }
    }

    /**
     * Return View for Searching Catalog
     * 
     * @return \Illuminate\Http\Response
     */
    public function searchCatalogView()
    {
        return view('catalogSearch');
    }

    /**
     * Filters Catalog
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCatalog(Request $request)
    {
        //validate book info before storing to database
        $request->validate([
            'ISBN'=>'nullable|regex:/[0-9]/',
            'title'=>'nullable|max:255',
            'author' => 'nullable|max:255|regex:/[a-z]/|regex:/[A-Z]/',
            'language'=>'nullable',
            'available' => 'nullable',
            'access_level'=>'nullable|numeric|min:1|max:3',
            'publication' => 'nullable|max:255',
            'publication_date_from'=>'nullable|date_format:Y-m-d',
            'publication_date_to'=>'nullable|date_format:Y-m-d',
        ]);
        
        $query = DB::table('books');

        if ($request->filled('ISBN')){
            $query = $query->where('ISBN', 'LIKE', '%' . $request->ISBN . '%');
        }

        if ($request->filled('title')){
            $query = $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        if ($request->filled('author')){
            $query = $query->where('author', 'LIKE', '%' . $request->author . '%');
        }

        if ($request->filled('language')){
            $query = $query->where('language', 'LIKE', '%' . $request->language . '%');
        }

        if ($request->filled('available')){
            $query = $query->where('available_qty', '>', '0');
        }

        if ($request->filled('access_level')){
            $query = $query->where('access_level', $request->access_level);
        }

        if ($request->filled('publication')){
            $query = $query->where('publication', 'LIKE', '%' . $request->publication . '%');
        }

        if ($request->filled('publication_date_from')){
            $query = $query->where('publication_date', '>=', $request->publication_date_from);
        }

        if ($request->filled('publication_date_to')){
            $query = $query->where('publication_date', '<=', $request->publication_date_to);
        }


        $books = $query->paginate(10);

        return view('catalog')->with(compact('books'));
    }
}
