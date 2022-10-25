<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ManageConfigurationTest extends TestCase
{
    use DatabaseTransactions;
    // php artisan test --filter ManageConfigurationTest

    /**
     * Test Edit Config View
     * 
     * @return void
     */
    public function test_edit_config_view(){

        $user = User::factory(User::class)->create();

        // route to Register function
        $response = $this->actingAs($user)
                    ->get(route('edit_configuration'));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.editConfiguration');
        $response->assertViewHas('config');
    }

    /**
     * Test Edit Config Validation Success
     * @dataProvider validEditConfigDataProvider
     * SHK
     * @return void
     */
    public function test_edit_config($admin_borrow_no, $admin_borrow_duration, $privileged_borrow_no, $privileged_borrow_duration,
     $regular_borrow_no, $regular_borrow_duration, $late_fees_base, $late_fees_increment, $point_limit){

        $user = User::factory(User::class)->create();

        // route to edit config function
        $response = $this->actingAs($user)->post(route('edit_configuration_submit'), [
            'admin_borrow_no'=> $admin_borrow_no,
            'admin_borrow_duration'=> $admin_borrow_duration,
            'privileged_borrow_no'=> $privileged_borrow_no,
            'privileged_borrow_duration'=> $privileged_borrow_duration,
            'regular_borrow_no'=> $regular_borrow_no,
            'regular_borrow_duration'=> $regular_borrow_duration,
            'late_fees_base'=> $late_fees_base,
            'late_fees_increment'=> $late_fees_increment,
            'point_limit'=> $point_limit,
        ]);

        $this->assertDatabaseHas('configurations', [
            'late_fees_base'=> $late_fees_base,
            'late_fees_increment'=> $late_fees_increment,
            'point_limit'=> $point_limit,
        ]);
        $this->assertDatabaseHas('configurations', [
            'privilege'=> 3,
            'no_of_borrows'=> $regular_borrow_no,
            'borrow_duration'=> $regular_borrow_duration,
        ]);
        $this->assertDatabaseHas('configurations', [
            'privilege'=> 2,
            'no_of_borrows'=> $privileged_borrow_no,
            'borrow_duration'=> $privileged_borrow_duration,
        ]);
        $this->assertDatabaseHas('configurations', [
            'privilege'=> 1,
            'no_of_borrows'=> $admin_borrow_no,
            'borrow_duration'=> $admin_borrow_duration,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('edit_configuration'));
    }

    public function validEditConfigDataProvider()
    {
        return array(
            array(1, 1, 1, 1, 1, 1, 2.00, 0.20, 1000),
            array(0, 0, 0, 0, 0, 0, 0, 0, 0),
        );
    }

    /**
     * Test Edit Config Validation Failure
     * @dataProvider invalidEditConfigDataProvider
     * SHK
     * @return void
     */
    public function test_edit_config_failure($admin_borrow_no, $admin_borrow_duration, $privileged_borrow_no, $privileged_borrow_duration,
     $regular_borrow_no, $regular_borrow_duration, $late_fees_base, $late_fees_increment, $point_limit){

        $user = User::factory(User::class)->create();

        // route to edit config function
        $response = $this->actingAs($user)->from(route('edit_configuration_submit'))
                        ->post(route('edit_configuration_submit'), [
            'admin_borrow_no'=> $admin_borrow_no,
            'admin_borrow_duration'=> $admin_borrow_duration,
            'privileged_borrow_no'=> $privileged_borrow_no,
            'privileged_borrow_duration'=> $privileged_borrow_duration,
            'regular_borrow_no'=> $regular_borrow_no,
            'regular_borrow_duration'=> $regular_borrow_duration,
            'late_fees_base'=> $late_fees_base,
            'late_fees_increment'=> $late_fees_increment,
            'point_limit'=> $point_limit,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('edit_configuration'));
        $response->assertSessionHasErrors();
    }

    public function invalidEditConfigDataProvider()
    {
        return array(
            array('', 1, 1, 1, 1, 1, 2.00, 0.20, 1000),
            array(1, '', 1, 1, 1, 1, 2.00, 0.20, 1000),
            array(1, 1, '', 1, 1, 1, 2.00, 0.20, 1000),
            array(1, 1, 1, '', 1, 1, 2.00, 0.20, 1000),
            array(1, 1, 1, 1, '', 1, 2.00, 0.20, 1000),
            array(1, 1, 1, 1, 1, '', 2.00, 0.20, 1000),
            array(1, 1, 1, 1, 1, 1, '', 0.20, 1000),
            array(1, 1, 1, 1, 1, 1, 2.00, '', 1000),
            array(1, 1, 1, 1, 1, 1, 2.00, 0.20, ''),
        );
    }

}
