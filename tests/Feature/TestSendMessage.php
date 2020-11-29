<?php

namespace Tests\Feature;

use App\Http\Livewire\MessageInput;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TestSendMessage extends TestCase
{

    public function test_if_message_sent()
    {
        $user_recive = User::factory()->create();
        $user_sent = User::factory()->create();

        $this->actingAs($user_sent);

        Livewire::test(MessageInput::class,['userChatId' => $user_recive['id']])
        ->set('text','Test send message')
        ->call('sendMessage');

        $this->assertTrue(Messages::where('message','Test send message')->where('user_id',$user_sent['id'])->exists());
    }

    public function test_if_text_is_required(){
        $user_recive = User::factory()->create();
        $user_sent = User::factory()->create();

        $this->actingAs($user_sent);

        Livewire::test(MessageInput::class,['userChatId' => $user_recive['id']])
        ->set('text','')
        ->call('sendMessage')
        ->assertHasErrors(['text' => 'required']);
    }

    public function test_if_text_has_min_two_characters(){
        $user_recive = User::factory()->create();
        $user_sent = User::factory()->create();

        $this->actingAs($user_sent);

        Livewire::test(MessageInput::class,['userChatId' => $user_recive['id']])
        ->set('text','t')
        ->call('sendMessage')
        ->assertHasErrors(['text' => 'min']);
    }

    public function test_if_livewire_event_is_emmited(){
        $user_recive = User::factory()->create();
        $user_sent = User::factory()->create();

        $this->actingAs($user_sent);

        Livewire::test(MessageInput::class,['userChatId' => $user_recive['id']])
        ->set('text','Test sen message')
        ->call('sendMessage')
        ->assertEmitted('messageSent');
    }
}
