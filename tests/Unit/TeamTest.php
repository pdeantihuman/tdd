<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Team;

class TeamTest extends TestCase
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
    public function a_team_has_name()
    {
        $team = new Team(['name' => 'Acme']);
        $this->assertEquals($team->name, 'Acme');
    }

    /**
     * @test
     */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();
        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create();
        $team->add($user);
        $team->add($userTwo);
        $this->assertEquals($team->count(), 2);

    }

    /**
     * @test
     */
    public function it_has_a_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();
        $userThree = factory(User::class)->create();
        $team->add($userOne);
        $team->add($userTwo);
        $this->expectException('Exception');
        $team->add($userThree);

    }

    public function it_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create(['size' => 5]);
        $users = factory(User::class, 2)->create();
        $team->add($users);
        $this->assertEquals($team->count(), 2);
    }
}
