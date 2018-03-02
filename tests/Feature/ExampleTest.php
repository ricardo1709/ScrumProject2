<?php

namespace Tests\Feature;

use Illuminate\Foundation\Auth\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = [];

        $response[0] = $this->get('/');
        $response[1] = $this->get('/home');

        $users = [];

        $users[0] = factory(\App\User::class)->create();


        $response[2] = $this->post(route('register'), [
            'name'=>$users[0]->name,
            'email'=>$users[0]->email,
            'password'=>$users[0]->password,
            'password-confirm'=>$users[0]->password,
        ]);
        //

        //\App\User::archives();

        //

        $response[0]->assertRedirect('/movies');
        $response[1]->assertRedirect('/login');
        $response[2]->assertRedirect('/home');
        //$response[2]->assertCookie('laravel_session');

    }
}
