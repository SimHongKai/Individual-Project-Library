<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BorrowHistory;
use App\Models\Book;
use App\Models\Material;
use App\Models\Configuration;
use DB;
use Auth;
use Session;

class BorrowBookController extends Controller
{

    /**
     * Return view for Form to enter Book that will be borrowed
     * 
     * @return \Illuminate\Http\Response
     */
    public function borrowBookView(Request $request)
    {
        // pass empty User as the view will use a user variable in another route
        $user = new User();
        return view('admin.borrow.borrowBook')->with(compact('user'));
    }

    /**
     * Return user info
     * 
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        if ($request->user_id != null){
            // $request->user_id = ltrim($request->user_id, '0');

            $user = User::find($request->user_id);
            if ($user != null){
                $borrowed = $this->getBorrowCount($user->id);
                $available = Configuration::find($user->privilege)->no_of_borrows - $borrowed;

                // temporarily override as it is faster
                $user->borrowed = $borrowed;
                $user->available = $available;
                return $user;
            }
        }
        return null;
    }

    /**
     * Return Material and Book info
     * 
     * @return \Illuminate\Http\Response
     */
    public function getMaterial(Request $request)
    {
        if ($request->material_no != null){
            // $request->material_no = ltrim($request->material_no, '0');

            $material = Material::find($request->material_no);
            $book = Book::find($material->ISBN);
            if ($book != null){
                return $book;
            }
        }
        return null;
    }

    /**
     * Borrow Book, Material
     * 
     * @return \Illuminate\Http\Response
     */
    public function borrowBook(Request $request)
    {
        //validate user and material exists
        $request->validate([
            'user_id'=>'required|exists:users,id|regex:/[0-9]/',
            'material_no'=>'required|exists:materials,material_no|regex:/[0-9]/',
        ]);

        // get User and their configs
        $user = User::find($request->user_id);
        $config = Configuration::find($user->privilege);
        $user->borrowed = $this->getBorrowCount($user->id);
        $user->available = $config->no_of_borrows - $user->borrowed;

        // check if user can still borrow
        if ($user->available <= 0){
            // no more borrows error message
            return redirect()->back()->with("Fail", "User can not borrow anymore books!");
        }
        // check if user has any overdued books
        if ($this->getOverdueCount($user->id) > 0){
            // overdue book error message
            return redirect()->back()->with("Fail", "User has borrowed books that are overdue!");
        }

        // get Material and Book
        $material = Material::find($request->material_no);
        $book = Book::find($material->ISBN);
        if ($material->status != 1){ // not available to be borrowed
            // Material not available
            return redirect()->back()->with("Fail", "The Material is not available to be borrowed!");
        }

        // check user privilege vs book access_level
        switch($user->privilege){
            case 1: // Admin can borrow all so do nothing
                break;
            case 2: // Privileged cannot borrowed Full Restrict
                if ($book->access_level == 3)
                    return redirect()->back()->with("Fail", "The User is not authorised to borrow this Material!");
                break;
            case 3:
                if ($book->access_level != 1)
                    return redirect()->back()->with("Fail", "The User is not authorised to borrow this Material!");
                break;
            default:
                return redirect()->back()->with("Fail", "Error! User privilege not defined!");
        }

        // Borrow Books
        $material->status = 2;
        $material->save();

        $borrowHistory = new BorrowHistory();
        $borrowHistory->user_id = $request->user_id;
        $borrowHistory->material_no = $request->material_no;
        $borrowHistory->ISBN = $material->ISBN;
        $borrowHistory->due_at = date('Y-m-d', strtotime("+". $config->borrow_duration ."days"));
        $borrowHistory->created_by = Auth::id();
        $res = $borrowHistory->save();

        // success
        if ($res){
            // update BookQty
            $this->updateBookQty($material->ISBN);
            // reward user points here
            $this->giveUserPoints($user->id, 50);
            // update user->available and borrowed
            $user->borrowed = $user->borrowed + 1;
            $user->available = $user->available - 1;
            // flash message
            Session::flash('Success', 'Book has been Borrowed Successfully');
            return view('admin.borrow.borrowBook')->with(compact('user'));
        }
        // fail
        return redirect()->back()->with("Fail", "Book was not Borrowed!");
    }

    /**
     * Return view for Form to enter Book, Materal that will be returned
     * 
     * @return \Illuminate\Http\Response
     */
    public function returnBookView(Request $request)
    {
        return view('admin.borrow.returnBook');
    }

