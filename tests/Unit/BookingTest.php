<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use BookTableSeeder;
use MaterialTableSeeder;
use BookingTableSeeder;

class BookingTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Booking List View
     * 
     * @return void
     */
    public function test_booking_view(){

        $user = User::factory(User::class)->create();

        // route to Booking Page
        $response = $this->actingAs($user)
                    ->get(route('admin_booking_records'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.record.bookingRecords');
        $response->assertViewHas('bookings');
    }

    /**
     * Test Booked Only Booking List View
     * 
     * @return void
     */
    public function test_booked_only_view(){

        $user = User::factory(User::class)->create();

        // route to Booking Page
        $response = $this->actingAs($user)
                    ->get(route('admin_booked_only_records'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.record.bookingRecords');
        $response->assertViewHas('bookings');
    }

    /**
     * Test Booked with Material Booking List View
     * 
     * @return void
     */
    public function test_booked_with_material_view(){

        $user = User::factory(User::class)->create();

        // route to Booking Page
        $response = $this->actingAs($user)
                    ->get(route('admin_booked_material_records'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.record.bookingRecords');
        $response->assertViewHas('bookings');
    }

    /**
     * Test Create Booking
     * 
     * @return void
     */
    public function test_create_booking(){

        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $user = User::factory(User::class)->create([
            'user_id' => 999999,
        ]);

        // route to Book Details Page
        $response = $this->actingAs($user)->from(route('book_details', [ 'ISBN'=> '1234567891011' ]))
                    ->get(route('create_booking', [ 'ISBN'=> '1234567891011' ]));
        
        $this->AssertDatabaseHas('bookings', [
            'user_id' => $user->user_id,
            'ISBN' => '1234567891011',
            'status' => 1,
            'expire_at' => date('Y-m-d', strtotime("+7 days"))
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('book_details', [ 'ISBN'=> '1234567891011' ]));
    }

    /**
     * Test Create Booking
     * 
     * @return void
     */
    public function test_cancel_booking(){

        $this->seed(BookingTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Book Details Page
        $response = $this->actingAs($user)->get(route('cancel_booking', [ 'bookingID'=> '999999' ]));
        
        $this->AssertDatabaseHas('bookings', [
            'booking_id' => 999999,
            'ISBN' => '1234523876954',
            'status' => 3
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('book_details', [ 'ISBN'=> '1234523876954' ]));
    }

    /**
     * Test Check User Priv
     * @dataProvider trueData
     * @return void
     */
    public function test_check_user_privilege_true($privilege, $access_level){
        
        $testController = new \App\Http\Controllers\BookingController;
        $response = $testController->checkUserPrivilege($privilege, $access_level);

        $this->assertTrue($response);
    }

    public function trueData()
    {
        return array(
            array(1, 3),
            array(2, 2),
            array(3, 1),
        );
    }

    /**
     * Test Check User Priv
     * @dataProvider falseData
     * @return void
     */
    public function test_check_user_privilege_false($privilege, $access_level){
        
        $testController = new \App\Http\Controllers\BookingController;
        $response = $testController->checkUserPrivilege($privilege, $access_level);

        $this->assertTrue(!$response);
    }

    public function falseData()
    {
        return array(
            array(2, 3),
            array(3, 2),
            array(3, 3),
        );
    }
}
