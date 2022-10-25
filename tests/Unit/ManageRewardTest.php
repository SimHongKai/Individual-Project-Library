<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reward;
use App\Models\RewardHistory;
use RewardTableSeeder;
use RewardHistoryTableSeeder;

class ManageRewardTest extends TestCase
{
    use DatabaseTransactions;
    // php artisan test --filter ManageRewardTest

    /**
     * Test Manage Reward View
     * 
     * @return void
     */
    public function test_manage_reward_view(){

        $user = User::factory(User::class)->create();

        // route to Register function
        $response = $this->actingAs($user)
                    ->get(route('manage_rewards'));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.reward.rewardList');
        $response->assertViewHas('rewards');
    }

    /**
     * Test Add Reward View
     * 
     * @return void
     */
    public function test_add_reward_view(){

        $user = User::factory(User::class)->create();

        // route to Register function
        $response = $this->actingAs($user)
                    ->get(route('add_reward'));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.reward.addReward');
    }

    /**
     * Test Reward Validation Failure
     * @dataProvider invalidRewardDataProvider
     * SHK
     * @return void
     */
    public function test_reward_validation_failure($name, $description, $points_required, $available_qty){

        $user = User::factory(User::class)->create();

        // route to edit config function
        $response = $this->actingAs($user)->from(route('add_reward'))
                        ->post(route('add_reward_submit'), [
            'name'=>$name,
            'description' =>$description,
            'points_required'=>$points_required,
            'available_qty' =>$available_qty,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('add_reward'));
        $response->assertSessionHasErrors();
    }

    public function invalidRewardDataProvider()
    {
        return array(
            array('', 'TestRewardDescription', 100, 10),
            array('TestRewardName', '', 100, 10),
            array('TestRewardName', 'TestRewardDescription', -100, 10),
            array('TestRewardName', 'TestRewardDescription', 100, -10),
        );
    }

    /**
     * Test Add Reward Validation Success
     * @dataProvider validRewardDataProvider
     * SHK
     * @return void
     */
    public function test_add_reward($name, $description, $points_required, $available_qty){

        $user = User::factory(User::class)->create();

        // route to edit config function
        $response = $this->actingAs($user)->from(route('add_reward'))
                        ->post(route('add_reward_submit'), [
            'name'=>$name,
            'description' =>$description,
            'points_required'=>$points_required,
            'available_qty' =>$available_qty,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_rewards'));
        $this->assertDatabaseHas('rewards', [
            'name' => 'TestRewardName',
            'description' => 'TestRewardDescription',
            'points_required' => 100,
            'available_qty' => 10,
        ]);
    }

    /**
     * Test Edit Reward View
     * 
     * @return void
     */
    public function test_edit_reward_view(){
        $this->seed(RewardTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Register function
        $response = $this->actingAs($user)
                    ->get(route('edit_reward', ['reward_id'=>999999]));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.reward.editReward');
        $response->assertViewHas('reward');
    }

    /**
     * Test Edit Reward Validation Success
     * @dataProvider validRewardDataProvider
     * SHK
     * @return void
     */
    public function test_edit_reward($name, $description, $points_required, $available_qty){
        $this->seed(RewardTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to edit config function
        $response = $this->actingAs($user)->from(route('edit_reward', ['reward_id'=>999999]))
                        ->post(route('edit_reward_submit'), [
            'reward_id'=>999999,
            'name'=>$name,
            'description' =>$description,
            'points_required'=>$points_required,
            'available_qty' =>$available_qty,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_rewards'));
        $this->assertDatabaseHas('rewards', [
            'name' => 'TestRewardName',
            'description' => 'TestRewardDescription',
            'points_required' => 100,
            'available_qty' => 10,
        ]);
    }
    
    public function validRewardDataProvider()
    {
        return array(
            array('TestRewardName', 'TestRewardDescription', 100, 10)
        );
    }

    /**
     * Test Delete Reward 
     * 
     * SHK
     * @return void
     */
    public function test_delete_reward(){
        $this->seed(RewardTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to edit config function
        $response = $this->actingAs($user)->from(route('manage_rewards'))
                        ->get(route('delete_reward', ['reward_id'=>999999]));

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_rewards'));
    }

    /**
     * Test Claim Reward View
     * 
     * @return void
     */
    public function test_claim_reward_view(){
        $user = User::factory(User::class)->create();

        // route to Register function
        $response = $this->actingAs($user)
                    ->get(route('claim_reward_view'));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.reward.claimReward');
    }

    /**
     * Test Claim Reward
     * 
     * SHK
     * @return void
     */
    public function test_claim_reward(){
        $this->seed(RewardHistoryTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to edit config function
        $response = $this->actingAs($user)->from(route('claim_reward_view'))
                        ->post(route('claim_reward_submit', ['reward_history_id'=>999999]));

        $response->assertStatus(302);
        $response->assertRedirect(route('claim_reward_view'));
        $this->assertDatabaseHas('rewardHistory', [
            'reward_history_id' => 999999,
            'status' => 2,
        ]);
    }

    /**
     * Test Cancel Reward
     * 
     * SHK
     * @return void
     */
    public function test_cancel_reward(){
        $this->seed(RewardHistoryTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to edit config function
        $response = $this->actingAs($user)->from(route('admin_unclaimed_rewards'))
                        ->get(route('cancel_reward', ['reward_history_id'=>999999]));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin_unclaimed_rewards'));
        $this->assertDatabaseHas('rewardHistory', [
            'reward_history_id' => 999999,
            'status' => 3,
        ]);
    }
}
