<?php

namespace Tests\Feature;

use App\Events\SendMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class TestEventSendMessage extends TestCase
{

    public function test_if_event_send_message_is_dispached()
    {
        $user = User::factory()->create();
        Event::fake();

        event(new SendMessage($user['id'],'Hola mundo'));

        Event::assertDispatched(SendMessage::class);
    }

    public function test_if_event_send_message_is_not_dispached()
    {
        Event::fake();

        Event::assertNotDispatched(SendMessage::class);
    }
}
