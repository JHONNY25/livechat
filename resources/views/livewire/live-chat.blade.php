<div class="w-full border-l border-gray-700">
    <div class="flex items-center bg-gray-700 py-3 ml-2">
        @if (isset($user))
            <img class="user-img" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
            <h3 class="user-name">{{ $user->name }}</h3>
        @else
            <img class="user-img"
            src="{{ $chat->userrecive->id == $userCurrent ? $chat->usersent->profile_photo_url : $chat->userrecive->profile_photo_url }}"
            alt="{{ $chat->userrecive->id == $userCurrent ? $chat->usersent->name  : $chat->userrecive->name }}" />
            <h3 class="user-name">{{ $chat->userrecive->id == $userCurrent ? $chat->usersent->name  : $chat->userrecive->name }}</h3>
        @endif
    </div>
    <div class="bg-gray-800 p-10" style="height: 750px;">
        @if (isset($user))
            <div class="w-full text-white text-3xl text-center">No existe una conversación</div>
        @else
            <ul>
                @foreach ($chat->messages as $message)
                    <li class="flex {{ $message->user_id == $userCurrent ? 'justify-end' : 'justify-start' }}">
                        <div class="bg-gray-700 p-3 rounded relative" style="max-height: 300px;">
                            <div class="text-white text-base">{{ $message->message }}</div>
                            @php
                                $date = new DateTime($message->send_date);
                            @endphp
                            <div class="text-white text-sm w-full {{ $message->user_id == $userCurrent ? 'text-right' : 'text-left' }}">{{ $date->format('H:i A') }}</div>

                            <div class="absolute top-0"
                            style="border-bottom: 15px solid transparent;
                            {{  $message->user_id == $userCurrent ?
                                'right: -25px;
                                border-right: 15px solid transparent;
                                border-left: 15px solid #374151;'
                                : 'left: -25px;
                                    border-right: 15px solid #374151;
                                    border-left: 15px solid transparent;'}}"></div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
            <div id="content-typing" class="w-full bg-gray-800 pl-5 pb-2 hidden">
                <div id="user-typing" class="text-white text-base"></div>
            </div>

    @livewire('message-input',['userChatId' => $userChatid])

</div>

@push('scripts')
<script>
    const userTyping = document.querySelector('#user-typing');
    const contentTyping = document.querySelector('#content-typing');
    const inputmessage = document.querySelector('#message');
    const chatid = {!! isset($user) ? $user->id : $chat->id !!};

    var pusher = new Pusher('fc00dee8592355c94c8d', {
    cluster: 'us2'
    });

    var channel = pusher.subscribe('livechat-channel');
    channel.bind('livechat-event', function(data) {
        window.Livewire.emit('reciveMessage');
    });

    inputmessage.addEventListener('keyup',(event) => {
        const chat = Echo.private(`chat.${chatid}`);

        setTimeout(() => {
            chat.whisper('typing', {
                user: {!! auth()->user() !!},
                typing: true,
                chatid: chatid
            });
        }, 300);
    });

    Echo.private(`chat.${chatid}`)
    .listenForWhisper('typing', (e) => {
        if(e.chatid === chatid){
            userTyping.innerHTML = `${e.user.name} esta escribiendo ...`;
            e.typing ? contentTyping.style.display = "block" : contentTyping.style.display = "none";

            setTimeout(() => {
                contentTyping.style.display = "none";
            }, 1000);
        }
    });

</script>
@endpush
