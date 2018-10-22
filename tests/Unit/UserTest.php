<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    /**
     * @test
     */
    public function can_create_user(){
        factory(User::class)->create();
        $this->assertCount(2,User::all());
    }


    /**
     * @test
     */
    public function can_remove_user(){
        $user = factory(User::class)->create();
        $id = $user->id;
        $user->delete();
        $this->assertNull(User::find($id));
    }

    /**
     * @test
     */
    public function instance_of_Collection(){
        $users = factory(User::class, 5)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $users);
    }
}
