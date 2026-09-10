<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header sticky container
        class="top-0 z-50 border-b border-zinc-100 bg-white/95 shadow-xs backdrop-blur-md mx-auto px-4 sm:px-6 lg:px-8 h-20">
        <flux:brand href="{{ route('home') }}" logo="{{ Vite::asset('resources/images/logo.png') }}"
            name="W Major Enterprises" wire:navigate class="text-accent" />

        <flux:spacer />

        <flux:navbar class="items-center space-x-3">
            <flux:navbar.item :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                {{ __('Home') }}
            </flux:navbar.item>
            <flux:navbar.item :href="route('catalog')" :current="request()->routeIs('catalog')" wire:navigate>
                {{ __('Vehicles') }}
            </flux:navbar.item>
            <flux:navbar.item wire:navigate>
                {{ __('About Us') }}
            </flux:navbar.item>
            <flux:navbar.item wire:navigate>
                {{ __('Contact') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />


        <flux:sidebar.toggle class="lg:hidden mt-2" icon="bars-2" inset="left" />


        <flux:navbar class="me-1.5 max-lg:hidden mt-2 space-x-0.5 rtl:space-x-reverse py-0!">
            @auth
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                <flux:tooltip :content="__('Settings')" position="bottom">
                    <flux:navbar.item icon="cog" :href="route('profile.edit')"
                        :current="request()->routeIs('profile.edit')" wire:navigate>
                        {{ __('Settings') }}
                    </flux:navbar.item>
                </flux:tooltip>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:tooltip :content="__('Log out')" position="bottom">
                        <flux:navbar.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer" data-test="logout-button">
                            {{ __('Log out') }}
                        </flux:navbar.item>
                    </flux:tooltip>
                </form>
            @else
                <flux:tooltip :content="__('Log in')" position="bottom">
                    <flux:navbar.item icon="arrow-right-end-on-rectangle" :href="route('login')" wire:navigate>
                        {{ __('Log in') }}
                    </flux:navbar.item>
                </flux:tooltip>
            @endauth
        </flux:navbar>

        <x-desktop-user-menu />
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar collapsible="mobile" sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:spacer />

    </flux:sidebar>

    {{ $slot }}

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>
