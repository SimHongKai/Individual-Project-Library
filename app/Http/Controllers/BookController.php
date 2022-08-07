<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookmark;
use App\Models\Material;
use Auth;

class BookController extends Controller
{
    /**
     * Return list of Books for Users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(2);
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
            return view('bookDetails')->with(compact('book', 'materials'));
        }
        else{
            return view('home');
        }
    }

        
        
    
}
