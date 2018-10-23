<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikesTest extends TestCase
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
    public function it_can_like_a_post(){

        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $post->like();
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likable_id' => $post->id,
            'likable_type' => get_class($post)
        ]);
        $this->assertTrue($post->isLiked());
    }

    /**
     * @test
     */
    public function it_can_unlike_a_post(){
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $post->like();
        $post->unlike();
        $this->assertDatabaseMissing('likes',[
            'user_id' => $user->id,
            'likable_id' => $post->id,
            'likable_type' => get_class($post)
        ]);
        $this->assertFalse($post->isLiked());
    }

    /**
     * @test
     */
    public function it_can_toggle_a_post_like_status(){
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $post->toggle();
        $this->assertTrue($post->isLiked());
        $post->toggle();
        $this->assertFalse($post->isLiked());
    }

    /**
     * @test
     */
    public function it_know_how_many_likes_it_has(){
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $post->toggle();
        $this->assertEquals($post->likesCount(), 1);
    }
}
