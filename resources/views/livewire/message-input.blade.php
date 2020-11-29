<div class="w-full">
    @error('text') <span class="text-red-500 ml-2 -mt-2">{{ $message }}</span> @enderror
    <div class="w-full flex justify-between items-center bg-gray-700 py-3 px-2">
        <input id="message" wire:model="text" wire:keydown.enter="sendMessage" type="text" class="input-rounded pl-4 focus:outline-none focus:bg-white" placeholder="Escribe un mensaje aquí ...">
        @if (!empty($text))
            <button wire:click="sendMessage" class="ml-2 outline-none focus:outline-none">
                <svg class="text-gray-900 transform rotate-90 h-7 w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        @endif
    </div>
</div>
