<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MockTest extends TestCase
{
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
     * @return void
     */
    public function test_something(){
        $directive = $this->prophesize(User::class);
        $directive->foo('bar')->shouldBeCalled()->willReturn('foobar');
        $response = $directive->reveal()->foo('bar');
        $this->assertEquals('foobar', $response);
    }
}

class User {
    public function foo(){

    }
}