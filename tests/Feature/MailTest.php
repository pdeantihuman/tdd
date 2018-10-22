<?php
namespace Tests\Feature;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailTest extends TestCase
{
//    public function setUp()
//    {
//        parent::setUp();
//        Mail::getSwiftMailer()
//            ->registerPlugin(new TestingMailEventListener);
//    }

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
    public function it_send_email(){
        Mail::fake();
        Mail::to('bar@foo.com')->send(new OrderShipped());
        Mail::assertSent(OrderShipped::class,function($mail){
            return $mail->hasTo('bar@foo.com');
        });
    }
}


//class TestingMailEventListener implements \Swift_Events_EventListener {
//    public function beforeSendPerformed($event){
//        $message = $event->getMessage();
//        dd($message);
//    }
//}
