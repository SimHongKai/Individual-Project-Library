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
        $paginationValue = 25;
        $user = Auth::user();
        // find number of people that have points higer than user then + 1 to get user pos
        $position = User::where('total_points','>',$user->total_points)->count() + 1;
        $pageNumber = $position/$paginationValue;

        $users = User::orderBy('total_points', 'desc')->paginate($paginationValue);
        $topUsers = User::orderBy('total_points', 'desc')->limit(3)->get();

        return view('leaderboard')->with(compact('users', 'topUsers', 'pageNumber', 'position'));
    }

}

 