    /**
     * Return user and material info that is being returned
     * 
     * @return \Illuminate\Http\Response
     */
    public function getReturnDetails(Request $request)
    {
        if ($request->material_no != null){
            $request->material_no = ltrim($request->material_no, '0');

            $returnDetails = DB::table('borrowHistory')
                    ->select('users.id', 'users.username', 'users.privilege', 'books.ISBN','books.title',
                    'books.cover_img','books.author','books.publication','books.language','books.access_level','books.updated_at',
                    'borrowHistory.borrowed_at', 'borrowHistory.due_at')
                    ->join('books', 'borrowHistory.ISBN', '=', 'books.ISBN')
                    ->join('users', 'borrowHistory.user_id', '=' ,'users.id')
                    ->where('borrowHistory.material_no', $request->material_no) // same material
                    ->where('borrowHistory.status', 1) // not returned
                    ->first();
            if($returnDetails == null){
                return null;
            }
            // get borrow, available count
            $borrowed = $this->getBorrowCount($returnDetails->id);
            $available = Configuration::find($returnDetails->privilege)->no_of_borrows - $borrowed;

            // temporarily override as it is faster
            $returnDetails->borrowed = $borrowed;
            $returnDetails->available = $available;
            $returnDetails->late_fee = 0.00;

            $today = date('Y-m-d');
            // calculate Late Fee
            if ($returnDetails->due_at < $today){ // if late
                $dueDate = date_create($returnDetails->due_at);
                $today = date_create($today);
                $diff = date_diff($dueDate, $today);
                $diff = $diff->format("%a");
                $config = Configuration::find($returnDetails->id);
                $returnDetails->late_fee = $config->late_fees_base + ($config->late_fees_increment * ($diff-1));
            }

            return $returnDetails;
    }
        return null;
    }

    /**
     * Return Book, Material
     * 
     * @return \Illuminate\Http\Response
     */
    public function returnBook(Request $request)
    {
        //validate material exists
        $request->validate([
            'material_no'=>'required|exists:borrowHistory,material_no|regex:/[0-9]/',
        ]);

        $borrowHistory = DB::table('borrowHistory')->select('ISBN', 'user_id')
                        ->where('material_no', $request->material_no) // same material
                        ->where('status', 1) // not returned
                        ->first();
        if ($borrowHistory != null){
            DB::table('borrowHistory')
            ->where('material_no', $request->material_no) // same material
            ->where('status', 1) // not returned
            ->update(['status' => 2, 'returned_at' => date("Y-m-d H:i:s")]);

            // set material status to available
            $material = Material::find($request->material_no);
            $material->status = 1;
            $material->save();
            
            // update BookQty
            $this->updateBookQty($borrowHistory->ISBN);

            // reward user with points
            $this->giveUserPoints($borrowHistory->user_id, 50);
            return redirect()->route('return_book')->with('Success', 'Book Returned Successfully!');
        }
        return redirect()->back()->with('Fail', 'Material was not Borrowed!');
        
    }

    /**
     * Calculate the number of Books user borrowed
     * 
     * @return int
     */
    public function getBorrowCount($user_id)
    {
        $count = DB::table('borrowHistory')
                ->where('status', '1') // 1 is borrowed
                ->where('user_id', $user_id)
                ->count();
        return $count;
    }

    /**
     * Check if user has any overdue books
     * 
     * @return int
     */
    public function getOverdueCount($user_id)
    {
        $overdueCount = BorrowHistory::where('user_id', $user_id) // same user
                        ->where('status', 1) // not returned
                        ->where('due_at', '<', date('Y-m-d')) // over due date
                        ->count();
        return $overdueCount;
    }

    /**
     * Check and update Book Qty
     *
     * @return
     */
    public function updateBookQty($ISBN)
    {
        $book = Book::find($ISBN);
        $total_qty = DB::table('materials')
                    ->where('ISBN', $ISBN)
                    ->count();
        $available_qty = DB::table('materials')
                    ->where('ISBN', $ISBN)
                    ->where ('status', 1)
                    ->count();

        $book->total_qty = $total_qty;
        $book->available_qty = $available_qty;
        $book->save();
    }

    /**
     * Give User Points
     *
     * @return
     */
    public function giveUserPoints($user_id, $increase)
    {
        $user = User::find($user_id);
        $user->increment('total_points', $increase);
        $user->increment('current_points', $increase);
    }
}
