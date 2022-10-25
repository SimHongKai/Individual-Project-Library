<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use BookTableSeeder;

class ManageBookTest extends TestCase
{
    use DatabaseTransactions;
    // php artisan test --filter ManageBookTest

    /**
     * Test Manage Books View
     * 
     * @return void
     */
    public function test_manage_books_view(){

        $user = User::factory(User::class)->create();

        // route to Manage Books View
        $response = $this->actingAs($user)
                    ->get(route('manage_books'));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.catalog.books');
        $response->assertViewHas('books');
    }

    /**
     * Test Manage Book Details View
     * 
     * @return void
     */
    public function test_manage_book_details_view(){

        $this->seed(BookTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to Manage Book Details View
        $response = $this->actingAs($user)
                    ->get(route('manage_book_details', ['ISBN' => '1234567891011']));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.catalog.manageBookDetails');
        $response->assertViewHasAll(['book', 'materials']);
    }

    /**
     * Test Add Book View
     * 
     * @return void
     */
    public function test_add_book_view(){

        $user = User::factory(User::class)->create();

        // route to Add Book View
        $response = $this->actingAs($user)
                    ->get(route('add_book'));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.catalog.addBook');
    }

    /**
     * Test Book Validation Failure
     * @dataProvider invalidBookDataProvider
     * SHK
     * @return void
     */
    public function test_book_validation_failure($ISBN, $title, $description, $author, $publication, $publication_date,
                                                $price, $language, $access_level){

        $user = User::factory(User::class)->create();

        // route to add book function
        $response = $this->actingAs($user)->from(route('add_book'))
                        ->post(route('add_book_submit'), [
            'ISBN'=>$ISBN,
            'title'=>$title,
            'description' => $description,
            'author' => $author,
            'publication' => $publication,
            'publication_date'=> $publication_date,
            'price'=> $price,
            'language'=> $language,
            'access_level'=> $access_level,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('add_book'));
        $response->assertSessionHasErrors();
    }

    public function invalidBookDataProvider()
    {
        return array(
            array('', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date("Y-m-d"), 50, '(EN) English', 1),
            array('123456789101', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date("Y-m-d"), 50, '(EN) English', 1),
            array('12345678910111', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date("Y-m-d"), 50, '(EN) English', 1),
            array('1234567891011', '', 'TestDesc', 'TestAuthor', 'TestPublication', date("Y-m-d"), 50, '(EN) English', 1),
            array('1234567891011', 'TestTitle', '', 'TestAuthor', 'TestPublication', date("Y-m-d"), 50, '(EN) English', 1),
            array('1234567891011', 'TestTitle', 'TestDesc', '', 'TestPublication', date("Y-m-d"), 50, '(EN) English', 1),
            array('1234567891011', 'TestTitle', 'TestDesc', 'TestAuthor', '', date("Y-m-d"), 50, '(EN) English', 1),
            array('1234567891011', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date('Y-m-d', strtotime("+1 days")), 50, '(EN) English', 1),
            array('1234567891011', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date("Y-m-d"), -1, '(EN) English', 1),
            array('1234567891011', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date("Y-m-d"), 101, '(EN) English', 1),
            array('1234567891011', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date("Y-m-d"), 50, '', 0),
        );
    }

    /**
     * Test Add Book Success
     * @dataProvider validBookDataProvider
     * SHK
     * @return void
     */
    public function test_add_book($ISBN, $title, $description, $author, $publication, $publication_date,
                                                $price, $language, $access_level){

        $user = User::factory(User::class)->create();

        // route to edit book function
        $response = $this->actingAs($user)->from(route('add_book'))
                        ->post(route('add_book_submit'), [
            'ISBN'=>$ISBN,
            'title'=>$title,
            'description' => $description,
            'author' => $author,
            'publication' => $publication,
            'publication_date'=> $publication_date,
            'price'=> $price,
            'language'=> $language,
            'access_level'=> $access_level,
        ]);
        $this->assertDatabaseHas('books', [
            'ISBN'=>$ISBN,
            'title'=>$title,
            'description' => $description,
            'author' => $author,
            'publication' => $publication,
            'publication_date'=> $publication_date,
            'price'=> $price,
            'language'=> $language,
            'access_level'=> $access_level,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_book_details', ['ISBN' => '1234567891011']));
    }

    /**
     * Test Edit Book Success
     * @dataProvider validBookDataProvider
     * SHK
     * @return void
     */
    public function test_edit_book($ISBN, $title, $description, $author, $publication, $publication_date,
                                                $price, $language, $access_level){
        $this->seed(BookTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to edit book function
        $response = $this->actingAs($user)->from(route('edit_book', ['ISBN' => '1234567891011']))
                        ->post(route('edit_book_submit'), [
            'ISBN'=>$ISBN,
            'title'=>$title,
            'description' => $description,
            'author' => $author,
            'publication' => $publication,
            'publication_date'=> $publication_date,
            'price'=> $price,
            'language'=> $language,
            'access_level'=> $access_level,
        ]);
        $this->assertDatabaseHas('books', [
            'ISBN'=>$ISBN,
            'title'=>$title,
            'description' => $description,
            'author' => $author,
            'publication' => $publication,
            'publication_date'=> $publication_date,
            'price'=> $price,
            'language'=> $language,
            'access_level'=> $access_level,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_book_details', ['ISBN' => '1234567891011']));
    }

    public function validBookDataProvider()
    {
        return array(
            array('1234567891011', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date("Y-m-d"), 100, '(EN) English', 1),
            array('1234567891011', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date('Y-m-d', strtotime("-1 days")), 0, '(EN) English', 2),
            array('1234567891011', 'TestTitle', 'TestDesc', 'TestAuthor', 'TestPublication', date('Y-m-d'), 100, '(EN) English', 3),
        );
    }

    /**
     * Test Delete Book Success
     * 
     * SHK
     * @return void
     */
    public function test_delete_book(){
        $this->seed(BookTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to delete book function
        $response = $this->actingAs($user)->from(route('manage_book_details', ['ISBN' => '1234567891011']))
                        ->get(route('remove_book', ['ISBN'=>1234567891011]));

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_books'));
    }

    /**
     * Test Delete Book Fail
     * 
     * SHK
     * @return void
     */
    public function test_delete_book_fail(){
        $this->seed(BookTableSeeder::class);
        $user = User::factory(User::class)->create();

        // route to delete book function
        $response = $this->actingAs($user)->from(route('manage_book_details', ['ISBN' => '1234567891011']))
                        ->get(route('remove_book', ['ISBN'=>1234567891011]));

        $response->assertStatus(302);
        $response->assertRedirect(route('manage_books'));
    }

    /**
     * Test Search Manage Catalog View
     * 
     * @return void
     */
    public function test_search_catalogue_view(){
        $user = User::factory(User::class)->create();
        // route to Catalog Search Page
        $response = $this->actingAs($user)->get(route('admin_catalog_search'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.catalog.search');
    }

    /**
     * Test Search Manage Catalog Submit
     * 
     * @return void
     */
    public function test_search_catalogue(){
        $user = User::factory(User::class)->create();
        // route to Catalog Search Page
        $response = $this->actingAs($user)->get(route('admin_catalog_search_submit'));
        
        $response->assertStatus(200);

        $response->assertViewIs('admin.catalog.books');
        $response->assertViewHas('books');
    }
}
