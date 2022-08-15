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
            ->select('users.username', 'rewardHistory.id', 'rewardHistory.status',
            'rewardHistory.name', 'rewardHistory.description', 'rewardHistory.points_required', 'rewardHistory.created_at')
            ->join('users', 'rewardHistory.user_id', '=' ,'users.id')
            ->orderBy('rewardHistory.updated_at', 'desc')
            ->paginate(10);

        return view('admin.record.rewardRecords')->with(compact('rewardHistory'));
    }

    /**
     * Return view with list of Rewards for Admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function unclaimedRewardView()
    {
        // Get All Rewards that were unclaimed
        $rewardHistory = DB::table('rewardHistory')
            ->select('users.username', 'rewardHistory.id', 'rewardHistory.status',
            'rewardHistory.name', 'rewardHistory.description', 'rewardHistory.points_required', 'rewardHistory.created_at')
            ->join('users', 'rewardHistory.user_id', '=' ,'users.id')
            ->where('status', 1)
            ->orderBy('rewardHistory.created_at', 'desc')
            ->paginate(10);

        return view('admin.record.unclaimedRewardList')->with(compact('rewardHistory'));
    }

}
