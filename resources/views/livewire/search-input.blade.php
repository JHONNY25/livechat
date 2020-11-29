<div class="border-b border-gray-700">
    <div class="mx-3 my-3">
        <div class="relative text-gray-200 focus-within:text-gray-500">
            <span class="absolute inset-y-1 left-0 ml-3 flex items-center">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input wire:model.debounce.500ms="search" type="search" class="input-rounded pl-10 focus:outline-none focus:bg-white " placeholder="Busca a tus amigos..">
        </div>
    </div>
    <div wire:loading class="text-base text-white font-bold text-center w-full mb-3">Buscando ...</div>
    @if (strlen($this->search) > 0)
        <h2 class="ml-3 text-base text-white font-bold">Usuarios</h2>
        @if (!empty($users))
            @foreach ($users as $user)
                <a href="{{ route('chat', ['id' => $user->id]) }}" class="flex py-3 px-2 hover:bg-gray-700">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                    <h3 class="text-white font-bold text-base ml-2">{{ $user->name }}</h3>
                </a>
            @endforeach
        @else
            <div class="text-base text-white font-bold text-center w-full mb-3">No hay usuarios con es nombre</div>
        @endif
    @endif
</div>
