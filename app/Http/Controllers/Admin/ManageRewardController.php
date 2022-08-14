<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\RewardHistory;
use Auth;
use DB;

class ManageRewardController extends Controller
{
    /**
     * Return view with list of Rewards for Admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewards = Reward::all();
        return view('admin.reward.rewardList')->with(compact('rewards'));
    }

    /**
     * Return view for Admin to Add Rewards
     * 
     * @return \Illuminate\Http\Response
     */
    public function addRewardView(Request $request)
    {
        return view('admin.reward.addReward');
    }

    /**
     * Add Reward based on form
     * 
     * @return \Illuminate\Http\Response
     */
    public function addReward(Request $request)
    {
        //validate book info before storing to database
        $request->validate([
            'name'=>'required|max:255',
            'description' => 'required',
            'points_required'=>'required|numeric|min:0',
            'available_qty' => 'required|numeric|min:0',
        ]);
        
        // create new reward to be saved 
        $reward = new Reward();
        // assign reward_img
        if($request->hasFile('reward_img')) {
            // define image file and add ?time() to end of image name for unique image
            $image = $request->file('reward_img');
            $imageFileType = strtolower(pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION));
            $image_name = time(). '_' .$image->getClientOriginalName();

            // move image onto server folder for future use 
            $path = public_path().'/images/rewards';
            $image->move($path, $image_name);
            $reward->reward_img = $image_name;
        }
        else {
            $reward->reward_img = 'no_img_available.jpg';
        }
        
        // assign other data
        $reward->name = $request->name;
        $reward->description = $request->description;
        $reward->points_required = $request->points_required;
        $reward->available_qty = $request->available_qty;
 
        // save reward record
        $res = $reward->save();

        if($res){
            return redirect()->route('manage_rewards')->with('Success', 'Reward has been Added');
        }
        else{
            return redirect()->back()->with('Fail','Failed to Add Reward');
        }
    }

    /**
     * Return view for Admin to Edit Rewards
     * 
     * @return \Illuminate\Http\Response
     */
    public function editRewardView(Request $request, $reward_id)
    {
        // find reward
        $reward = Reward::find($reward_id);
        if ($reward != null){
            return view('admin.reward.editReward')->with(compact('reward'));
        }
        // Fail
        return redirect()->back()->with("Error", "No such Reward with specified ID found". $reward_id);
    }

    /**
     * Edit Reward
     * 
     * @return \Illuminate\Http\Response
     */
    public function editReward(Request $request)
    {
        //validate book info before storing to database
        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
            'name' => 'required|max:255',
            'description' => 'required',
            'points_required' => 'required|numeric|min:0',
            'available_qty' => 'required|numeric|min:0',
        ]);
        
        // find the reward
        $reward = Reward::find($request->reward_id);
        // if does not exist
        if ($reward == null){
            return redirect()->back()->with("Fail", "No such Reward found");
        }

        // assign reward_img
        if($request->hasFile('reward_img')) {
            // define image file and add ?time() to end of image name for unique image
            $image = $request->file('reward_img');
            $imageFileType = strtolower(pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION));
            $image_name = time(). '_' .$image->getClientOriginalName();

            // move image onto server folder for future use 
            $path = public_path().'/images/rewards';
            $image->move($path, $image_name);
            $reward->reward_img = $image_name;
        }

        // assign other data
        $reward->name = $request->name;
        $reward->description = $request->description;
        $reward->points_required = $request->points_required;
        $reward->available_qty = $request->available_qty;
 
        // save edited reward record
        $res = $reward->save();

        if($res){
            return redirect()->route('manage_rewards')->with('Success', 'Reward has been Edited');
        }
        else{
            return redirect()->back()->with('Fail','Failed to Edit Reward');
        }
    }

    /**
     * Delete specified Reward
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteReward(Request $request, $reward_id){
        // check rewardId passed
        if ($reward_id != null){
            $reward = Reward::find($reward_id);
            
            // check if exists
            if ($reward != null){
                // delete
                $res = $reward->delete();
                if ($res){
                    return redirect()->route('manage_rewards')->with('Success', 'Reward has been deleted!');
                }
            }
            
        }
        // fail
        return redirect()->back()->with("Error", "Specified Reward could not be deleted!");
    }

}
