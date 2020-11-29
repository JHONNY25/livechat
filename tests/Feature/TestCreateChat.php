<?php

namespace Tests\Feature;

use App\Http\Livewire\MessageInput;
use App\Models\Chats;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TestCreateChat extends TestCase
{

    public function test_create_chat()
    {
        $user_recive = User::factory()->create();
        $user_sent = User::factory()->create();

        $this->actingAs($user_sent);

        Livewire::test(MessageInput::class,['userChatId' => $user_recive['id']])
        ->set('text','Test send message')
        ->call('sendMessage');

        $this->assertTrue(Chats::where('user_sent',$user_sent['id'])->where('user_recive',$user_recive['id'])->exists());
    }
}
