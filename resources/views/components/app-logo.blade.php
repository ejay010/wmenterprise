@props([
    'sidebar' => false,
])

@if ($sidebar)
    <flux:sidebar.brand name="W Major Enterprises" {{ $attributes }}>
        <x-slot name="logo"
            class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo" class="h-8 w-8" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="W Major Enterprises" {{ $attributes }}>
        <x-slot name="logo"
            class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo" class="h-8 w-8" />
        </x-slot>
    </flux:brand>
@endif
