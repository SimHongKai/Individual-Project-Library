<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LeaderboardController extends Controller
{   
    /**
     * Show the application home screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $pageNumber = $this->getPaginationNumber(1, $user->total_points);

        $users = User::orderBy('total_points', 'desc')->paginate(1);
        $topUsers = User::orderBy('total_points', 'desc')->limit(3)->get();

        return view('leaderboard')->with(compact('users', 'topUsers', 'pageNumber'));
    }

    /**
     * Get the pagination number
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPaginationNumber($paginationValue, $points)
    {
        $position = User::where('total_points','<=',$points)->count(); // for example 601
        $inserted_id_in_page = 2; //$position / $paginationValue; // then goes to page 2

        return $inserted_id_in_page;
    }


}

 