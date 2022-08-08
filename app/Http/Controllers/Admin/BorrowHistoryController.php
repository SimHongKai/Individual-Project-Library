<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BorrowHistoryController extends Controller
{
    /**
     * Return list of Borrow Records for Admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowHistory = DB::table('borrowHistory')
            ->select('users.username', 'books.ISBN', 'books.title', 'books.cover_img', 'borrowHistory.status',
            'borrowHistory.material_no', 'borrowHistory.borrowed_at', 'borrowHistory.due_at', 'borrowHistory.returned_at')
            ->join('books', 'borrowHistory.ISBN', '=', 'books.ISBN')
            ->join('users', 'borrowHistory.user_id', '=' ,'users.id')
            ->paginate(10);
            
        return view('admin.record.borrowRecords')->with(compact('borrowHistory'));
    }

}
