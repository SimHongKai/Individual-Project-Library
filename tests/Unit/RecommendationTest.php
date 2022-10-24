<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RecommendationTest extends TestCase
{
    // use test database to test these
    use DatabaseTransactions;

    /**
     * Test Get Borrowed User ID function
     * 
     * @return void
     */
    public function test_get_borrowed_user_id(){
        
        $testController = new \App\Http\Controllers\RecommendationController;
        $response = $testController->getBorrowedUserIDs('1234523876954', 50, 0);

        $this->assertNotNull($response);
    }

    /**
     * Test Get Borrowed User ID function when insufficient data and returns null
     * 
     * @return void
     */
    public function test_get_borrowed_user_id_null(){
        
        $testController = new \App\Http\Controllers\RecommendationController;
        $response = $testController->getBorrowedUserIDs('1234523876954', 50, 10);

        $this->assertNull($response);
    }

    /**
     * Test Get Borrowed ISBN function
     * 
     * @return void
     */
    public function test_get_borrowed_ISBN(){
        
        $testController = new \App\Http\Controllers\RecommendationController;
        $response = $testController->getBorrowedISBNs([1], 10);

        $this->assertNotNull($response);
    }

    /**
     * Test Get Recommendations ISBN function
     * 
     * @return void
     */
    public function test_get_recommendation_ISBN(){
        
        $testController = new \App\Http\Controllers\RecommendationController;
        $response = $testController->getRecommendationsISBN('1234523876954');

        $this->assertNotNull($response);
    }

    /**
     * Test Get Similar User ID function
     * 
     * @return void
     */
    public function test_get_similar_user_id(){
        
        $testController = new \App\Http\Controllers\RecommendationController;
        $response = $testController->getSimilarUserIds(1);

        $this->assertNotNull($response);
    }
    
    /**
     * Test Get Similar ISBN function
     * 
     * @return void
     */
    public function test_get_similar_ISBN(){
        
        $testController = new \App\Http\Controllers\RecommendationController;
        $response = $testController->getSimilarISBNs(1);

        $this->assertNotNull($response);
    }
}
