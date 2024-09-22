<?php

namespace Tests\Unit;

use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscribeUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a subscriber can be created.
     *
     * @return void
     */
    public function test_subscriber_can_be_created()
    {
        $subscriberData = [
            'email' => 'johndoe@example.com',
        ];

        $subscriber = Subscriber::create($subscriberData);

        $this->assertDatabaseHas('subscribers', [
            'email' => 'johndoe@example.com'
        ]);

        $this->assertEquals('johndoe@example.com', $subscriber->email);
    }

    /**
     * Test a subscriber cannot be created with invalid data.
     *
     * @return void
     */
    public function test_subscriber_creation_fails_with_invalid_email()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Subscriber::create([
            'email' => 'not-an-email',
        ]);
    }
}
