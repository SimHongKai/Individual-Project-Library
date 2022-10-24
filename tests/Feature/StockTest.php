<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Stock;
use StockTableSeeder;

class StockTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test Get Stock on Success
     * SHK
     * @return void
     */
    public function test_get_stock(){
        // seed Stock Table
        $this->seed(StockTableSeeder::class);

        // route to getStock function
        $response = $this->post('/addStocks/get-stock', [
            'ISBN13' => 'testISBN12345',
        ]);
        
        $response->assertStatus(200); 
        $this->assertTrue($response['ISBN13'] != 1);
    }

    /**
     * Test Get Stock on Fail
     * SHK
     * @return void
     */
    public function test_get_stock_fail(){

        // route to getStock function
        $response = $this->post('/addStocks/get-stock', [
            'ISBN13' => 'failISBNtest1'
        ]);

        $response->assertStatus(200); 
    }
}
