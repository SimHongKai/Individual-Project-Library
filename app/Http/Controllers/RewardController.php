<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;

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
     * Claims the reward
     * 
     * @return \Illuminate\Http\Response
     */
    public function claimReward($reward_id)
    {
        $reward = Reward::find($reward_id);
        
        return redirect()->route('reward_shop')
            ->with('Success', 'The Reward, '. $reward->name .' has been claimed successfully');
    }
}
