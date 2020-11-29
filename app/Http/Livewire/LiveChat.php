<?php

namespace App\Http\Livewire;

use App\Models\Chats;
use App\Models\User;
use Livewire\Component;

class LiveChat extends Component
{
    public $userChatid;
    public $userCurrent;

    protected $listeners = ['reciveMessage' => 'refresh'];

    public function mount($id){
        $this->userChatid = $id;
        $this->userCurrent = auth()->user()->id;
    }

    public function refresh(){}

    public function render()
    {
        if(Chats::where('user_recive',$this->userChatid)->orWhere('user_sent',$this->userChatid)->exists()){
            return view('livewire.live-chat',[
                'chat' => Chats::with([
                    'usersent:id,name,profile_photo_path',
                    'userrecive:id,name,profile_photo_path',
                    'messages'
                ])
                ->where('user_recive',$this->userChatid)
                ->orWhere('user_sent',$this->userChatid)
                ->first()
            ]);
        }else{
            return view('livewire.live-chat',[
                'user' => User::find($this->userChatid)
            ]);
        }
    }
}
