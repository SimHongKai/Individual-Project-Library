<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\User;
use App\Models\RewardHistory;
use Auth;

class RewardController extends Controller
{
    /**
     * Return view with list of Rewards for Users to see and Claim
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewards = Reward::all();
        return view('rewardShop')->with(compact('rewards'));
    }

    /**
     * Claims the reward, add to History and Deduct
     * 
     * @return \Illuminate\Http\Response
     */
    public function claimReward($reward_id)
    {
        // get Reward
        $reward = Reward::find($reward_id);
        
        // deduct Points
        $user = User::find(Auth::id());
        
        // check if points sufficient
        if ($user->current_points >= $reward->points_required){
            // deduct 
            $user->decrement('current_points', $reward->points_required);
            // add Reward History
            $res = RewardHistory::Create([
                'user_id' => Auth::id(),
                'name' => $reward->name,
                'description' => $reward->description,
                'points_required' => $reward->points_required,
            ]);

            if ($res){
                return redirect()->route('reward_shop')
                    ->with('Success', 'The Reward, '. $reward->name .' has been claimed successfully.');
            }
        }
        return redirect()->route('reward_shop')
                    ->with('Fail', 'The Reward, '. $reward->name .' could not be claimed.');
        
    }
}
