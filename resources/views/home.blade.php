<x-layout>
    <x-slot:title>SudutLain - Beranda</x-slot:title>
    @if(request()->is('search'))
    <div class="flex flex-col mb-1 gap-1.5 bg-sl-tertiary px-3 pb-3 pt-2 rounded-sm">
        <div class="flex justify-between">        
            <span class="text-sl-senary text-base font-medium">Sort by:</span>
            @if (request('sortby', 'popularitas') !== 'popularitas')
                <button type="button" class="cursor-pointer" @click="window.location.href = '{{ route('search', parameters: ['search' => $search, 'sortby' => request('sortby', 'popularitas'), 'orderby' => request('orderby', 'ASC') === 'ASC' ? 'DESC' : 'ASC'])}}'"><i class="fa-light {{ request('orderby', 'ASC') !== 'ASC' ? 'fa-arrow-down-wide-short' : 'fa-arrow-up-wide-short'}}"></i></button>
            @endif
        </div>
        <div class="flex justify-center text-center gap-x-4">
                <a href="{{ route('search', parameters: ['search' => $search, 'sortby' => 'popularitas', 'orderby' => request('orderby', 'ASC')]) }}"
                class="w-1/4 px-3 py-1 rounded {{ $sortby=='popularitas' ? 'bg-sl-primary text-white' : 'bg-sl-quinary' }} hover:bg-sl-base">
                    Popularitas
                </a>
                <a href="{{ route('search', ['search' => $search, 'sortby' => 'upvotes', 'orderby' => request('orderby', 'ASC')]) }}"
                class="w-1/4 px-3 py-1 rounded {{ $sortby=='upvotes' ? 'bg-sl-primary text-white' : 'bg-sl-quinary' }} hover:bg-sl-base">
                    Votes
                </a>
                <a href="{{ route('search', ['search' => $search, 'sortby' => 'comments', 'orderby' => request('orderby', 'ASC')]) }}"
                class="w-1/4 px-3 py-1 rounded {{ $sortby=='comments' ? 'bg-sl-primary text-white' : 'bg-sl-quinary' }} hover:bg-sl-base">
                    Comments
                </a>
                <a href="{{ route('search', ['search' => $search, 'sortby' => 'title', 'orderby' => request('orderby', 'ASC')]) }}"
                class="w-1/4 px-3 py-1 rounded {{ $sortby=='title' ? 'bg-sl-primary text-white' : 'bg-sl-quinary' }} hover:bg-sl-base">
                    Title A→Z
                </a>

        </div>
    </div>
    @else
    <x-item.postbanner></x-item.postbanner>
    @endif

    <div id="homeAlpineInstance" x-data="{
    posts: JSON.parse(sessionStorage.getItem(`cachedPosts`)) || {!! Illuminate\Support\Js::from($posts->items())->toHtml() ?: '[]' !!},
    currentPage: parseInt(sessionStorage.getItem(`cachedPage`)) || {{ $posts->currentPage() }},
    lastPage: parseInt(sessionStorage.getItem(`cachedLastPage`)) || {{ $posts->lastPage() }},
    hasMorePages: sessionStorage.getItem(`cachedHasMorePages`) ? sessionStorage.getItem(`cachedHasMorePages`) === `true` : {{ $posts->hasMorePages() ? 'true' : 'false' }},
    cacheDuration: 30 * 1000, // 30 seconds
    searchQuery: `{{ request('search', '') }}`, // REMOVE THIS LINE, as search is on /search path
    loading: false,

    init() {
        if (this.$el._alpineHomeInitialized) return;

        this.$el._alpineHomeInitialized = true;

        const navigationEntries = performance.getEntriesByType(`navigation`);
    const isReload = navigationEntries.length > 0 && navigationEntries[0].type === `reload`;

    const justLeftHomePageFlag = sessionStorage.getItem(`justLeftHomePage`);
    // sessionStorage.removeItem(`justLeftHomePage`); // Consume the flag

    if (isReload) {
        this.clearHomeSessionCache(true);
        this.reinitializeFromBlade();
        window.scrollTo(0, 0);
    } else if (justLeftHomePageFlag === `true`) {
        const scrollPosition = sessionStorage.getItem(`scrollPosition`);
        if (scrollPosition) {
            window.scrollTo(0, parseInt(scrollPosition));
        }
    } else {
        this.clearHomeSessionCache(true);
        this.reinitializeFromBlade();
        window.scrollTo(0, 0);
    }

    window.addEventListener(`beforeunload`, () => {
        if (this.posts && this.posts.length > 0) {
            sessionStorage.setItem(`cachedPosts`, JSON.stringify(this.posts));
            sessionStorage.setItem(`cachedPage`, this.currentPage);
            sessionStorage.setItem(`cachedLastPage`, this.lastPage);
            sessionStorage.setItem(`cachedHasMorePages`, this.hasMorePages.toString());
            sessionStorage.setItem(`cacheTimestamp`, Date.now().toString());
        } else {
            this.clearHomeSessionCache(false);
        }
        sessionStorage.setItem(`scrollPosition`, window.scrollY);
        sessionStorage.setItem(`justLeftHomePage`, `true`);
    });

    },
    clearHomeSessionCache(clearScroll = true) {
    sessionStorage.removeItem(`cachedPosts`);
    sessionStorage.removeItem(`cachedPage`);
    sessionStorage.removeItem(`cachedLastPage`);
    sessionStorage.removeItem(`cachedHasMorePages`);
    sessionStorage.removeItem(`cacheTimestamp`);
    if (clearScroll) {
    sessionStorage.removeItem(`scrollPosition`);
    }
    },
    reinitializeFromBlade() {
    // console.log('Re-initializing posts and pagination from Blade server data.');
    this.posts = {!! Illuminate\Support\Js::from($posts->items())->toHtml() ?: '[]' !!};
    this.currentPage = {{ $posts->currentPage() }};
    this.lastPage = {{ $posts->lastPage() }};
    this.hasMorePages = {{ $posts->hasMorePages() ? 'true' : 'false' }};
    },
    loadMorePosts() {
    console.log(`loadMorePosts ACTION: init. loading: ${this.loading}, hasMorePages: ${this.hasMorePages}, currentPage: ${this.currentPage}`);
    if (this.loading || !this.hasMorePages) return;

    this.loading = true;
    let pageToLoad = this.currentPage + 1;
    // console.log(`Loading more posts. Page: ${pageToLoad}, Search: '${this.searchQuery}'`); // searchQuery is removed

    axios.get(`/load-more-posts?page=${pageToLoad}` /* Removed searchQuery from here */ )
    .then(response => {
    const newPosts = response.data.data;
    // console.log(`Received ${newPosts.length} new posts.`);
    this.posts = this.posts.concat(newPosts);
    this.currentPage = response.data.current_page;
    this.lastPage = response.data.last_page;
    this.hasMorePages = response.data.next_page_url !== null;

    // console.log(`Caching updated posts. Total posts now: ${this.posts.length}, Current page: ${this.currentPage}`);
    sessionStorage.setItem(`cachedPosts`, JSON.stringify(this.posts));
    sessionStorage.setItem(`cachedPage`, this.currentPage);
    sessionStorage.setItem(`cachedLastPage`, this.lastPage);
    sessionStorage.setItem(`cachedHasMorePages`, this.hasMorePages.toString());
    sessionStorage.setItem(`cacheTimestamp`, Date.now().toString()); // Update timestamp

    this.loading = false;
    })
    .catch(error => {
    console.error(`Error loading more posts:`, error);
    this.loading = false;
    });
    },

    handleScroll() {
    // console.log(`handleScroll triggered`);
    const nearBottom = (window.innerHeight + window.scrollY) >= document.body.offsetHeight - 300;
    // console.log(`handleScroll check: nearBottom: ${nearBottom}, loading: ${this.loading}, hasMorePages: ${this.hasMorePages}`);
    if (nearBottom) {
    // console.log(`handleScroll: calling loadMorePosts()`);
    this.loadMorePosts();
    }
    }
    }" @scroll.window.debounce.500ms="handleScroll()" x-init="init()">

        @if ($posts->isEmpty() && !request('search'))
        {{-- This handles initial empty state for non-search pages --}}
        <h1 class="text-center text-xs mt-4">Tidak ada postingan untuk saat ini.</h1>
        @elseif ($posts->isEmpty() && request('search'))
        {{-- This handles initial empty state for search results --}}
        <h1 class="text-center mt-4" x-text="`Pencarian '${searchQuery}' tidak ditemukan`"></h1>
        @endif


        <template x-for="(post, index) in posts" :key="post.id" class="w-full max-w-full flex flex-col gap-y-4">
            <article :x-ref="`post_${post.id}`"
                class="min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 gap-y-4 mb-4">
                <section x-data="{ showOption: false }"
                    class="w-full min-h-12 flex items-center justify-between relative">
                    <div @click="window.location.href = `/post/${post.id}`"
                        class="max-w-[75%] h-full flex items-center gap-2 cursor-pointer">
                        <a :href="`/profile/${post.user.username}`"><img class="w-9 h-9 rounded-full object-cover"
                                :src="`{{ asset('storage/avatars/') }}/${post.user.avatar}`"
                                :alt="`${post.user.username}'s avatar`"></a>
                        <div class="flex flex-col h-full justify-center">
                            <a :href="post.user ? `/profile/${post.user.username}` : '#'"
                                class="text-sm lg:text-base font-semibold text-sl-text/90">
                                <span
                                    x-text="post.user ? (post.user.display_name ? post.user.display_name : post.user.username) : 'Pengguna Anonim'"></span>
                            </a>
                            <div class="text-[.65rem] lg:text-xs text-emerald-500/70">
                                <span x-show="post.user && post.user.badges && post.user.badges.length > 0"
                                    x-text="post.user ? (post.user.badges && post.user.badges.length > 0 ? post.user.badges[0].badge_name : '') : ''"></span>
                            </div>
                        </div>
                    </div>
                    <div class="max-w-[20%] h-full flex items-center gap-2 text-2xl pr-2">
                        <button @click="showOption=!showOption" class="w-fit h-fit cursor-pointer"><i
                                class="fa-light fa-ellipsis"></i></button>
                    </div>
                    <div x-cloak x-show="showOption" @click.outside="showOption = false"
                        class="absolute top-8 right-0 min-w-20 max-w-25 h-fit bg-white/10 backdrop-blur-sm rounded-md shadow-lg flex flex-col *:items-center *:justify-center *:text-center **:text-center gap-y-2 p-1 text-xs text-sl-text/90 z-50">

                        <template x-if="post.allow_edit === true">
                            <button @click="window.location.href=`/post/${post.id}/edit`"
                                class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1 text-left">
                                Edit Post
                            </button>
                        </template>

                        <template x-if="post.allow_edit === true">

                            <button @click="
                                    Swal.fire({
                                        title: 'Hapus Postingan',
                                        text: 'Apakah anda yakin ingin menghapus postingan ini?',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Hapus',
                                        cancelButtonText: 'Batal',
                                        allowOutsideClick: false
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            axios.post(`/post/${post.id}`, { _method: 'DELETE' })
                                            .then(() => {
                                                Swal.fire('Berhasil!', 'Postingan berhasil dihapus!', 'success');
                                                posts = posts.filter(p => p.id !== post.id);
                                            })
                                            .catch((error) => {
                                                console.error(error);
                                                Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus postingan.', 'error');
                                            });
                                        }
                                    })"
                                class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1 text-red-600 font-bold text-left">
                                Hapus Post
                            </button>
                        </template>
                        @auth
                        <button @click="
                                    Swal.fire({
                                        title: 'Laporkan Postingan',
                                        text: 'Berikan alasan anda!',
                                        icon: 'warning',
                                        input: 'text',
                                        inputPlaceholder: 'Alasan anda',
                                        showCancelButton: true,
                                        confirmButtonText: 'Laporkan',
                                        cancelButtonText: 'Batal',
                                        allowOutsideClick: false,
                                        preConfirm: (input) => {
                                            if (!input) {
                                                Swal.showValidationMessage('Alasan tidak boleh kosong!')
                                            }
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            const reason = result.value;
                                            axios.post(`/post/${post.id}/report`, { reason: reason })
                                            .then(() => {
                                                Swal.fire('Berhasil!', 'Postingan berhasil dilaporkan!', 'success');
                                            })
                                            .catch((error) => {
                                                if (error.response && error.response.status === 403 && error.response.data.message.startsWith('You have already reported')) {
                                                    Swal.fire('Gagal!', 'Anda Sudah melaporkan Postingan ini', 'error');
                                                } else {
                                                    console.error(error);
                                                    Swal.fire('Gagal!', 'Terjadi kesalahan saat melaporkan postingan.', 'error');
                                                }
                                            });
                                        }
                                    })"
                            class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1 text-left">Laporkan</button>
                        @endauth
                        @guest
                        <button @click="window.location.href = '/login'"
                            class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1 text-left">Laporkan</button>
                        @endguest
                    </div>
                </section>

                <section @click="window.location.href = `/post/${post.id}`"
                    class="w-full min-h-12 !h-auto flex flex-col justify-start items-start cursor-pointer" x-cloak>
                    <a :href="`/post/${post.id}`"
                        class="w-full h-full max-w-full max-h-full truncate font-bold text-base md:text-lg hover:underline">
                        <span x-text="post.title"></span>
                    </a>
                    <div class="w-full font-light text-xs md:text-sm relative " x-data="{ showMoreText: false }" x-init="$nextTick(() => {
                            const p = $refs.content_text;
                            if (p) { // Check if p exists
                                const lineHeight = parseFloat(getComputedStyle(p).lineHeight);
                                const maxHeight = lineHeight * 4; // 4 baris
                                showMoreText = p.scrollHeight > maxHeight;
                            }
                        })">
                        <p class="line-clamp-4" x-ref="content_text" x-text="post.content"></p>
                        <template x-if="showMoreText">
                            <div class="absolute mt-10 bottom-0 right-1 md:right-0 w-full text-right cursor-text">
                                <a class="text-blue-500 font-medium hover:underline bg-sl-tertiary"
                                    :href="`/post/${post.id}`">
                                    ...lihat selengkapnya
                                </a>
                            </div>
                        </template>
                    </div>
                </section>
                <section @click="window.location.href = `/post/${post.id}`" class="w-full h-auto cursor-pointer"
                    x-show="post.attachments && post.attachments.length > 0">
                    <img class="!aspect-video rounded-xl object-cover w-full h-auto"
                        :src="`{{ asset('storage/posts/') }}/${post.attachments[0].namafile}`"
                        onerror="this.style.display='none';"> {{-- Hide if image fails to load --}}
                </section>
                <section
                    class="w-full min-h-3 h-10 flex items-center bg-white/10 mt-1 rounded-md px-3 md:px-5 xl:px-8 2xl:px-10 text-2xl justify-between">
                    @guest
                    <div class="flex w-[35%] md:w-[30%] justify-between">
                        <span class="h-full flex items-center sm:w-[40%]">
                            <button @click="window.location.href = '/login'"
                                class="text-2xl cursor-pointer hover:text-emerald-500"><i
                                    class="fa-light fa-up "></i></button>
                            <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block"
                                x-text="post.upvoted_by_count"></div>
                        </span>
                        <button @click="window.location.href = '/login'"
                            class="text-2xl cursor-pointer hover:text-red-700"><i class="fa-light fa-down"></i></button>
                    </div>
                    <div class="flex w-[53%] justify-between items-center">
                        <span class="h-full flex items-center sm:w-[20%] md:w-[30%]">
                            <button @click="window.location.href = `/post/${post.id}#comment`"
                                class="text-2xl cursor-pointer hover:text-yellow-500"><i
                                    class="fa-light fa-comment "></i></button>
                            <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block"
                                x-text="post.comments_count"></div>
                        </span>
                        <button @click="window.location.href = '/login'"
                            class="text-xl cursor-pointer hover:text-cyan-700"><i
                                class="fa-light fa-bookmark"></i></button>
                        <button @click="copyLink(`{{ url('/') }}/post/${post.id}`)"
                            class="text-xl cursor-pointer hover:scale-101">
                            <i class="fa-light fa-share-from-square "></i>
                        </button>
                    </div>
                    @endguest

                    @auth
                    {{-- The upvoted, downvoted, bookmarked status should ideally come from the 'post' object if
                    possible.
                    Example: post.is_upvoted_by_user, post.is_downvoted_by_user, post.is_bookmarked_by_user
                    For now, the x-data for votes/bookmarks is kept per post, but initialized with post specific data.
                    This assumes `post.upvoted_by_user`, `post.downvoted_by_user`, `post.bookmarked_by_user` are boolean
                    fields from the server.
                    If not, it defaults to false.
                    --}}
                    <div x-data="{
                            upvoted: post.upvoted_by_user || false, // Assume these are passed in post object
                            downvoted: post.downvoted_by_user || false, // Assume these are passed in post object
                            currentUpvotes: post.upvoted_by_count,
                            voteLoading: false,
                            toggleUpvote() {
                                if (this.voteLoading) return;
                                this.voteLoading = true;
                                axios.post(`/post/${post.id}/upvote`) // Assumes global CSRF
                                    .then(response => {
                                        this.currentUpvotes = response.data.upvoted_by_count;
                                        // this.post.downvoted_by_count = response.data.downvoted_by_count; // Optional: if you display downvote count separately
                                        this.upvoted = response.data.upvoted_by_user;
                                        this.downvoted = response.data.downvoted_by_user;
                                    })
                                    .catch(err => console.error(err))
                                    .finally(() => this.voteLoading = false);
                            },
                            toggleDownvote() {
                                if (this.voteLoading) return;
                                this.voteLoading = true;
                                axios.post(`/post/${post.id}/downvote`) // Assumes global CSRF
                                    .then(response => {
                                        this.currentUpvotes = response.data.upvoted_by_count; // Server returns the main upvote count
                                        // this.post.downvoted_by_count = response.data.downvoted_by_count; // Optional: if you display downvote count separately
                                        this.upvoted = response.data.upvoted_by_user;
                                        this.downvoted = response.data.downvoted_by_user;
                                    })
                                    .catch(err => console.error(err))
                                    .finally(() => this.voteLoading = false);
                            }
                        }" class="flex w-[35%] md:w-[30%] justify-between">
                        <span class="h-full flex items-center sm:w-[40%]">
                            <button @click="toggleUpvote()"
                                :class="upvoted ? 'text-emerald-500 hover:text-emerald-700' : 'text-sl-text hover:text-emerald-500'"
                                class="text-2xl cursor-pointer">
                                <i :class="upvoted ? 'fa-solid' : 'fa-light'" class="fa-up"></i>
                            </button>
                            <div x-text="currentUpvotes"
                                class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block"></div>
                        </span>
                        <button @click="toggleDownvote()"
                            :class="downvoted ? 'text-red-700 hover:text-red-500' : 'text-sl-text hover:text-red-700'"
                            class="text-2xl cursor-pointer">
                            <i :class="downvoted ? 'fa-solid' : 'fa-light'" class="fa-down"></i>
                        </button>
                    </div>

                    <div class="flex w-[53%] justify-between items-center">
                        <span class="h-full flex items-center sm:w-[20%] md:w-[30%]">
                            <button @click="window.location.href = `/post/${post.id}#comment`"
                                class="text-2xl cursor-pointer hover:text-yellow-500"><i
                                    class="fa-light fa-comment "></i></button>
                            <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block"
                                x-text="post.comments_count"></div>
                        </span>
                        <button x-data="{
                                bookmarked: post.bookmarked_by_user || false, // Assume this is passed in post object
                                bookmarkLoading: false,
                                toggleBookmark() {
                                    if (this.bookmarkLoading) return;
                                    this.bookmarkLoading = true;
                                    axios.post(`/post/${post.id}/bookmark`) // Assumes global CSRF
                                        .then(() => {
                                            this.bookmarked = !this.bookmarked;
                                        })
                                        .catch(err => console.error(err))
                                        .finally(() => this.bookmarkLoading = false);
                                }
                            }" @click="toggleBookmark()"
                            :class="bookmarked ? 'text-cyan-500 hover:text-cyan-700' : 'text-sl-text hover:text-cyan-500'"
                            class="text-xl cursor-pointer">
                            <i :class="bookmarked ? 'fa-solid' : 'fa-light'" class="fa-bookmark"></i>
                        </button>
                        <button @click="copyLink(`{{ url('/') }}/post/${post.id}`)"
                            class="text-xl cursor-pointer hover:scale-101">
                            <i class="fa-light fa-share-from-square "></i>
                        </button>
                    </div>
                    @endauth
                </section>
            </article>
        </template>

        <div x-show="loading" class="text-center text-xs my-4 flex items-center justify-center gap-2 text-neutral-400">
            <i class="fa-solid fa-spinner fa-spin text-lg text-sl-quaternary"></i> Loading postingan lain...
        </div>

        <div x-show="!hasMorePages && posts.length > 0 && !loading"
            class="text-center text-xs my-4 text-neutral-500 select-none">
            Kamu mencapai ujung dunia. Tidak ada postingan lainnya.
        </div>

        {{-- Client-side empty state for search after initial load (if posts array becomes empty) --}}
        {{-- <template x-if="posts.length === 0 && !loading && searchQuery">
            <h1 class="text-center mt-4" x-text="`Pencarian '${searchQuery}' tidak ditemukan`"></h1>
        </template> --}}
        {{-- Client-side empty state for non-search if all posts are deleted client-side --}}
        <template x-if="posts.length === 0 && !loading && !searchQuery && currentPage > 1">
            <h1 class="text-center mt-4">Tidak ada postingan untuk saat ini.</h1>
        </template>


    </div>
</x-layout>

<script>
    // Ensure this function is globally available or defined within the Alpine component if preferred.
    function copyLink(link) {
        navigator.clipboard.writeText(link).then(function() {
            Swal.fire('', "Link berhasil disalin!", 'success');
        }, function(err) {
            console.error("Gagal menyalin link: ", err);
            Swal.fire('Oops!', "Gagal menyalin link.", 'error');
        });
    }

    // It's good practice to set CSRF token for all Axios requests globally,
    // usually in your main app.js or in the layout head.
    // Example:
    // const token = document.querySelector('meta[name="csrf-token"]');
    // if (token) {
    //     axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content');
    // } else {
    //     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    // }
</script>