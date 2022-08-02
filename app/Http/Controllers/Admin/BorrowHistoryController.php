<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BorrowHistory;
use App\Models\Book;

class BorrowHistoryController extends Controller
{
    /**
     * Return list of Borrow Records for Admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowHistory = BorrowHistory::paginate(2);
        return view('admin.record.borrowRecords')->with(compact('borrowHistory'));
    }

}
