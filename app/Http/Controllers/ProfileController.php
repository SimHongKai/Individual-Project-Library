<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Configuration;
use DB;
use Auth;


class ProfileController extends Controller
{
    //

    /**
     * Return list of Bookmarks for User
     * 
     * @return \Illuminate\Http\Response
     */
    public function bookmarkView()
    {
        $user = $this->getUserProfileInfo();

        $bookmarks = DB::table('bookmarks')
            ->select('books.ISBN', 'books.title', 'books.cover_img', 'books.available_qty')
            ->join('books', 'bookmarks.ISBN', '=', 'books.ISBN')
            ->where('bookmarks.user_id', '=', $user->user_id)
            ->paginate(10);
            
        return view('bookmarks')->with(compact('bookmarks', 'user'));
    }

    /**
     * Return list of Borrow Records for User
     * 
     * @return \Illuminate\Http\Response
     */
    public function borrowHistoryView()
    {
        $user = $this->getUserProfileInfo();

        $borrowHistory = DB::table('borrowHistory')
            ->select('books.ISBN', 'books.title', 'books.cover_img', 'borrowHistory.status',
            'borrowHistory.material_no', 'borrowHistory.borrowed_at', 'borrowHistory.due_at', 
            'borrowHistory.returned_at', 'borrowHistory.late_fees')
            ->join('books', 'borrowHistory.ISBN', '=', 'books.ISBN')
            ->where('borrowHistory.user_id', '=', $user->user_id)
            ->orderBy('borrowHistory.borrowed_at', 'desc')
            ->paginate(10);
            
        return view('borrowHistory')->with(compact('borrowHistory', 'user'));
    }

    /**
     * Return list of Reward Records for User
     * 
     * @return \Illuminate\Http\Response
     */
    public function rewardHistoryView()
    {
        $user = $this->getUserProfileInfo();

        $rewardHistory = DB::table('rewardHistory')
            ->select('reward_history_id', 'name', 'description', 'points_required', 'status', 'created_at')
            ->where('user_id', '=', $user->user_id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('rewardHistory')->with(compact('rewardHistory', 'user'));
    }

    /**
     * Return list of Bookings for user
     * 
     * @return \Illuminate\Http\Response
     */
    public function bookingHistoryView()
    {
        $user = $this->getUserProfileInfo();

        $bookings = DB::table('bookings')
                ->select('bookings.booking_id', 'users.username', 'bookings.ISBN', 'bookings.material_no', 'bookings.status',
                'books.title', 'bookings.created_at', 'bookings.updated_at')
                ->join('books', 'bookings.ISBN', '=' ,'books.ISBN')
                ->join('users', 'bookings.user_id', '=' ,'users.user_id')
                ->where('bookings.user_id', '=', $user->user_id)
                ->orderBy('bookings.status')
                ->orderBy('bookings.created_at', 'desc')
                ->paginate(10);

        return view('bookingHistory')->with(compact('bookings', 'user'));
    }

    /**
     * Return list of user info for profile
     * 
     * @return User
     */
    public function getUserProfileInfo()
    {
        $user = Auth::user();
        $config = Configuration::find($user->privilege);
        $user->point_limit = $config->point_limit;

        return $user;
    }

    /**
     * Award User Points for Daily
     * 
     * @return \Illuminate\Http\Response
     */
    public function claimDaily()
    {
        $user = Auth::user();
        $current_date = date('Y-m-d');
        // check if reward was claimed today
        if (strcmp($user->last_check_in, $current_date) != 0 ){
            $this->giveUserPoints($user->user_id, 100);

            // update last check-in
            $user->last_check_in = $current_date;
            $user->save();
        }
        // else do nothing

        // redirect back to profile
        return redirect()->back();
    }

    /**
     * Give User Points
     *
     * @return
     */
    public function giveUserPoints($user_id, $increase)
    {
        $user = User::find($user_id);
        $config = Configuration::find($user->privilege);

        $weekly_points = $user->weekly_points + $increase;

        // check if over point limit
        if($weekly_points > $config->point_limit){
            // if over add till the max point_limit add(limit - current weekly), if max then will add 0
            $increase = $config->point_limit - $user->weekly_points;
        }
        
        $user->increment('total_points', $increase);
        $user->increment('current_points', $increase);
        $user->increment('weekly_points', $increase);
    }
}
