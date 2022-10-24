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
        // get all rewards that have qty
        $rewards = Reward::where('available_qty', '>', 0)->get();
        return view('rewardRedemption')->with(compact('rewards'));
    }

    /**
     * Claims the reward, add to History and Deduct
     * 
     * @return \Illuminate\Http\Response
     */
    public function redeemReward($reward_id)
    {
        // get Reward
        $reward = Reward::find($reward_id);
        if(!$reward){
            return redirect()->back();
        }

        // find user to deduct Points
        $user = Auth::user();
        
        // check if points sufficient and reward still available
        if ($user->current_points >= $reward->points_required && $reward->available_qty > 0){
            // deduct points and qty
            $user->decrement('current_points', $reward->points_required);
            $reward->decrement('available_qty', 1);
            // add Reward History
            $res = RewardHistory::Create([
                'user_id' => Auth::id(),
                'reward_id' => $reward_id,
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
