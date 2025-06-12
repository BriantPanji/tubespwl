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

<body x-init="console.log('ALPINEJS INITIALIZE')"
    class="min-w-full max-w-full min-h-screen w-full h-full bg-sl-base text-sl-text relative">
    @if ($errors->has('banned'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `{{ $errors->first('banned') }}`,
            })
        </script>
    @endif
    <x-header></x-header>
    <div class="flex w-full min-h-screen justify-center">
        <aside class="w-1/5 h-screen bg-sl-base fixed border-r-hairline border-r-gray-500/20 p-4 left-0 z-1">
            <a href="/" class="flex items-center gap-3 p-2 rounded hover:bg-gray-500/50 mb-4">
                <i class="fa-light fa-house text-lg w-5 h-5"></i>
                <span class="font-medium">Beranda</span>
            </a>

            <a href="/profile" class="flex items-center gap-3 p-2 rounded hover:bg-gray-500/20 mb-4">
                <i class="fa-light fa-user text-lg w-5 h-5"></i>
                <span class="font-medium">Profil</span>
            </a>

            <a href="/my/post" class="flex items-center gap-3 p-2 rounded hover:bg-gray-500/20 mb-4">
                <i class="fa-light fa-rectangle-history text-lg w-5 h-5"></i>
                <span class="font-medium">Postingan Saya</span>
            </a>

            <a href="/my/comments" class="flex items-center gap-3 p-2 rounded hover:bg-gray-500/20 mb-4">
                <i class="fa-light fa-comments text-lg w-5 h-5"></i>
                <span class="font-medium">Komentar Saya</span>
            </a>

            <a href="/my/votes" class="relative flex items-center gap-3 p-2 rounded hover:bg-gray-500/20 mb-4">
                <i class="fa-light fa-up text-lg w-5 h-5"></i>
                <span class="font-medium">Votingan Saya</span>
            </a>

            <a href="/my/bookmarks" class="flex items-center gap-3 p-2 rounded hover:bg-gray-500/20 mb-4">
                <i class="fa-light fa-bookmark text-lg w-5 h-5"></i>
                <span class="font-medium">Tersimpan</span>
            </a>

            <form action="{{ route('logout') }}" method="POST">
            @csrf
                <button
                    type="submit"
                    class="flex items-center gap-3 p-2 rounded hover:bg-red-800 mb-4 w-full">
                    <i class="fa-light fa-arrow-right-from-bracket text-lg w-5 h-5"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </aside>

        <main class="w-1/2 px-6 py-4 bg-sl-base text-sl-text flex flex-col gap-y-3">
            {{ $slot }}
        </main>

        <aside class="w-1/5 bg-sl-tertiary p-4 fixed right-0">
            <h2 class="text-lg font-bold mb-4">Info Tambahan</h2>
            <ul class="space-y-2">
                <li><a href="#" class="hover:underline">asd</a></li>
                <li><a href="#" class="hover:underline">asd</a></li>
                <li><a href="#" class="hover:underline">asd</a></li>
            </ul>
        </aside>
    </div>
    <x-footer></x-footer>
    <script src="{{ asset('js/swaldef.js') }}" defer></script>
</body>

</html>