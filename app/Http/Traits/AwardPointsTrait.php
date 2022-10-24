<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;
use DB;
use App\Models\Configuration;
use App\Models\User;
use Auth;

trait AwardPointsTrait
{
    /**
     * Give User Points
     *
     * @return
     */
    public function giveUserPoints($user_id, $increase)
    {
        $user = User::find($user_id);
        if ($user == null){
            $user = Auth::user();
        }
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
