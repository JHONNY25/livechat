<?php

namespace App\Http\Livewire;

use App\Events\SendMessage;
use App\Models\Chats;
use App\Models\Messages;
use Carbon\Carbon;
use Livewire\Component;

class MessageInput extends Component
{
    public $text;
    public $userChatId;
    public $userCurrent;
    public $chat;

    protected $rules = [
        'text' => 'required|min:2'
    ];

    public function mount($userChatId){
        $this->text = '';
        $this->userChatId = $userChatId;
        $this->userCurrent = auth()->user()->id;
        if(Chats::where('user_recive',$this->userChatId)->orWhere('user_sent',$this->userChatId)->exists()){
                $this->chat = Chats::select('id')
                ->where('user_recive',$this->userChatId)
                ->orWhere('user_sent',$this->userChatId)
                ->first();
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendMessage(){

        $this->validate();
        
        if(!$this->chat){
            $this->chat = Chats::create([
                'user_sent' => $this->userCurrent,
                'user_recive' => $this->userChatId
            ]);
        }

        Messages::create([
            'chat_id' => $this->chat->id,
            'user_id' => $this->userCurrent,
            'message' => $this->text,
            'send_date' => Carbon::now()
        ]);

        $this->emit('messageSent');

        event(new SendMessage($this->userCurrent,$this->text));
    }

    public function render()
    {
        return view('livewire.message-input');
    }
}
