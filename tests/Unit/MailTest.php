<?php

namespace Tests\Unit;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    /**
     * Test if the mail is sent correctly.
     *
     * @return void
     */
    public function test_mail_is_sent()
    {
        Mail::fake();

        Mail::to('test@example.com')->send(new TestMail());

        Mail::assertSent(TestMail::class, function ($mail) {
            return $mail->hasTo('test@example.com');
        });
    }

    public function test_real_mail_is_sent()
    {

        Mail::to('bugraskl@gmail.com')->send(new TestMail());

    }

}
