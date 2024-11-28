<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="img/logo01.ico">
    <link rel="preconnect" href="https://fonts.bunny.net">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
    <x-mary-nav sticky full-width>
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="mr-3 lg:hidden">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            {{-- Brand --}}
            <img src="{{ asset('img/logo01.png') }}" alt='Infinity.ut' class='w-auto h-10'>

        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-theme-toggle darkTheme="dark" lightTheme="light" />
            <x-mary-button label="Messages" icon="o-envelope" link="#" class="btn-ghost btn-sm" responsive />
            <x-mary-dropdown>
                <x-slot:trigger>
                    <x-mary-button icon="o-user" class="relative btn-circle" responsive no-wire-navigate />
                </x-slot:trigger>
                <x-mary-menu-item icon="o-user" title="Perfil" :href="route('profile.edit')"/>
                @if ($user = auth()->user())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-mary-menu-item icon="o-power" title="Cerrar" :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();" />
                </form>
                @endif
            </x-mary-dropdown>
        </x-slot:actions>
    </x-mary-nav>
    <x-mary-main with-nav full-width>
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100">
            <x-mary-menu activate-by-route>
                <x-mary-menu-item title="Tareas" icon="o-tag" link="{{ route('task.index') }}" />
            </x-mary-menu>
        </x-slot:sidebar>
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>
    <x-mary-toast />
    <x-mary-spotlight />
</body>

</html>