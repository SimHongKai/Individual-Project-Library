<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use UsersTableSeeder;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Register View
     * 
     * @return void
     */
    public function test_register_view(){

        $user = User::factory(User::class)->create();

        // route to Register function
        $response = $this->actingAs($user)
                    ->get(route('register'));
        
        $response->assertStatus(200);

        $response->assertViewIs('auth.register');
    }


    /**
     * Test Register Success
     * @dataProvider validRegisterDataProvider
     * @return void
     */
    public function test_register($username, $email, $password, $privilege){
        
        $user = User::factory(User::class)->create();

        // route to Register function
        $response = $this->actingAs($user)->from('register')->post('/register', [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'password-confirm' => $password,
            'privilege' => $privilege
        ]);
        
        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'username' => $username,
            'email' => $email,
        ]);
    }


    public function validRegisterDataProvider()
    {
        return array(
            array("TestUsername", "Test1@gmail.com", "Hongkai934", 1),
            array("TestUsername", "Test2@gmail.com", "Hongkai934", 2),
            array("TestUsername", "Test3@gmail.com", "Hongkai934", 3),
        );
    }


    /**
     * Test Register Failure
     * @dataProvider invalidRegisterDataProvider
     * @return void
     */
    public function test_register_fail($username, $email, $password, $privilege){

        $user = User::factory(User::class)->create();
        
        // route to Register function
        $response = $this->actingAs($user)->from('register')->post('/register', [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'password-confirm' => $password,
            'privilege' => $privilege
        ]);
        
        $response->assertRedirect('register');
    }


    public function invalidRegisterDataProvider()
    {
        return array(
            array("", "", "", 0),
            array("TestUsername3", "NotGmail", "testPassword", 1),
            array("TestUsername1", "Test1@gmail.com", "Test123", 1),
            array("TestUsername2", "Test2@gmail.com", "testPassword", 4),
            array("TestUsername3", "Test3@gmail.com", "testPassword", 'Not Number'),
        );
    }


    /**
     * Test Login View
     * 
     * @return void
     */
    public function test_login_view(){

        // route to Login function
        $response = $this->get(route('login'));
        
        $response->assertStatus(200);

        $response->assertViewIs('auth.login');
    }


    /**
     * Test Login Success
     * 
     * @return void
     */
    public function test_login(){

        $this->seed(UsersTableSeeder::class);

        // route to Login function
        $response = $this->from('login')->post('/login', [
            'email' => "test@gmail.com",
            'password' => "TestPassword"
        ]);
        
        $response->assertStatus(302);

        $response->assertRedirect('home');
    }

    /**
     * Test Login Fail
     * @dataProvider invalidLoginDataProvider
     * @return void
     */
    public function test_login_fail($email, $password){

        $this->seed(UsersTableSeeder::class);

        // route to Login function
        $response = $this->from('login')->post('/login', [
            'email' => $email,
            'password' => $password
        ]);
        
        $response->assertStatus(302);

        $response->assertRedirect('login');
    }


    public function invalidLoginDataProvider()
    {
        return array(
            array("NotEmail", "TestPassword"),
            array("test@gmail.com", "NotPassword"),
            array("NotEmail", "NotPassword"),
            array("test@gmail.com", "Test123"),
        );
    }
}
