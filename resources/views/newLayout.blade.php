<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">

    <nav class="flex justify-around py-6">
        <div class="flex gap-8">
            <a href="#"
                class="font-bold hover:text-accent text-lg hover:border-accent hover:border-b-2 pb-2">Home</a>
            <a href="#"
                class="font-bold hover:text-accent text-lg hover:border-accent hover:border-b-2 pb-2">Vehicles</a>
            <a href="#" class="font-bold hover:text-accent text-lg hover:border-accent hover:border-b-2 pb-2">About
                Us</a>
            <a href="#"
                class="font-bold hover:text-accent text-lg hover:border-accent hover:border-b-2 pb-2">Contact
                Us</a>
        </div>
    </nav>

    <div class="bg-[url()]">

    </div>


    @fluxScripts
</body>

</html>
