<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Book;
use App\Models\Material;
use Auth;
use DB;

class BookingController extends Controller
{
    /**
     * Return list of Bookings for admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = DB::table('bookings')
        ->select('users.username', 'bookings.ISBN', 'bookings.material_no', 'bookings.status',
        'books.title', 'bookings.created_at', 'bookings.updated_at')
        ->join('books', 'bookings.ISBN', '=' ,'books.ISBN')
        ->join('users', 'bookings.user_id', '=' ,'users.id')
        ->orderBy('bookings.status')
        ->orderBy('bookings.created_at', 'desc')
        ->paginate(10);

        return view('admin.record.bookingRecords')->with(compact('bookings'));
    }

    /**
     * Create a Booking
     * 
     * @return \Illuminate\Http\Response
     */
    public function createBooking(Request $request, $ISBN){
        
        $user = Auth::user();
        $book = Book::find($ISBN);

        // Check if User already has an existing booking
        $bookingCount = Booking::where('user_id', $user->id)
                        ->where('status', '!=', 3)
                        ->count();
        // TODO Add check for borrow History

        if ($bookingCount > 0){
            return redirect()->back()->with("Fail", "You already have an existing booking!");
        }

        // check user privilege vs book access_level
        if ($this->checkUserPrivilege($user->privilege, $book->access_level)){
            // if true, user has access, then proceed to create booking
            $booking = new Booking();
            $booking->user_id = $user->id;
            $booking->ISBN = $ISBN;
            $booking->status = 2; //default no material found yet

            // check if there is available material right now
            $material = Material::where('ISBN', $ISBN)
                        ->where('status', 1)
                        ->get()
                        ->first();

            // if available assign to booking and insert
            if ($material){
                // update material status to booked
                $material->status = 3;
                $material->save();
                $this->updateBookQty($ISBN);
                // create booking
                $booking->material_no = $material->material_no;
                $booking->status = 1;
            }
            // else just save the booking
            $res = $booking->save();

        }else{
            // else return back to page
            return redirect()->back()->with("Fail", "You are not authorised to borrow this material!");
        }

        return redirect()->route('book_details', [ 'ISBN'=> $ISBN ])->with("Success", "Booking has been made!");
    }

    /**
     * Cancel a Booking
     * 
     * @return \Illuminate\Http\Response
     */
    public function cancelBooking(Request $request, $bookingID){
        
        $booking = Booking::find($bookingID);

        $user = Auth::user();
        // only admin or the user who made the booking can cancel it
        if ($user->privilege == 1 || $user->id == $booking->user_id){
            
            // when booking hasn't assigned material yet
            if ($booking->status == 2){
                // just delete no need to keep log
                $booking->delete();
            }else if ($booking->status == 1){
                // check if there is another booking for this book in queue
                $nextBooking = Booking::where('ISBN', $booking->ISBN)
                                ->where('status', 2)
                                ->orderBy('created_at')
                                ->first();
                // if another booking exists
                if ($nextBooking){
                    // set next booking to use this material
                    $nextBooking->material_no = $booking->material_no;
                    $nextBooking->status = 1;
                    $nextBooking->save();
                }else{
                    // if no more booking
                    // update $material to be available
                    $material = Material::find($booking->material_no);
                    $material->status = 1;
                    $material->save();
                    // update Book qty
                    $this->updateBookQty($booking->ISBN);
                }
                // update booking to be cancelled/complete
                $booking->status = 3;
                $booking->save();
            }

        }else{
            return redirect()->route('book_details', [ 'ISBN'=> $booking->ISBN ])->with("Fail", "Booking was not cancelled!");
        }

        return redirect()->route('book_details', [ 'ISBN'=> $booking->ISBN ])->with("Success", "Booking has been cancelled!");
    }
    
    /**
     * Check Privilege
     * 
     * @return boolean
     */
    public function checkUserPrivilege($privilege, $access_level){
        // check user privilege vs book access_level
        switch($privilege){
            case 1: // Admin can borrow all so do nothing
                return true;
                break;
            case 2: // Privileged cannot borrowed Full Restrict
                if ($access_level != 3)
                    return true;
                break;
            case 3: // Regular user only borrow no restricted books
                if ($access_level = 1)
                    return true;
                break;
            default:
                return false;
        }
    }

    /**
     * Check and update Book Qty
     *
     * @return \Illuminate\Http\Response
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
}
