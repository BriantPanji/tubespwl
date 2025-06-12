{{-- Ini adalah kode yang belum menerapkan scroll alpine --}}
{{-- <!DOCTYPE html>
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
    class="min-w-full max-w-full min-h-screen w-full h-full bg-sl-base text-sl-text">
    @if ($errors->has('banned'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: {{ $errors->first('banned') }},
            })
        </script>
    @endif
    <x-header></x-header>
    <div class="flex w-full min-h-screen justify-center">
        <aside class="w-1/5 bg-sl-tertiary p-4 fixed left-0">
            <h2 class="text-lg font-bold mb-4">Menu</h2>
            <ul class="space-y-2">
                <li><a href="#" class="hover:underline">Beranda</a></li>
                <li><a href="#" class="hover:underline">Profil</a></li>
                <li><a href="#" class="hover:underline">Pengaturan</a></li>
            </ul>
        </aside>

        <main class="w-1/2 px-6 py-4 bg-sl-base text-sl-text flex flex-col gap-y-3">
            {{ $slot }}
        </main>

        <aside class="w-1/5 bg-sl-tertiary h-[100vh] fixed right-0 p-4">
            <h2 class="text-lg font-medium mb-4">Postingan Populer</h2>
            <div class="flex flex-col gap-3 divide-neutral-50/10 divide-y-[1px]">
                <div class="flex justify-between pb-3">
                    <div class="">
                        <h1 class="font-bold text-sm">Judul Postingan</h1>
                        <p class="text-xs opacity-50 line-clamp-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, accusamus dolor facilis placeat debitis, possimus sapiente voluptas doloribus vel nam sit nostrum quasi magni porro minus amet, voluptate totam dolorum non assumenda! Laudantium obcaecati quibusdam vitae assumenda magnam culpa unde nemo fuga? Eius nesciunt non dicta error qui dolorem quo.</p>
                    </div>
                    <img class="object-cover rounded-sm" src="{{ asset('storage/avatars/blankprofile.png') }}" width="50" alt="">
                </div>
                <div class="flex justify-between pb-3">
                    <div class="">
                        <h1 class="font-bold text-sm">Judul Postingan</h1>
                        <p class="text-xs opacity-50 line-clamp-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, accusamus dolor facilis placeat debitis, possimus sapiente voluptas doloribus vel nam sit nostrum quasi magni porro minus amet, voluptate totam dolorum non assumenda! Laudantium obcaecati quibusdam vitae assumenda magnam culpa unde nemo fuga? Eius nesciunt non dicta error qui dolorem quo.</p>
                    </div>
                    <img class="object-cover rounded-sm" src="{{ asset('storage/avatars/blankprofile.png') }}" width="50" alt="">
                </div>
                <div class="flex justify-between pb-3">
                    <div class="">
                        <h1 class="font-bold text-sm">Judul Postingan</h1>
                        <p class="text-xs opacity-50 line-clamp-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, accusamus dolor facilis placeat debitis, possimus sapiente voluptas doloribus vel nam sit nostrum quasi magni porro minus amet, voluptate totam dolorum non assumenda! Laudantium obcaecati quibusdam vitae assumenda magnam culpa unde nemo fuga? Eius nesciunt non dicta error qui dolorem quo.</p>
                    </div>
                    <img class="object-cover rounded-sm" src="{{ asset('storage/avatars/blankprofile.png') }}" width="50" alt="">
                </div>
                <div class="flex justify-between pb-3">
                    <div class="">
                        <h1 class="font-bold text-sm">Judul Postingan</h1>
                        <p class="text-xs opacity-50 line-clamp-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, accusamus dolor facilis placeat debitis, possimus sapiente voluptas doloribus vel nam sit nostrum quasi magni porro minus amet, voluptate totam dolorum non assumenda! Laudantium obcaecati quibusdam vitae assumenda magnam culpa unde nemo fuga? Eius nesciunt non dicta error qui dolorem quo.</p>
                    </div>
                    <img class="object-cover rounded-sm" src="{{ asset('storage/avatars/blankprofile.png') }}" width="50" alt="">
                </div>
                <div class="flex justify-between pb-3">
                    <div class="">
                        <h1 class="font-bold text-sm">Judul Postingan</h1>
                        <p class="text-xs opacity-50 line-clamp-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, accusamus dolor facilis placeat debitis, possimus sapiente voluptas doloribus vel nam sit nostrum quasi magni porro minus amet, voluptate totam dolorum non assumenda! Laudantium obcaecati quibusdam vitae assumenda magnam culpa unde nemo fuga? Eius nesciunt non dicta error qui dolorem quo.</p>
                    </div>
                    <img class="object-cover rounded-sm" src="{{ asset('storage/avatars/blankprofile.png') }}" width="50" alt="">
                </div>
                <div class="flex justify-between pb-3">
                    <div class="">
                        <h1 class="font-bold text-sm">Judul Postingan</h1>
                        <p class="text-xs opacity-50 line-clamp-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, accusamus dolor facilis placeat debitis, possimus sapiente voluptas doloribus vel nam sit nostrum quasi magni porro minus amet, voluptate totam dolorum non assumenda! Laudantium obcaecati quibusdam vitae assumenda magnam culpa unde nemo fuga? Eius nesciunt non dicta error qui dolorem quo.</p>
                    </div>
                    <img class="object-cover rounded-sm" src="{{ asset('storage/avatars/blankprofile.png') }}" width="50" alt="">
                </div>

            </div>
        </aside>
    </div>
    <x-footer></x-footer>
    <script src="{{ asset('js/swaldef.js') }}" defer></script>
</body>

</html> --}}

