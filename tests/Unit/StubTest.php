<?php

namespace Tests\Unit;

use App\Blog;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StubTest extends TestCase
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

    public function testStub(){
        // it has to be a existing class
        $stub = $this->createMock(Blog::class);
        // it has to be a existing method
        // you can decide how it would behave
        $stub->method('like')
            ->willReturn('foo');
        // it proves that it would behave the way we wish
        $this->assertSame('foo', $stub->like());
    }

    public function testReturnArgumentStub(){
        $stub = $this->createMock(Blog::class);
        $stub->method('like')
            ->will($this->returnArgument(0));
        $this->assertSame('foo', $stub->like('foo'));
        $this->assertSame('bar', $stub->like('bar'));
    }

    public function testReturnValueStub(){
        $stub = $this->createMock(Blog::class);
        $stub->method('like')
            ->will($this->returnValue('bar'));
        $this->assertSame('bar', $stub->like('foo'));
        $this->assertSame('bar', $stub->like('bar'));
    }

    /**
     * @test
     */
    public function it_throws_exception(){
        $stub = $this->createMock(Blog::class);
        $stub->method('like')
            ->will($this->throwException(new \Exception()));
        $this->expectException('Exception');
        $stub->like();
    }


}


