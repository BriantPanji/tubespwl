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
    

    @php
        $links = [
            ['url' => '/', 'label' => 'Home', 'icon' => 'fa-house'],
            ['url' => route('profile'), 'label' => 'Profile', 'icon' => 'fa-user'],
            ['url' => route('admin.index'), 'label' => 'Dashboard', 'icon' => 'fa-gauge'],
            ['url' => route('admin.post'), 'label' => 'Reported Post', 'icon' => 'fa-flag'],
            ['url' => route('admin.comment'), 'label' => 'Reported Comment', 'icon' => 'fa-comment'],
            ['url' => route('admin.user'), 'label' => 'User', 'icon' => 'fa-users'],
            ['url' => route('admin.tags'), 'label' => 'Tags', 'icon' => 'fa-tags'],
        ];
    @endphp

    <main
    x-data="{navOpen: true  , inputValue: '', scrolled: false, lastScrollTop: 0, hideHeader: false}"
    x-init="
        scrolled = window.scrollY > 15;
        lastScrollTop = window.scrollY;
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 15;
            let currentScroll = window.scrollY;
            hideHeader=currentScroll > lastScrollTop && currentScroll > 50;
                lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // prevent negative
            })
            "
        class="min-w-full max-w-full min-h-screen w-full h-full bg-sl-base text-sl-text relative pb-10"
        >
        <nav @click.outside="navOpen = false">
            <header 
                :class="[
                    navOpen ? 'border-b-white' : 'border-b-transparent',
                    hideHeader ? '-top-20' : 'top-0'
                ]"
                class="flex fixed justify-between items-center transition-all w-full duration-300 left-0 z-20 bg-sl-septenary h-16 md:h-18 px-4  sm:px-10 lg:px-20 xl:px-32 2xl:px-40"
                style="transition-property: top, border-bottom; border-bottom-width:0.000005px;"
            >
                <a href="/admin" class="flex items-center">
                    <img src="{{ asset('img/logo/sudutlain_icon.png') }}" alt="Logo" class="h-8 mr-2">
                    <h1 class="text-lg font-bold text-white">Dashboard Admin</h1>
                </a>
                <div class="flex items-center">
                    <nav class="hidden gap-x-4 md:flex items-center">
                        <a href="/" class="text-white hover:text-gray-300 hover:underline">Home</a>
                        <a href="/profile" class="text-white hover:text-gray-300 hover:underline">Profile</a>
                    </nav>
                    <div class="flex items-center h-full">
                        <a href="/" class="ml-4 text-white md:hidden text-2xl hover:text-gray-300 max-h-fit flex items-center focus:outline-none">
                            <i class="fa-light fa-home"></i>
                        </a>
                        <button @click="navOpen = !navOpen" class="ml-4 text-white text-2xl max-h-fit flex items-center hover:text-gray-300 focus:outline-none">
                            <i class="fa-light" :class="!navOpen ? 'fa-bars' : 'fa-xmark'"></i>
                        </button>
                    </div>
                </div>
            </header>
            <aside
                :class="(navOpen ? 'left-0' : '-left-65') + (hideHeader ? ' top-0' : ' top-16 md:top-18')"
                class="min-h-screen min-w-65 max-w-65 bg-sl-septenary fixed z-40 h-full w-19 shadow-xs shadow-neutral-500 transition-all duration-300 pt-5"
            >
                <div class="flex flex-col gap-4 text-md font-medium items-start justify-start h-full pl-4 pr-6 py-2 w-full">
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}" class="text-sl-text hover:text-gray-300 px-2 w-full max-w-full h-9 rounded-sm flex items-center gap-2 relative"><i class="fa-light {{ $link['icon'] }}"> </i> <span class="max-w-full truncate w-full">{{ $link['label'] }}</span> <i class="absolute right-0 text-sm md:text-xs fa-light fa-angle-right"></i></a>
                    @endforeach
        </nav>

        <article class="flex flex-col min-w-full max-w-full min-h-screen h-auto px-5 pt-20 md:pt-24 transition-all xs:px-7 sm:px-10 lg:px-20 xl:px-32 2xl:px-45 gap-y-15">
        {{ $slot }}
        </article>
    </main>
    <x-footer></x-footer>
    <script src="{{ asset('js/swaldef.js') }}" defer></script>
</body>

</html>
