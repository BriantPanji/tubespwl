<x-layout>
    <x-slot:title>SudutLain - Beranda</x-slot:title>

    @foreach ($posts as $post)
        <article
            class="min-w-full max-w-full w-full min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 gap-y-2">
            <section x-data="{ showOption: false }" class="w-full min-h-12 flex items-center justify-between relative">
                <div class="max-w-[75%] h-full flex items-center gap-2">
                    <a href=""><img class="w-9 h-9 rounded-full"
                            src="{{ asset('img/' . $post->user->avatar) }}"></a>
                    {{-- FOTO PROFIL USER --}}
                    <div class="flex flex-col h-full justify-center">
                        <a href="" class="text-sm lg:text-base font-semibold text-sl-text/90">
                            @php
                                $display_name = $post->user->badges->first();
                            @endphp

                            @if ($display_name)
                                <span>{{ $post->user->display_name }}</span>
                            @else
                                <span>{{ $post->user->usename }}</span>
                            @endif

                        </a>
                        <a href="" class="text-[.65rem] lg:text-xs text-emerald-500/70">
                            @php
                                $firstBadge = $post->user->badges->first();
                            @endphp

                            @if ($firstBadge)
                                <span>
                                    {{ $firstBadge->badge_name }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
                <div class="max-w-[20%] h-full flex items-center gap-2 text-2xl pr-2">
                    <button @click="showOption=!showOption" class="w-fit h-fit cursor-pointer"><i
                            class="fa-light fa-ellipsis"></i></button>
                </div>
                <div x-cloak x-show="showOption" @click.outside="showOption = false"
                    class="absolute top-8 right-0 w-20 h-auto bg-white/10 backdrop-blur-sm rounded-md shadow-lg flex flex-col gap-y-2 p-1 text-xs text-sl-text/90 z-50">
                    {{-- QUERY LAPORKAN (REPORT POST) DISINI --}}
                    <button @click="showOption = false"
                        class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1">Laporkan</button>
                </div>
            </section>

            <section class="w-full min-h-12 !h-auto flex flex-col justify-start items-start " x-cloak>
                {{-- URL MENUJU DETAIL POST INI --}}
                <a href="/post/{{ $post->id }}"
                    class="w-full h-full max-w-full max-h-full truncate font-bold text-base md:text-lg hover:underline">
                    {{-- JUDUL POST --}}
                    {{ $post->title }}
                </a>
                <div class="w-full font-light text-xs md:text-sm relative " x-data="{ showMore: false }"
                     x-init="
                     $nextTick(() => {
        const p = $refs.content;
        const lineHeight = parseFloat(getComputedStyle(p).lineHeight);
        const maxHeight = lineHeight * 4; // 4 baris
        showMore = p.scrollHeight > maxHeight;
    })
        ">
                    <p class="line-clamp-4" x-ref="content">
                        {{-- CONTENT POST --}}
                        {{ $post->content }}

                    </p>
                    <template x-if="showMore">
                    <div class="absolute mt-10 bottom-0 right-1 md:right-0 w-full text-right cursor-text">
                        <a class="text-blue-500 font-medium hover:underline bg-sl-tertiary"
                            href="/post/{{ $post->id }}">
                            ...lihat selengkapnya
                        </a>
                    </div>
                    </template>
                </div>
            </section>
            <section class="w-full h-auto">
                <img class="!aspect-video rounded-xl object-cover" src="{{ asset('storage/posts/' . $post->attachments[0]->namafile) }}">
            </section>
            <section
                class="w-full min-h-3 h-10 flex items-center bg-white/10 mt-1 rounded-md px-3 md:px-5 xl:px-8 2xl:px-10 text-2xl justify-between">
                {{-- ISI '/{DISINI}' DENGAN URI DARI DETAIL POSTINGAN INI --}}
                @guest

                    {{-- ISI '/{DISINI}' DENGAN URI DARI DETAIL POSTINGAN INI --}}
                    <div class="flex w-[35%] md:w-[30%] justify-between">
                        <span class="h-full flex items-center sm:w-[40%]">

                            <button @click="window.location.href = '/login'"
                                class="text-2xl cursor-pointer hover:text-emerald-500"><i
                                    class="fa-light fa-up "></i></button>

                            <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">5.3rb</div>
                        </span>

                        <button @click="window.location.href = '/login'"
                            class="text-2xl cursor-pointer hover:text-red-700"><i class="fa-light fa-down"></i></button>

                    </div>
                    <div class="flex w-[53%] justify-between items-center">
                        <span class="h-full flex items-center sm:w-[20%] md:w-[30%]">

                            <button @click="window.location.href = '/login'"
                                class="text-2xl cursor-pointer hover:text-yellow-500"><i
                                    class="fa-light fa-comment "></i></button>

                            <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">21</div>
                        </span>

                        <button @click="window.location.href = '/login'"
                            class="text-xl cursor-pointer hover:text-cyan-700"><i class="fa-light fa-bookmark"></i></button>

                        <button onclick="copyLink('{{ url('/post/' . $post->id) }}')"
                            class="text-xl cursor-pointer hover:scale-101">
                            <i class="fa-light fa-share-from-square "></i>
                        </button>
                    </div>
                @endguest

                {{-- ISI '/{DISINI}' DENGAN URI DARI DETAIL POSTINGAN INI --}}
                @auth
                    <div
                        x-data="{
                            upvoted: {{ auth()->user()->hasUpvotedPost($post) ? 'true' : 'false' }},
                            downvoted: {{ auth()->user()->hasDownvotedPost($post) ? 'true' : 'false' }},
                            loading: false,
                            toggleUpvote() {
                                if (this.loading) return;
                                this.loading = true;
                                axios.post('/post/{{ $post->id }}/upvote', { _token: '{{ csrf_token() }}' })
                                    .then(() => {
                                        this.upvoted = !this.upvoted;
                                        if (this.upvoted) this.downvoted = false; // Upvote aktif, downvote harus nonaktif
                                    })
                                    .catch(err => console.error(err))
                                    .finally(() => this.loading = false );
                            },
                            toggleDownvote() {
                                if (this.loading) return;
                                this.loading = true;
                                axios.post('/post/{{ $post->id }}/downvote', { _token: '{{ csrf_token() }}' })
                                    .then(() => {
                                        this.downvoted = !this.downvoted;
                                        if (this.downvoted) this.upvoted = false; // Downvote aktif, upvote harus nonaktif
                                    })
                                    .catch(err => console.error(err))
                                    .finally(() => this.loading = false );
                            }
                        }"
                        class="flex w-[35%] md:w-[30%] justify-between">
                        <span class="h-full flex items-center sm:w-[40%]">

                            <button
                                @click="toggleUpvote"
                                :class="upvoted ? 'text-emerald-500 hover:text-emerald-700' : 'text-sl-text hover:text-emerald-500'"
                                class="text-2xl cursor-pointer">
                                    <i :class="upvoted ? 'fa-solid' : 'fa-light'" class="fa-up"></i>
                            </button>

                            <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block"></div>
                        </span>

                        <button
                            @click="toggleDownvote"
                            :class="downvoted ? 'text-red-700 hover:text-red-500' : 'text-sl-text hover:text-red-700'"
                            class="text-2xl cursor-pointer">
                                <i :class="downvoted ? 'fa-solid' : 'fa-light'" class="fa-light fa-down"></i>
                        </button>

                    </div>
                    <div class="flex w-[53%] justify-between items-center">
                        <span class="h-full flex items-center sm:w-[20%] md:w-[30%]">

                            <button class="text-2xl cursor-pointer hover:text-yellow-500"><i
                                    class="fa-light fa-comment "></i></button>

                            <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">21</div>
                        </span>

                        <button class="text-xl cursor-pointer hover:text-cyan-700"><i
                                class="fa-light fa-bookmark"></i></button>

                        <button onclick="copyLink('{{ url('/post/' . $post->id) }}')"
                            class="text-xl cursor-pointer hover:scale-101">
                            <i class="fa-light fa-share-from-square "></i>
                        </button>
                    </div>
                @endauth

            </section>
        </article>
    @endforeach

</x-layout>

<script>
    function copyLink(link) {
        navigator.clipboard.writeText(link).then(function() {
            Swal.fire('', "Link berhasil disalin!", 'success');
        }, function(err) {
            console.error("Gagal menyalin link: ", err);
        });
    }
</script>
