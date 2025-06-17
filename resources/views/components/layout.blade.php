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

<body x-init="console.log('ALPINEJS INITIALIZE')" class="min-w-full max-w-full min-h-screen w-full h-full bg-sl-base text-sl-text relative">
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
    @php
        $navs =[
            [ 'icon' => 'fa-house', 'text' => 'Beranda', 'route' => '/', ],
            [ 'icon' => 'fa-square-plus', 'text' => 'Buat Postingan', 'route' => auth()->check() ? route('post.create') : route('login') ],
            [ 'icon' => 'fa-rectangle-history', 'text' => 'Postingan Saya', 'route' => route('profile.post') ],
            [ 'icon' => 'fa-comments', 'text' => 'Komentar Saya', 'route' => route('profile.comment') ],
            [ 'icon' => 'fa-up', 'text' => 'Votingan Saya', 'route' => route('profile.vote') ],
            [ 'icon' => 'fa-bookmark', 'text' => 'Tersimpan', 'route' => route('profile.bookmark') ],
            [ 'icon' => 'fa-shield', 'text' => 'Badge', 'route' => route('badges.index') ],
            [ 'icon' => 'fa-user', 'text' => auth()->check() ? 'Profil' : 'Login', 'route' => auth()->check() ? route('profile') : route('login') ],
        ] 
    @endphp

    <div x-data="{ scrolled: false, lastScrollTop: 0, hideHeader: false }" x-init="scrolled = window.scrollY > 15;
    lastScrollTop = window.scrollY;
    window.addEventListener('scroll', () => {
        scrolled = window.scrollY > 15;
        let currentScroll = window.scrollY;
        hideHeader = currentScroll > lastScrollTop && currentScroll > 50;
        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // prevent negative
    })" class="flex w-full min-h-screen justify-center">
        <aside
            :class="{
                '-translate-y-19': hideHeader,
                'translate-y-0': !hideHeader,
            }"
            class="w-1/5 hidden lg:flex flex-col h-screen *:cursor-pointer bg-sl-base fixed border-r-[.5px] transition-all duration-300 border-r-neutral-500/20 p-4 left-0 z-1">
            @foreach ($navs as $nav)
                <a href="{{ $nav['route'] }}"
                    class="flex items-center gap-3 p-2 rounded  mb-4 {{ request()->is($nav['route']) ? 'bg-sl-tertiary hover:bg-neutral-500/20 ' : 'hover:bg-sl-tertiary' }}">
                    <i class="fa-light {{ $nav['icon'] }} text-lg w-5 h-5"></i>
                    <span class="font-medium">{{ $nav['text'] }}</span>
                </a>
            @endforeach
            @can('admin')
                <a href="{{ route('admin.index') }}" class="flex items-center gap-3 p-2 rounded hover:bg-sl-tertiary mb-4">
                    <i class="fa-light fa-gear-code text-lg w-5 h-5"></i>
                    <span class="font-medium">Admin</span>
                </a>
            @endcan
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        @click="
                            (e)
