<header
    x-data="{open: false, inputValue: '', scrolled: false, lastScrollTop: 0, hideHeader: false}"
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
    :class="{
        '-translate-y-full': hideHeader,
        'translate-y-0': !hideHeader,
        'bg-sl-base/10 backdrop-blur-xs shadow-md': scrolled,
        'bg-sl-base shadow-none': !scrolled
    }"
    class="transition-all duration-300 min-w-full !max-w-full w-full min-h-19 h-19 max-h-19 sticky top-0 z-100 flex items-center justify-between px-5 xs:px-10 lg:px-20 xl:px-32 2xl:px-40"
    >

        {{-- POPUP MODAL UNTUK KETIKA SEARCHBAR DITEKAN, KENAPA DIPISAH? BIAR GAMPANG AJA NGODINGNYA AWIKWOK --}}
        <div
            @click.outside="open=!open"
            x-show="open & !hideHeader"
            x-cloak
            :class="scrolled ? 'bg-sl-tertiary opacity-[.97] backdrop-blur-xs' : 'bg-sl-tertiary opacity-100 backdrop-blur-none'"
            class="transition-all border-b-2 border-l-2 border-sl-tertiary !absolute z-50 top-0 right-0 pt-2 flex flex-col  max-w-6/7 min-h-2 w-6/7 xs:w-4/5 sm:w-2/3 md:w-3/5 lg:w-3/5 xl:w-1/2 2xl:w-2/5 rounded-bl-lg shadow-2xl gap-y-3"
            >
                <form method="GET" action="/search" class="flex items-center gap-5 px-4 py-2 text-2xl">
                    <button @click="open=!open" type="button" class="cursor-pointer flex items-center justify-center w-fit"><i class="fa-light fa-arrow-left"></i></button>
                    
                    <input x-model="inputValue" x-ref="searchbar" class="bg-white/8 w-full h-10 px-4 text-lg rounded-xl border-transparent outline-none font-light" type="search" name="search" id="search" placeholder="Cari..." required autocomplete="off">

                    <button type="submit" class="cursor-pointer flex items-center justify-center w-fit"><i class="fa-light fa-magnifying-glass"></i></button>
                </form>
                <article class="min-w-full max-w-full min-h-2 flex flex-col" x-data="searchHistoryComponent()">
                    <div class="flex items-center justify-between px-4 py-2 text-sm text-sl-text/60 shadow-xs">
                        <span>Terbaru</span>
                        <span class="text-xs cursor-pointer" @click="deleteAllHistory">Hapus semua</span>
                    </div>
                    <div class="min-w-full max-w-full min-h-2 max-h-36 h-auto overflow-y-auto overflow-x-clip customScrollbar">
                        <div class="flex flex-col min-w-full w-full max-w-full min-h-2 pr-3 *:!text-sm">
                            @if (!empty(session('search_history', [])))
                                <div class="">
                                    @foreach (session('search_history', []) as $index => $history)
                            <div :id="'history-item-' + {{ $index }}" class="flex items-center justify-between px-4 py-2 text-sl-text/95">
                                <span 
                                @click="window.location.href='/search?search=' + encodeURIComponent({{ json_encode($history) }})" class="cursor-pointer hover:text-sl-text hover:underline">{{ $history }}</span>
                                <button type="button" class="cursor-pointer flex items-center justify-center w-fit" @click="deleteHistory({{ json_encode($history) }}, {{ $index }})"><i class="fa-light fa-times"></i></button>
                            </div>
                            @endforeach
                                </div>
                            @endif            
                        </div>
                    </div>
                </article>
        </div>

        {{-- BAGIAN KIRI HEADER: PP DAN LOGO --}}
        <section class="flex items-center justify-start min-w-[25%]">
            @auth
                <a href="/profile" class="cursor-pointer"><img class="w-9 h-9 rounded-full" src="{{ asset('img/blankprofile.png') }}" alt="profilepicture.jpg"></a>
            @endauth
            @guest
                <a href="/login" class="cursor-pointer"><img class="w-9 h-9 rounded-full" src="{{ asset('img/blankprofile.png') }}" alt="profilepicture.jpg"></a>
            @endguest
            <a href="/" class="cursor-pointer"><img class="h-9 max-h-9" src="{{ asset('img/logo/sudutlain_wm.png') }}" alt=""></a>
        </section>

        {{-- BAGIAN KANAN HEADER: LOGO SEARCH DAN ADD POST --}}
        <section class="flex items-center justify-end gap-8 text-2xl !max-w-[25%] w-[25%] sm:!max-w-[60%] sm:w-auto sm:justify-between transition-all relative">
            <button @click="open=!open" type="button" class="cursor-pointer flex items-center justify-center w-fit sm:hidden"><i class="fa-light fa-magnifying-glass"></i></button>
            <form @click="open = !open; $nextTick(() => $refs.searchbar.focus())" method="GET" class="w-full hidden sm:flex items-center gap-5 px-4 py-2 rounded-md">
                <input x-model="inputValue" :class="scrolled ? 'backdrop-blur-xs bg-sl-tertiary/70' : 'backdrop-blur-none bg-sl-tertiary'" class=" w-full h-10 px-4 text-lg rounded-xl border-transparent outline-none font-light" type="search" name="search" id="search" placeholder="Cari..." required autocomplete="off">
                <button type="button" class="cursor-pointer flex items-center justify-center w-fit"><i class="fa-light fa-magnifying-glass"></i></button>
            </form>

            @if(!(Request::is('post/add')))
                <a href="{{ route('post.create') }}" class="cursor-pointer flex items-center justify-center w-fit"><i class="fa-light fa-square-plus"></i></a>
            @endif
        </section>

</header>

<script>
    function searchHistoryComponent() {
        return {
            // Hapus satu satu
            deleteHistory(keyword, index) {
                axios.post('/search/delete-history', {
                    keyword: keyword
                }, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.data.success) {
                        const item = document.getElementById('history-item-' + index);
                        if (item) item.remove();
                    }
                })
                .catch(error => {
                    console.error("Gagal menghapus history:", error);
                });
            },

            // Hapus semua history
            deleteAllHistory() {
                axios.post('/search/delete-all-history', {}, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.data.success) {
                        // Hapus semua elemen yang memiliki ID history-item-...
                        document.querySelectorAll('[id^="history-item-"]').forEach(el => el.remove());
                    }
                });
            }
        };
    }
</script>

