<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Material;
use DB;

class ManageBookController extends Controller
{
    /**
     * Return list of Books for Admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.catalog.books')->with(compact('books'));
    }

    /**
     * Return the view for Admin to view Book Details
     * 
     * @return \Illuminate\Http\Response
     */
    public function manageBookDetailsView(Request $request){
        
        $book = Book::find($request->ISBN);
        if ($book){
            $materials = Material::where('ISBN', $request->ISBN)->get();
            return view('admin.catalog.manageBookDetails')->with(compact('book', 'materials'));
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Return the view for Admin to Add Books
     * 
     * @return \Illuminate\Http\Response
     */
    public function addBookView(){
        return view('admin.catalog.addBook');
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
            'ISBN'=>'required|min:13|max:13|unique:books,ISBN|regex:/[0-9]/',
            'title'=>'required|max:255',
            'description' => 'required',
            'author' => 'required|max:255',
            'publication' => 'required|max:255',
            'publication_date'=>'required|date_format:Y-m-d|before_or_equal:today',
            'price'=>'required|numeric|min:0|max:100',
            'language'=>'required',
            'access_level'=>'required|numeric|min:1|max:3',
        ]);
        
        // create new Book to be saved 
        $book = new Book();
        // assign cover_img
        if($request->hasFile('cover_img')) {
            // define image file and set file name to ISBN.ext
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
            return redirect()->route('manage_book_details', [ 'ISBN'=> $request->ISBN ])->with('Success', 'Book has been Added');
        }
        else{
            return redirect()->back()->with('Fail','Failed to Add Book');
        }
    }

    /**
     * Return the view for Admin to Edit Books
     * 
     * @return \Illuminate\Http\Response
     */
    public function editBookView(Request $request){
        $book = Book::find($request->ISBN);
        if ($book){
            return view('admin.catalog.editBook')->with(compact('book'));
        }
        else{
            return redirect()->back()->with("Error", "No such Book with specified ISBN found");
        }
    }

    /**
     * Edit Book Data
     * 
     * @return \Illuminate\Http\Response
     */
    public function editBook(Request $request){
        //validate book info before storing to database
        $request->validate([
            'ISBN'=>'required|min:13|max:13|exists:books,ISBN|regex:/[0-9]/',
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
        $book = Book::find($request->ISBN);

        // assign cover_img if exists
        if($request->hasFile('cover_img')) {
            // define image file and set file name to ISBN.ext
            $image = $request->file('cover_img');
            $imageFileType = strtolower(pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION));
            $image_name = $request->ISBN. '.' .$imageFileType;

            // move image onto server folder for future use, override old image
            $path = public_path().'/images/book_covers';
            $image->move($path, $image_name);
            // Edit File Name in case extension change
            $book->cover_img = $image_name;
        }
        // assign other data
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
            // call touch in case only image is updated to update updated_at timestamp
            $book->touch();
            return redirect()->route('manage_book_details', [ 'ISBN'=> $request->ISBN ])
            ->with('Success', 'Book Details has been Edited');
        }
        else{
            return redirect()->back()->with('Fail','Failed to Edit Book Details');
        }
    }

    /**
     * Delete specified Book
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteBook(Request $request){
        // check ISBN passed
        $book = Book::find($request->ISBN);
        if ($book){
            // check if any material is being borrowed or booked
            if ($this->borrowedExists($request->ISBN)){
                return redirect()->back()
                ->with("Fail", "Failed to Delete. This Book still has Material that is being Borrowed!");
            }
            // delete
            $res = $book->delete();
            if ($res){
                return redirect()->route('manage_books')->with('Success', 'Book has been deleted!');
            }
        }
        // fail
        return redirect()->back()->with("Fail", "Specified Book could not be deleted!");
    }

    /**
     * Check if specified ISBN has borrowed/booked material
     * 
     * @return boolean
     */
    public function borrowedExists($ISBN){
        $count = Material::where('ISBN', $ISBN)
                ->whereIn('status', [2, 3])
                ->count();
        if ($count){
            return true;
        }
        return false;
    }

    /**
     * Return View for Searching Catalog
     * 
     * @return \Illuminate\Http\Response
     */
    public function searchCatalogView()
    {
        return view('admin.catalog.search');
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

        return view('admin.catalog.books')->with(compact('books'));
    }
}