=> {
                                e.preventDefault();
                                Swal.fire({
                                    title: 'Logout',
                                    text: 'Apakah Anda yakin ingin keluar?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Ya',
                                    cancelButtonText: 'Tidak'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $el.form.submit();
                                    }
                                });
                            }
                        "
                        type="submit"
                        class="flex items-center gap-3 p-2 rounded hover:bg-red-800/20 mb-4 w-full cursor-pointer">
                        <i class="fa-light fa-right-from-bracket text-lg w-5 h-5"></i>
                        <span class=" font-medium">Logout</span>
                    </button>
                </form>
            @endauth
        </aside>

        <main
            class="w-full xs:w-3/4 sm:w-4/6 md:w-2/3 lg:w-1/2 xl:w-3/7  px-6 py-4 bg-sl-base text-sl-text flex flex-col gap-y-3 mb-50 md:mb-40">
            {{ $slot }}
        </main>

        <aside
            :class="{
                '-translate-y-19': hideHeader,
                'translate-y-0': !hideHeader,
                {{--                        'h-[calc(100vh-5rem)]': hideHeader, --}}
                {{--                        'h-[calc(100vh-7.5rem)]': !hideHeader --}}
            }"
            {{--            class="w-1/5 hidden lg:flex top-24 flex-col border-l-neutral-700 border-l-[.5px] border-t-neutral-700 border-t-[.5px] border-b-neutral-700 border-b-[.5px] rounded-s-md bg-sl-base fixed right-0 p-4 transition-all duration-300" --}}
            class="w-1/5 hidden lg:flex h-screen flex-col border-l-neutral-700 border-l-[.5px] bg-sl-base text-sl-text fixed right-0 px-4 py-3 transition-all duration-300"
            x-data="popularPostsSidebar" x-init="checkScreenSizeAndLoad()">
            <h2 class="text-lg font-bold mb-4 text-sl-secondary">Suggestions</h2>
            <div
                class="flex flex-col gap-3 divide-neutral-50/10 divide-y-[1px] overflow-y-auto h-full *:first:border-t-[.5px] *:first:border-t-neutral-700 customScrollbar *:last:border-b-[.5px] *:last:border-b-neutral-700 *:first:pt-3 *:pb-3 *:px-1">
                <template x-for="(post, index) in posts" :key="post.id">
                    <a :href="`/post/${post.id}`"
                        class="flex items-center justify-between gap-1 cursor-pointer group hover:bg-sl-tertiary/30 *:select-none last:mb-30"
                        {{--                       :class="Math.floor(index / 3) % 2 === 0 ? 'flex-row-reverse justify-between' : 'flex-row justify-between'" --}}>
                        <div class="w-full max-w-[calc(100%-52px)]">
                            <h1 class="font-medium text-sm group-hover:font-semibold truncate" x-text="post.title"></h1>
                            <p class="text-[.7rem] opacity-50 line-clamp-2 font-light group-hover:font-normal"
                                x-text="post.content"></p>
                        </div> 
                        <img class="object-fit rounded-sm !aspect-square w-12 h-12" :src="`{{ env('IMAGEKIT_URL_ENDPOINT') }}${post.image}`" alt=""> 
                    </a>
                </template>

                {{-- Ulangi untuk postingan lain --}}
            </div>
        </aside>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('popularPostsSidebar', () => ({
                posts: [],
                hasFetched: false,

                async fetchPosts() {
                    try {
                        const response = await fetch('{{ route('posts.loadRandom') }}');
                        const data = await response.json();
                        this.posts = data;
                    } catch (error) {
                        console.error('Gagal mengambil post populer:', error);
                    }
                },

                checkScreenSizeAndLoad() {
                    const isLargeScreen = window.innerWidth >= 1024;
                    if (isLargeScreen && !this.hasFetched) {
                        this.fetchPosts();
                        this.hasFetched = true;
                    }

                    // Tambahkan event listener untuk responsif
                    window.addEventListener('resize', () => {
                        const isLarge = window.innerWidth >= 1024;
                        if (isLarge && !this.hasFetched) {
                            this.fetchPosts();
                            this.hasFetched = true;
                        }
                    });
                }
            }))
        });
    </script>


    <x-footer></x-footer>
    <script src="{{ asset('js/swaldef.js') }}" defer></script>
    <script>
        function resetCache() {
            sessionStorage.removeItem('cachedPosts');
            sessionStorage.removeItem('cachedPage');
            sessionStorage.removeItem('cachedLastPage');
            sessionStorage.removeItem('cachedHasMorePages');
            sessionStorage.removeItem('cacheTimestamp');
            sessionStorage.removeItem('scrollPosition');
            sessionStorage.removeItem('justLeftHomePage');
        }

        @if(session('clear_home_cache'))
            resetCache();
        @endif

        if (sessionStorage.getItem('justLeftHomePage') !== `true`) {
            resetCache();
        }

        let lastPage = (new URL(document.referrer || document.location.href));
        let nowPage = document.location;

        if ((lastPage.pathname === '/') || (lastPage.pathname === '/search') || lastPage.pathname.startsWith('/tagar')) {
            if (lastPage.pathname === '/search' && (nowPage.pathname === '/' || nowPage.pathname.startsWith('/tagar'))) {
                resetCache();
            } else {
                sessionStorage.setItem('justLeftHomePage', 'true');
            }


            if (lastPage.pathname === '/search' && nowPage.pathname === '/search') {
                if (lastPage.href !== nowPage.href) sessionStorage.removeItem('justLeftHomePage');
                else sessionStorage.setItem('justLeftHomePage', 'true');
            } else {
                sessionStorage.setItem('justLeftHomePage', 'true');
            }
        } else {
            if (nowPage !== '/' || nowPage !== '/search' || lastPage.pathname.startsWith('/tagar')) {
                sessionStorage.removeItem('justLeftHomePage');
            }
        }
    </script>
</body>

</html>
