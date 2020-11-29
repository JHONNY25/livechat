<ul class="overflow-y-auto h-3/4">
    @php
        $today = Carbon\Carbon::now();
    @endphp
    @foreach ($chats as $chat)
        <li class="border-b border-gray-700 hover:bg-gray-700">
            <a href="{{ route('chat', ['id' => $chat->id]) }}" class="flex py-3 px-2">
                <img class="user-img"
                src="{{ $chat->userrecive->id == $usercurrent ? $chat->usersent->profile_photo_url : $chat->userrecive->profile_photo_url }}"
                alt="{{ $chat->userrecive->id == $usercurrent ? $chat->usersent->name  : $chat->userrecive->name}}" />
                <div class="w-full pl-2">
                    <div class="flex justify-between">
                        <h3 class="user-name">{{ $chat->userrecive->id == $usercurrent ?  $chat->usersent->name : $chat->userrecive->name }}</h3>
                        <span class="text-white text-sm">{{ 'Hace '.str_replace('después','',$today->diffForHumans($chat->messages[0]->send_date)) }}</span>
                    </div>
                    <div class="text-white text-sm ml-2">{{ $chat->messages[0]->message }}</div>
                </div>
            </a>
        </li>
    @endforeach
</ul>
