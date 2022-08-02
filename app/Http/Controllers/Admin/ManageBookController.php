<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class ManageBookController extends Controller
{
    /**
     * Return list of Books for Admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(2);
        return view('admin.catalog.books')->with(compact('books'));
    }

    /**
     * Return the view for Admin to view Book Details
     * 
     * @return \Illuminate\Http\Response
     */
    public function bookDetailsView(Request $request){
        if ($request != null){
            $book = Book::find($request->ISBN);
            return view('admin.catalog.bookDetails')->with('book', $book);
        }
        else{
            return view('home');
        }
    }

    /**
     * Return the view for Admin to Add Books
     * 
     * @return \Illuminate\Http\Response
     */
    public function addBooksView(){
        return view('admin.catalog.addBooks');
    }

    /**
     * Adds book to database
     *
     * @return \Illuminate\Http\Response
     */
    public function addBook(Request $request)
    {
        //validate book info before storing to database
        $request->validate([
            'ISBN'=>'required|min:13|max:13|unique:books|regex:/[0-9]/',
            'title'=>'required|max:255',
            'description' => 'required',
            'author' => 'required|max:255|regex:/[a-z]/|regex:/[A-Z]/',
            'publication' => 'required|max:255',
            'publication_date'=>'required|date_format:Y-m-d|before_or_equal:today',
            'price'=>'required|numeric|max:100',
            'language'=>'required',
            'access_level'=>'required|numeric|min:1|max:3',
        ]);
        
        // create new Book to be saved 
        $book = new Book();
        // assign cover_img
        if($request->hasFile('cover_img')) {
            // define image file and set file name to ISBN as prefix
            $image = $request->file('cover_img');
            $imageFileType = strtolower(pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION));
            $image_name = $request->ISBN. '.' .$imageFileType;

            // move image onto server folder for future use 
            $path = public_path().'/images/book_covers';
            $image->move($path, $image_name);
            $book->cover_img = $image_name;
        }
        else {
            $book->cover_img = 'no_book_cover.jpg';
        }
        // assign other data
        $book->ISBN = $request->ISBN;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->publication = $request->publication;
        $book->publication_date = $request->publication_date;
        $book->price = $request->price;
        $book->language = $request->language;
        $book->access_level = $request->access_level;
 
        // save book record
        $res = $book->save();

        if($res){
            return redirect('add_book')->with('success', 'Stock has been updated Succesfully!');
        }
        else{
            return redirect('add_book')->with('fail','Fail to Update Stock');
        }
    }
}
