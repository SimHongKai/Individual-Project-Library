<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RewardHistoryController extends Controller
{
    /**
     * Return list of Reward Records for Admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewardHistory = DB::table('rewardHistory')
            ->select('users.username',
            'rewardHistory.name', 'rewardHistory.description', 'rewardHistory.points_required', 'rewardHistory.created_at')
            ->join('users', 'rewardHistory.user_id', '=' ,'users.id')
            ->paginate(2);

        return view('admin.record.rewardRecords')->with(compact('rewardHistory'));
    }

}
