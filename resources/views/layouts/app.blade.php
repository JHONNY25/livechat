<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-900 flex justify-center items-center">
            <!-- Page Content -->
            <main class="min-w-full">
                <div class="md:w-full lg:w-9/12 mx-auto my-auto">
                    <div class="overflow-hidden shadow-xl">
                        <div class="grid grid-cols-3 min-w-full min-h-8/9">
                            <div class="col-span-1 bg-gray-800">
                                @livewire('navigation-dropdown')

                                @livewire('search-input')

                                <h2 class="text-base text-white font-bold ml-3 mt-2">Chats</h2>
                                @livewire('user-chat')
                            </div>
                            <div class="col-span-2 bg-gray-700">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')
    </body>
</html>