{{-- Ini adalah kode yang telah menerapkan scroll alpine --}}
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

<body
    x-data="{ hideHeader: false, lastScrollTop: 0 }"
    x-init="
        lastScrollTop = window.scrollY;
        window.addEventListener('scroll', () => {
            let currentScroll = window.scrollY;
            // Tampilkan header jika scroll ke atas, sembunyikan jika scroll ke bawah & sudah melewati tinggi header
            hideHeader = currentScroll > lastScrollTop && currentScroll > 80; // 80 adalah contoh tinggi header
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        })
    "
    class="min-w-full max-w-full min-h-screen w-full h-full bg-sl-base text-sl-text">

    @if ($errors->has('banned'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: {{ $errors->first('banned') }},
            })
        </script>
    @endif

    {{-- Header dengan class dinamis dari AlpineJS --}}
    <div
        :class="hideHeader ? '-top-24' : 'top-0'"
        class="fixed w-full z-20 transition-all duration-300"
        style="transition-property: top;"
    >
        <x-header></x-header> {{-- Asumsikan tinggi header adalah 24 (h-24) atau sekitar 96px --}}
    </div>


    <div class="flex w-full min-h-screen justify-center pt-24"> {{-- Tambahkan padding top seukuran header --}}
        <aside class="w-1/5 bg-sl-tertiary p-4 fixed left-0 top-24"> {{-- Beri top seukuran header --}}
            <h2 class="text-lg font-bold mb-4">Menu</h2>
            <ul class="space-y-2">
                <li><a href="#" class="hover:underline">Beranda</a></li>
                <li><a href="#" class="hover:underline">Profil</a></li>
                <li><a href="#" class="hover:underline">Pengaturan</a></li>
            </ul>
        </aside>

        <main class="w-1/2 px-6 py-4 bg-sl-base text-sl-text flex flex-col gap-y-3">
            {{ $slot }}
        </main>

        {{-- Aside "Postingan Populer" dengan class & style dinamis --}}
        <aside
            :class="hideHeader ? 'top-0 h-screen' : 'top-24 h-[calc(100vh-6rem)]'"
            class="w-1/5 bg-sl-tertiary fixed right-0 p-4 transition-all duration-300"
            style="transition-property: top, height;"
        >
            <h2 class="text-lg font-medium mb-4">Postingan Populer</h2>
            <div class="flex flex-col gap-3 divide-neutral-50/10 divide-y-[1px] overflow-y-auto h-full">
                {{-- Konten postingan populer Anda ... --}}
                <div class="flex justify-between pb-3">
                    <div class="">
                        <h1 class="font-bold text-sm">Judul Postingan</h1>
                        <p class="text-xs opacity-50 line-clamp-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, accusamus dolor facilis placeat debitis, possimus sapiente voluptas doloribus vel nam sit nostrum quasi magni porro minus amet, voluptate totam dolorum non assumenda! Laudantium obcaecati quibusdam vitae assumenda magnam culpa unde nemo fuga? Eius nesciunt non dicta error qui dolorem quo.</p>
                    </div>
                    <img class="object-cover rounded-sm" src="{{ asset('storage/avatars/blankprofile.png') }}" width="50" alt="">
                </div>
                 {{-- Ulangi untuk postingan lain --}}
            </div>
        </aside>
    </div>

    <x-footer></x-footer>
    <script src="{{ asset('js/swaldef.js') }}" defer></script>
</body>

</html>
