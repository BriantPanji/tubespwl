<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5.0.27/dark.min.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // Tambahkan custom magic method sebelum Alpine.start
        document.addEventListener('alpine:init', () => {
            Alpine.magic('clipboard', () => {
                return subject => navigator.clipboard.writeText(subject)
            })
        })
    </script>

    <title>{{ $title }}</title>
</head>

<body x-init="console.log('ALPINEJS INITIALIZE')" class="min-w-full max-w-full min-h-screen w-full h-full bg-sl-base text-sl-text">
    <x-header></x-header>
    <main
        class="px-5 pt-1 pb-7 min-w-full max-w-full min-h-screen w-full h-auto bg-sl-base text-sl-text xs:px-12 sm:px-22 md:px-34 lg:px-64 xl:px-90 2xl:px-110 flex flex-col gap-y-3">
        {{ $slot }}
    </main>
    <x-footer></x-footer>
    <script src="{{ asset('js/swaldef.js') }}" defer></script>
</body>

</html>
