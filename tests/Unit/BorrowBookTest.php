<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use UsersTableSeeder;
use BookTableSeeder;
use MaterialTableSeeder;
use BorrowHistoryTableSeeder;
use BookingTableSeeder;

class BorrowBookTest extends TestCase
{
    // php artisan test --filter BorrowBookTest
    use DatabaseTransactions;

    /**
     * Test Borrow Book View
     * 
     * @return void
     */
    public function test_borrow_book_view(){

        $user = User::factory(User::class)->create();

        // route to Borrow Book Page
        $response = $this->actingAs($user)
                    ->get(route('borrow_book'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.borrow.borrowBook');
        $response->assertViewHas('user');
    }

    /**
     * Test Borrow Booked Book View
     * 
     * @return void
     */
    public function test_borrow_booked_book_view(){

        $user = User::factory(User::class)->create();

        // route to Borrow Book Page
        $response = $this->actingAs($user)
                    ->get(route('borrow_booked_book'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.borrow.borrowBookedBook');
        $response->assertViewHas('user');
    }

    /**
     * Test Return Book View
     * 
     * @return void
     */
    public function test_return_book_view(){

        $user = User::factory(User::class)->create();

        // route to Borrow Book Page
        $response = $this->actingAs($user)
                    ->get(route('return_book'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.borrow.returnBook');
    }

    /**
     * Test Get User Info Success
     * 
     * @return void
     */
    public function test_get_user_info(){

        $user = User::factory(User::class)->create([
            'user_id' => 999999
        ]);

        // route to Get User Info Call
        $response = $this->actingAs($user)
                    ->post(route('borrow_book_get_user', ['user_id' => 999999]));

        $this->assertNotNull($response);
    }

    /**
     * Test Get User Info Failure
     * 
     * @return void
     */
    public function test_get_user_info_failure(){

        $user = User::factory(User::class)->create([
            'user_id' => 999999
        ]);

        // route to Get User Info Call
        $response = $this->actingAs($user)
                    ->post(route('borrow_book_get_user', ['user_id' => 0]));

        $this->assertNotNull($response);
    }

    /**
     * Test Get Material Info Success
     * 
     * @return void
     */
    public function test_get_material_info(){
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Get Material Info Call
        $response = $this->actingAs($user)
                    ->post(route('borrow_book_get_material', ['material_no' => 999999]));

        $this->assertNotNull($response);
    }

    /**
     * Test Get Material Info Failure
     * 
     * @return void
     */
    public function test_get_material_info_failure(){
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Get Material Info Call
        $response = $this->actingAs($user)
                    ->post(route('borrow_book_get_material', ['material_no' => 0]));

        $this->assertNotNull($response);
    }

    /**
     * Test Get Booking Info Success
     * 
     * @return void
     */
    public function test_get_booking_info(){
        $this->seed(BookingTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Get Material Info Call
        $response = $this->actingAs($user)
                    ->post(route('borrow_book_get_booking', ['booking_id' => 999999]));

        $this->assertNotNull($response);
    }

    /**
     * Test Get Booking Info Failure
     * 
     * @return void
     */
    public function test_get_booking_info_failure(){
        $this->seed(BookingTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Get Material Info Call
        $response = $this->actingAs($user)
                    ->post(route('borrow_book_get_booking', ['booking_id' => 0]));

        $this->assertNotNull($response);
    }

    /**
     * Test Get Borrow Count
     * 
     * @return void
     */
    public function test_get_borrow_count(){
        
        $this->seed(UsersTableSeeder::class);

        $testController = new \App\Http\Controllers\Admin\BorrowBookController;
        $response = $testController->getBorrowCount(999999);

        $this->assertEquals($response, 0);
    }

    /**
     * Test Get Overdue Count
     * 
     * @return void
     */
    public function test_get_overdue_count(){
        
        $this->seed(UsersTableSeeder::class);

        $testController = new \App\Http\Controllers\Admin\BorrowBookController;
        $response = $testController->getOverdueCount(999999);

        $this->assertEquals($response, 0);
    }

    /**
     * Test Calculate Late Fees
     * 
     * @return void
     */
    public function test_calculate_late_fees(){
        
        $this->seed(UsersTableSeeder::class);

        $testController = new \App\Http\Controllers\Admin\BorrowBookController;
        $response = $testController->calculateLateFees(date('Y-m-d'), 1);

        $this->assertEquals($response, 0.00);
    }

    /**
     * Test Get Return Book Info Success
     * 
     * @return void
     */
    public function test_return_book_info(){
        $this->seed(UsersTableSeeder::class);
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $this->seed(BorrowHistoryTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Get return book Info Call
        $response = $this->actingAs($user)
                    ->post(route('get_return_details', ['material_no' => 999999]));

        $this->assertNotNull($response);
    }

    /**
     * Test Get Return Book Info Failure
     * 
     * @return void
     */
    public function test_return_book_info_failure(){
        $this->seed(UsersTableSeeder::class);
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $this->seed(BorrowHistoryTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Get return book Info Call
        $response = $this->actingAs($user)
                    ->post(route('get_return_details', ['material_no' => 0]));

        $this->assertNotNull($response);
    }

    /**
     * Test Borrow Book Success
     * 
     * @return void
     */
    public function test_borrow_book(){
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $user = User::factory(User::class)->create(
            ['user_id' => 999999]
        );

        // route to Borrow Book
        $response = $this->actingAs($user)->from(route('borrow_book'))
                    ->post(route('borrow_book_submit', [
                        'user_id' => 999999, 'material_no' => 999999,
                    ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.borrow.borrowBook');
        $response->assertViewHas('user');
        $this->assertDatabaseHas('borrowhistory', [
            'user_id' => 999999,
            'material_no' => 999999,
            'status'=> 1,
        ]);
    }

    /**
     * Test Borrow Book Failure
     * @dataProvider invalidBorrowBookDataProvider
     * @return void
     */
    public function test_borrow_book_failure($user_id, $material_no){
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $user = User::factory(User::class)->create(
            ['user_id' => 999999]
        );

        // route to Borrow Book
        $response = $this->actingAs($user)->from(route('borrow_book'))
                    ->post(route('borrow_book_submit', [
                        'user_id' => $user_id, 'material_no' => $material_no,
                    ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('borrow_book'));
        $response->assertSessionHasErrors();
    }

    
    public function invalidBorrowBookDataProvider()
    {
        return array(
            array(0, 999999),
            array('', 999999),
            array(999999, 0),
            array('999999', ''),
            array('', ''),
            array(0, 0),
        );
    }

    /**
     * Test Return Book Success
     * 
     * @return void
     */
    public function test_return_book(){

        $user = User::factory(User::class)->create(
            ['user_id' => 999999]
        );
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $this->seed(BorrowHistoryTableSeeder::class);

        // route to Get Material Info Call
        $response = $this->actingAs($user)->from(route('return_book'))
                    ->post(route('return_book_submit', ['material_no' => 999999]));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_book'));
        $this->assertDatabaseHas('borrowhistory', [
            'user_id' => 999999,
            'material_no' => 999999,
            'status'=> 2,
        ]);
    }

    /**
     * Test Return Book Failure
     * @dataProvider invalidReturnBookDataProvider
     * @return void
     */
    public function test_return_book_failure($material_no){

        $user = User::factory(User::class)->create(
            ['user_id' => 999999]
        );
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $this->seed(BorrowHistoryTableSeeder::class);

        // route to Get Material Info Call
        $response = $this->actingAs($user)->from(route('return_book'))
                    ->post(route('return_book_submit', ['material_no' => $material_no]));

        $response->assertStatus(302);
        $response->assertRedirect(route('return_book'));
        $response->assertSessionHasErrors();
        $this->assertDatabaseHas('borrowhistory', [
            'user_id' => 999999,
            'material_no' => 999999,
            'status'=> 1,
        ]);
    }

    public function invalidReturnBookDataProvider()
    {
        return array(
            array(''),
            array(0),
        );
    }

    
    // php artisan test --filter BorrowBookTest
}
