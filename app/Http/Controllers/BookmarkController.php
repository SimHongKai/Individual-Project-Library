<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use Auth;

class BookmarkController extends Controller
{
    /**
     * Add Bookmark
     * 
     * @return \Illuminate\Http\Response
     */
    public function addBookmark(Request $request)
    {
        $bookmark = Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'ISBN' => $request->ISBN,
        ]);
    }

    /**
     * Remove Bookmark
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteBookmark(Request $request)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())->where('ISBN', $request->ISBN)
                    ->delete();
    }
}
