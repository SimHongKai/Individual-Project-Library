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
            ->select('users.username', 'rewardHistory.reward_history_id', 'rewardHistory.status',
            'rewardHistory.name', 'rewardHistory.description', 'rewardHistory.points_required', 'rewardHistory.created_at')
            ->join('users', 'rewardHistory.user_id', '=' ,'users.user_id')
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
            ->select('users.username', 'rewardHistory.reward_history_id', 'rewardHistory.status',
            'rewardHistory.name', 'rewardHistory.description', 'rewardHistory.points_required', 'rewardHistory.created_at')
            ->join('users', 'rewardHistory.user_id', '=' ,'users.user_id')
            ->where('rewardHistory.status', 1)
            ->orderBy('rewardHistory.created_at', 'desc')
            ->paginate(10);

        return view('admin.record.unclaimedRewardList')->with(compact('rewardHistory'));
    }
    
    /**
     * Return Claim Reward Details
     * 
     * @return \Illuminate\Http\Response
     */
    public function getClaimRewardDetails(Request $request)
    {
        // Get Reward that is unclaimed
        $rewardHistory = DB::table('rewardHistory')
            ->select('users.username', 'rewards.reward_img', 'rewardHistory.reward_history_id', 
            'rewardHistory.name', 'rewardHistory.description', 'rewardHistory.points_required', 'rewardHistory.created_at')
            ->join('rewards', 'rewardHistory.reward_id', '=' ,'rewards.reward_id')
            ->join('users', 'rewardHistory.user_id', '=' ,'users.user_id')
            ->where('rewardHistory.reward_history_id', $request->reward_history_id)
            ->where('rewardHistory.status', 1)
            ->first();

        if ($rewardHistory){
            return $rewardHistory;
        }
        return null;

    }
}
