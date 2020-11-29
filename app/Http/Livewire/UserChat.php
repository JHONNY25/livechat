<?php

namespace App\Http\Livewire;

use App\Models\Chats;
use Livewire\Component;

class UserChat extends Component
{
    public $chat;
    public $usercurrent;

    protected $listeners = ['messageSent' => 'refresh'];

    public function mount(){
        $this->chat = new Chats();
        $this->usercurrent = auth()->user()->id;
    }

    public function refresh(){}

    public function render()
    {
        return view('livewire.user-chat',
                [
                    'chats' => $this->chat->with([
                        'usersent:id,name,profile_photo_path',
                        'userrecive:id,name,profile_photo_path',
                        'messages' => function($query){
                            $query->latest();
                        }
                    ])->where('user_sent',$this->usercurrent)
                    ->orWhere('user_recive',$this->usercurrent)
                    ->get()
                ]
            );
    }
}
