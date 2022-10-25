<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use BookTableSeeder;
use MaterialTableSeeder;

class ManageMaterialTest extends TestCase
{
    use DatabaseTransactions;
    // php artisan test --filter ManageMaterialTest

    /**
     * Test Add Material View
     * 
     * @return void
     */
    public function test_add_material_view(){

        $this->seed(BookTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Add Book View
        $response = $this->actingAs($user)->from(route('manage_book_details', ['ISBN' => '1234567891011']))
                    ->get(route('add_material', ['ISBN' => '1234567891011']));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.catalog.addMaterial');
        $response->assertViewHas('book');
    }

    /**
     * Test Material Validation Failure
     * @dataProvider invalidMaterialDataProvider
     * SHK
     * @return void
     */
    public function test_material_validation_failure($ISBN, $call_no, $status, $intake_date){
        $this->seed(BookTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to add book function
        $response = $this->actingAs($user)->from(route('add_material', ['ISBN' => '1234567891011']))
                        ->post(route('add_material_submit'), [
            'ISBN'=> $ISBN,
            'call_no'=> $call_no,
            'status' => $status,
            'intake_date'=> $intake_date,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('add_material', ['ISBN' => '1234567891011']));
        $response->assertSessionHasErrors();
    }

    public function invalidMaterialDataProvider()
    {
        return array(
            array('', 'TestCallNo', '1', date('Y-m-d')),
            array('123456789101', 'TestCallNo', '1', date('Y-m-d')),
            array('12345678910111', 'TestCallNo', '1', date('Y-m-d')),
            array('1234567891011', 'TestCallNo', '0', date('Y-m-d')),
            array('1234567891011', 'TestCallNo', '5', date('Y-m-d')),
            array('1234567891011', 'TestCallNo', '1', date('Y-m-d', strtotime("+1 days"))),
        );
    }

    /**
     * Test Add Material Validation Success
     * @dataProvider validMaterialDataProvider
     * SHK
     * @return void
     */
    public function test_add_material($ISBN, $call_no, $status, $intake_date){
        $this->seed(BookTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to add book function
        $response = $this->actingAs($user)->from(route('add_material', ['ISBN' => '1234567891011']))
                        ->post(route('add_material_submit'), [
            'ISBN'=> $ISBN,
            'call_no'=> $call_no,
            'status' => $status,
            'intake_date'=> $intake_date,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_book_details', ['ISBN' => '1234567891011']));

        $this->assertDatabaseHas('materials', [
            'ISBN'=> $ISBN,
            'call_no'=> $call_no,
            'status' => $status,
            'created_at'=> $intake_date,
        ]);
    }

    /**
     * Test Edit Material View
     * 
     * @return void
     */
    public function test_edit_material_view(){

        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Add Book View
        $response = $this->actingAs($user)->from(route('manage_book_details', ['ISBN' => '1234567891011']))
                    ->get(route('edit_material', ['material_no' => 999999]));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.catalog.editMaterial');
        $response->assertViewHasAll(['book', 'material']);
    }

    /**
     * Test Edit Material Success
     * @dataProvider validMaterialDataProvider
     * SHK
     * @return void
     */
    public function test_edit_material($ISBN, $call_no, $status, $intake_date){
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to add book function
        $response = $this->actingAs($user)->from(route('edit_material', ['material_no' => 999999]))
                        ->post(route('edit_material_submit'), [
            'material_no' => 999999,
            'call_no'=> $call_no,
            'status' => $status,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_book_details', ['ISBN' => '1234567891011']));

        $this->assertDatabaseHas('materials', [
            'material_no'=> 999999,
            'call_no'=> $call_no,
            'status' => $status,
        ]);
    }

    public function validMaterialDataProvider()
    {
        return array(
            array('1234567891011', 'TestCallNo1', 1, date('Y-m-d')),
            array('1234567891011', 'TestCallNo2', 2, date('Y-m-d')),
            array('1234567891011', 'TestCallNo3', 3, date('Y-m-d')),
            array('1234567891011', 'TestCallNo4', 4, date('Y-m-d')),
            array('1234567891011', 'TestCallNo5', 1, date('Y-m-d', strtotime("-1 days"))),
        );
    }

    /**
     * Test Delete Material Success
     * 
     * SHK
     * @return void
     */
    public function test_delete_material(){
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to delete book function
        $response = $this->actingAs($user)->from(route('manage_book_details', ['ISBN' => '1234567891011']))
                        ->get(route('remove_material', ['material_no'=>999999]));

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_book_details', ['ISBN' => '1234567891011']));
    }

    /**
     * Test Delete Material Fail
     * 
     * SHK
     * @return void
     */
    public function test_delete_book_fail(){
        $this->seed(BookTableSeeder::class);
        $this->seed(MaterialTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to delete book function
        $response = $this->actingAs($user)->from(route('manage_book_details', ['ISBN' => '1234567891011']))
                        ->get(route('remove_material', ['material_no'=>999999]));

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_book_details', ['ISBN' => '1234567891011']));
    }

}
