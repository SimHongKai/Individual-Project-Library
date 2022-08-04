<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BorrowHistory;
use App\Models\Book;
use App\Models\Material;
use DB;

class BorrowBookController extends Controller
{

    /**
     * Return view for Form to enter Book that will be borrowed
     * 
     * @return \Illuminate\Http\Response
     */
    public function borrowBookView(Request $request)
    {
        $book = new Book();
        // get data here
        return view('admin.borrow.borrowBook')->with(compact('book'));
    }

    /**
     * Return user info
     * 
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        
    }

    /**
     * Return Material and Book info
     * 
     * @return \Illuminate\Http\Response
     */
    public function getMaterial(Request $request)
    {
        
    }

    /**
     * Borrow Book, Material
     * 
     * @return \Illuminate\Http\Response
     */
    public function borrowBook(Request $request)
    {
        if ($request->material_no != null){
            return redirect()->back()->with('Success', 'Book has been Borrowed!');
        }
        // fail
        return redirect()->back()->with("Fail", "Book was not Borrowed!");
    }

}
