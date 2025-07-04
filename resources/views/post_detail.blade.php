    <x-layout>

        @if (session('bct'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ session()->get('success') }}",
                icon: "success"
            });
        </script>
    @endif
        <x-slot:title>Detail Postingan</x-slot:title>

        <article
            class="relative min-w-full max-w-full w-full min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 gap-y-2">
            <button @click="history.back()" class="absolute top-4 left-4 z-10 cursor-pointer">
                <i class="fa-light fa-chevron-left xl:text-xl"></i>
            </button>
            <section x-data="{ showOption: false }" class="w-full min-h-12 flex items-center justify-between relative">
                <div class="max-w-[75%] h-full flex items-center gap-2 mt-10">
                    <a href="/profile/{{ $post->user->username }}"><img class="w-9 h-9 rounded-full"
                            src="{{ config('app.imagekit.url_endpoint') . $post->user->avatar }}"></a>
                    {{-- FOTO PROFIL USER --}}
                    <div class="flex flex-col h-full justify-center">
                        <a href="/profile/{{ $post->user->username }}"
                            class="text-sm lg:text-base font-semibold text-sl-text/90">
                            @php
                                $display_name = $post->user->first();
                            @endphp

                            @if ($display_name)
                                <span>{{ $post->user->display_name }}</span>
                            @else
                                <span>{{ $post->user->username }}</span>
                            @endif

                        </a>
                        <div class="text-[.65rem] lg:text-xs" style="color: {{ optional($post->user->badges->first())->badge_color ?? '#6b7280' }}">
                            @php
                                $firstBadge = $post->user->badges->first();
                            @endphp

                            @if ($firstBadge)
                                <span>
                                    {{ $firstBadge->badge_name }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="max-w-[20%] h-full flex items-center gap-2 text-2xl pr-2">
                    <button @click="showOption=!showOption" class="w-fit h-fit cursor-pointer"><i
                            class="fa-light fa-ellipsis"></i></button>
                </div>
                <div x-cloak x-show="showOption" @click.outside="showOption = false"
                    class="absolute top-8 right-0 min-w-20 max-w-25 h-auto bg-white/10 backdrop-blur-sm rounded-md shadow-lg flex flex-col gap-y-2 p-1 text-xs text-sl-text/90 z-50">
                    {{-- QUERY LAPORKAN (REPORT POST) DISINI --}}
                    @can('edit-post', $post)
                        <button @click="window.location.href='/post/{{ $post->id }}/edit'" class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1">Edit Post</button>
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
                                    axios.post('/post/{{ $post->id }}', {
                                        _method: 'DELETE',
                                        data: {
                                            _token: '{{ csrf_token() }}'
                                        }
                                    })
                                    .then((res) => {
                                        console.log(res);   
                                        Swal.fire('Berhasil!', 'Postingan berhasil dihapus!', 'success')
                                        .then(() => {
                                            window.location.href = '/';
                                        });
                                    })
                                    .catch((error) => {
                                        console.error(error);
                                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus postingan.', 'error')
                                    });
                                }
                            }) "
                            class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1 text-red-600 font-bold">
                            Hapus Post
                        </button>
                    @endcan
                    @auth
                        <button
                        @click="
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
                                    axios.post('/post/{{ $post->id }}/report', {
                                        reason: reason,
                                        _token: '{{ csrf_token() }}'
                                    })
                                    .then(() => {
                                        Swal.fire('Berhasil!', 'Postingan berhasil dilaporkan!', 'success')
                                    })
                                    .catch((error) => {
                                        if (error.response.status === 403 && error.response.data.message.startsWith('You have already reported')) {
                                            Swal.fire('Gagal!', 'Anda Sudah melaporkan Postingan ini', 'error')
                                        } else {
                                            console.error(error);
                                            Swal.fire('Gagal!', 'Terjadi kesalahan saat melaporkan postingan.', 'error')
                                        }
                                    });
                                }
                            })"
                        class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1">Laporkan</button>
                    @endauth
                    @guest
                        <button @click="window.location.href = '/login'"
                            class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1">Laporkan</button>
                    @endguest
                </div>
            </section>

            <section class="w-full min-h-12 !h-auto flex flex-col justify-start items-start " x-cloak>
                {{-- URL MENUJU DETAIL POST INI --}}
                <small class="text-xs opacity-50">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small>

                <div class="w-full h-full max-w-full max-h-full truncate font-bold text-base md:text-lg">
                    {{-- JUDUL POST --}}
                    {{ $post->title }}
                </div>
                <div class="w-full font-light text-xs md:text-sm relative ">
                    <p class="">
                        {{-- CONTENT POST --}}
                        {!! nl2br(e($post->content)) !!}
                        {{-- @foreach ($post->tag as $tag)
                            <a href="/tagar/{{ $tag->name }}" class="text-blue-500 italic">#{{ $tag->name }}</a>
                        @endforeach --}}
                    </p>
                    <section class="w-full h-7 mt-1 flex gap-1">
                            @if ($post->tag)
                                @foreach ($post->tag as $tag)
                                    <a href="/tagar/{{ $tag->name }}"
                                        class="text-blue-600 font-normal tracking-wide text-xs md:text-sm italic rounded-md hover:text-blue-500 hover:underline">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            @endif
                    </section>

                    {{-- Place Name & URL Gmaaps --}}
                    <section class="py-2 min-w-fit max-w-fit space-y-1.5">
                        <div
                            class="container inline-flex justify-start items-center gap-2 text-shadow-lg font-semibold ">
                            <input type="text" id="place_name" value="{{ $post->place_name }}"
                                class="bg-white/10 rounded-md min-w-[80%] w-fit max-w-full focus:ring-blue-500 outline-none focus:border-blue-500 block px-2 py-1 line-clamp-4"
                                readonly>
                        </div>

                        <div class="container inline-flex justify-start items-center gap-2"
                            onclick="window.open('{{ $post->gmap_url }}', '_blank')">
                            <input type="text" id="gmap-url" value="{{ $post->gmap_url }}"
                                class="bg-white/10 rounded-md min-w-[80%] cursor-pointer w-fit max-w-full focus:ring-blue-500 outline-none focus:border-blue-500 block px-2 py-1 line-clamp-4 text-blue-500 hover:underline"
                                readonly>
                            <button onclick="window.open('{{ $post->gmap_url }}', '_blank')"
                                class="py-1 px-2 bg-sl-senary rounded-md cursor-pointer border border-sl-senary hover:scale-90 focus:ring-1 focus:outline-none focus:ring-blue-300 ">
                                {{-- ICON GMAP --}}
                                <i class="fa-light fa-location-dot text-sm"></i>
                            </button>
                        </div>
                        <div
                            class="container inline-flex justify-start items-center gap-2 text-shadow-lg font-semibold">
                            <input type="text" id="place_name" value="{{ $post->location }}"
                                class="bg-white/10 rounded-md min-w-[80%] w-fit max-w-full focus:ring-blue-500 outline-none focus:border-blue-500 block px-2 py-1 line-clamp-4"
                                readonly>
                        </div>

                        
                    </section>

                </div>
            </section>
            <section class="swiper mySwiperClass w-full max-w-xl h-fit relative bg-sl-quinary rounded-xl">
                <div class="swiper-wrapper h-fit flex items-center">
                    <!-- Slides -->
                    @foreach ($post->attachments as $attachment)
                        <div class="swiper-slide h-full">
                            <img class="w-full h-full rounded-xl"
                                src="{{ config('app.imagekit.url_endpoint') . $attachment->namafile }}">
                        </div>
                    @endforeach
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
                {{-- If we need controls --}}
                <button
                    class="swiper-button-prev !text-white after:content-[''] after:!text-sm text-shadow-lg opacity-80 md:after:!text-xl xl:after:!text-2xl"></button>
                <button
                    class="swiper-button-next !text-white after:content-[''] after:!text-sm text-shadow-lg opacity-80 md:after:!text-xl xl:after:!text-2xl"></button>

            </section>
            <section
                class="w-full min-h-3 h-10 flex items-center bg-[#42394a] mt-1 rounded-md px-3 md:px-5 xl:px-8 2xl:px-10 text-2xl justify-between">
                @guest

                    {{-- ISI '/{DISINI}' DENGAN URI DARI DETAIL POSTINGAN INI --}}
                    <div  class="flex w-[35%] md:w-[30%] justify-between">
                        <span class="h-full flex items-center sm:w-[40%]">

                            <button @click="window.location.href = '/login'"
                                class="text-2xl cursor-pointer hover:text-emerald-500"><i
                                    class="fa-light fa-up "></i></button>

                                    <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">
                                        {{ $post->upvoted_by_count }}
                                    </div>
                        </span>

                        <button @click="window.location.href = '/login'"
                            class="text-2xl cursor-pointer hover:text-red-700"><i class="fa-light fa-down"></i></button>

                    </div>
                    <div class="flex w-[53%] justify-between items-center">
                        <span class="h-full flex items-center sm:w-[20%] md:w-[30%]">

                            <button id="commentButton" class="text-2xl cursor-pointer hover:text-yellow-500"><i
                                    class="fa-light fa-comment "></i></button>

                            <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">
                                {{ $post->comments->count() }}
                            </div>
                        </span>

                        <button @click="window.location.href = '/login'"
                            class="text-xl cursor-pointer hover:text-cyan-700"><i class="fa-light fa-bookmark"></i></button>

                        <button class="text-xl cursor-pointer hover:scale-101"><i
                                class="fa-light fa-share-from-square "></i></button>
                    </div>
                @endguest

                @auth
                    <div x-data="{
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
                                    $refs.voteCount.innerText = parseInt($refs.voteCount.innerText) + (this.upvoted ? 1 : -1);
                                })
                                .catch(err => console.error(err))
                                .finally(() => this.loading = false);
                        },
                        toggleDownvote() {
                            if (this.loading) return;
                            this.loading = true;
                            axios.post('/post/{{ $post->id }}/downvote', { _token: '{{ csrf_token() }}' })
                                .then(() => {
                                    const wasUpvoted = this.upvoted;
                                    const wasDownvoted = this.downvoted;
                                    this.downvoted = !this.downvoted;
                                    if (this.downvoted) this.upvoted = false; // Downvote aktif, upvote harus nonaktif
                                    let ogCount = {{ $post->upvoted_by_count }};
                                    let current = parseInt($refs.voteCount.innerText);
                                    if (wasDownvoted && !wasUpvoted) current += 0;
                                    else if (wasUpvoted) current -= 1;
                                    else if (!wasUpvoted && wasDownvoted) current -= 1;


                                    $refs.voteCount.innerText = current;
                                })
                                .catch(err => console.error(err))
                                .finally(() => this.loading = false);
                        }
                    }" class="flex w-[35%] md:w-[30%] justify-between">
                        <span class="h-full flex items-center sm:w-[40%]">
                            <button @click="toggleUpvote"
                                :class="upvoted ? 'text-emerald-500 hover:text-emerald-700' :
                                    'text-sl-text hover:text-emerald-500'"
                                class="text-2xl cursor-pointer">
                                <i :class="upvoted ? 'fa-solid' : 'fa-light'" class="fa-up"></i>
                            </button>

                            <div x-ref="voteCount" class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">
                                {{ $post->upvoted_by_count }}
                            </div>
                        </span>
                        <button @click="toggleDownvote"
                            :class="downvoted ? 'text-red-700 hover:text-red-500' : 'text-sl-text hover:text-red-700'"
                            class="text-2xl cursor-pointer">
                            <i :class="downvoted ? 'fa-solid' : 'fa-light'" class="fa-light fa-down"></i>
                        </button>

                    </div>
                    <div class="flex w-[53%] justify-between items-center">
                        <span class="h-full flex items-center sm:w-[20%] md:w-[30%]">
                            <button id="commentButton" class="text-2xl cursor-pointer hover:text-yellow-500"><i
                                    class="fa-light fa-comment "></i></button>
                            <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">
                                {{ $post->comments->count() }}
                            </div>
                        </span>

                        <button x-data="{
                            bookmarked: {{ auth()->user()->hasBookmarkedPost($post) ? 'true' : 'false' }},
                            loading: false,
                            toggleBookmark() {
                                if (this.loading) return;
                                this.loading = true;
                                axios.post('/post/{{ $post->id }}/bookmark', { _token: '{{ csrf_token() }}' })
                                    .then(() => {
                                        this.bookmarked = !this.bookmarked;
                                    })
                                    .catch(err => console.error(err))
                                    .finally(() => this.loading = false);
                            },
                        }" @click="toggleBookmark"
                            :class="bookmarked ? 'text-cyan-500 hover:text-cyan-700' :
                                'text-sl-text hover:text-cyan-500'"
                            class="text-xl cursor-pointer hover:text-cyan-700">
                            <i :class="bookmarked ? 'fa-solid' : 'fa-light'" class="fa-bookmark"></i></button>

                        <button onclick="copyLink('{{ url('/post/' . $post->id) }}')"
                            class="text-xl cursor-pointer hover:scale-101">
                            <i class="fa-light fa-share-from-square "></i>
                        </button>
                        <script>
                            function copyLink(link) {
                                navigator.clipboard.writeText(link).then(function() {
                                    Swal.fire('', "Link berhasil disalin!", 'success');
                                }, function(err) {
                                    console.error("Gagal menyalin link: ", err);
                                });
                            }
                        </script>
                    </div>
                @endauth
            </section>
        </article>

        {{-- Komentar-container --}}

        <form action="{{ route('post.comment', $post->id) }}" method="POST">
            @csrf
            <div class="mt-1 px-2">
                <div class="">
                    <div class="flex justify-between items-center">
                        @auth
                            <img src="{{ config('app.imagekit.url_endpoint') . auth()->user()->avatar }}" class="w-[32px] !aspect-square rounded-full"
                                alt="Foto User">
                        @else
                            <img src="{{ config('app.imagekit.url_endpoint') . 'blankprofile.png' }}" class="w-[32px] rounded-full"
                                alt="Foto Default">
                        @endauth
                        <input type="text" name="content" id="comment"
                            class="ml-1 w-[80%] px-2 bg-[#42394a] rounded-sm p-2 focus:outline-none"
                            placeholder="Tambahkan komentar Anda">
                        <button type="submit">
                            <i class="fa-light fa-paper-plane-top text-xl hover:opacity-70 cursor-pointer"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>


        {{-- Komentar --}}
        <article x-data class="min-w-full max-w-full w-full min-h-16 pb-5 bg-sl-tertiary rounded-md flex flex-col gap-y-2">
            <h1 class="mt-1 text-center text-[14px]">Komentar</h1>

            @forelse ($comments as $comment)
                <div x-ref="comment_{{ $comment->id }}" class="mt-1 px-3">
                    <div class="flex gap-2.5 items-start">
                        <img @click="window.location.href = '/profile/{{ $comment->user->username }}'" src="{{ config('app.imagekit.url_endpoint') . $comment->user->avatar }}" class="w-[32px] rounded-full mt-2 !aspect-square cursor-pointer"
                            alt="Foto User">
                        <div class="w-full px-1 bg-[#42394a] rounded-md p-2" id="comment-{{ $comment->id }}">
                            <div class="py-.5 px-2.5">
                                <div class="flex justify-between items-center relative" x-data="{ showOption: false }">
                                    <a
                                        href="/profile/{{ $comment->user->username }}">{{ $comment->user->display_name }}</a>
                                    <button @click="showOption=!showOption" class="cursor-pointer"><i
                                            class="fa-light fa-ellipsis text-2xl"></i></button>

                                    <div x-cloak x-show="showOption" @click.outside="showOption = false"
                                        class="absolute top-5 right-0 w-25 h-auto bg-white/10 backdrop-blur-sm rounded-md shadow-lg flex flex-col gap-y-2 p-1 text-xs text-sl-text/90 z-50">
                                        {{-- QUERY LAPORKAN (REPORT POST) DISINI --}}
                                        @can('edit-comment', $comment)
                                            <button @click="
                                                Swal.fire({
                                                    title: 'Hapus Komentar',
                                                    text: 'Apakah anda yakin ingin menghapus komentar ini?',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Hapus',
                                                    cancelButtonText: 'Batal',
                                                    allowOutsideClick: false
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        axios.post('/comment/{{ $comment->id }}', {
                                                            _method: 'DELETE',
                                                            data: {
                                                                _token: '{{ csrf_token() }}'
                                                            }
                                                        })
                                                        .then(() => {
                                                            Swal.fire('Berhasil!', 'Komentar berhasil dihapus!', 'success')
                                                            $refs['comment_{{ $comment->id }}'].remove();
                                                        })
                                                        .catch((error) => {
                                                            console.error(error);
                                                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus komentar.', 'error')
                                                        });
                                                    }
                                                }) "
                                                class="w-max h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1 text-red-600 font-bold">
                                                Hapus Komen
                                            </button>
                                        @endcan
                                        @auth
                                            <button
                                            @click="
                                                Swal.fire({
                                                    title: 'Laporkan Komentar',
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
                                                        axios.post('/comment/{{ $comment->id }}/report', {
                                                            reason: reason,
                                                            _token: '{{ csrf_token() }}'
                                                        })
                                                        .then(() => {
                                                            Swal.fire('Berhasil!', 'Komentar berhasil dilaporkan!', 'success')
                                                        })
                                                        .catch((error) => {
                                                            if (error.response.status === 403 && error.response.data.message.startsWith('You have already reported')) {
                                                                Swal.fire('Gagal!', 'Anda Sudah melaporkan Komentar ini', 'error')
                                                            } else {
                                                                console.error(error);
                                                                Swal.fire('Gagal!', 'Terjadi kesalahan saat melaporkan komentar.', 'error')
                                                            }
                                                        });
                                                    }
                                                })"
                                            class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1">Laporkan</button>
                                        @endauth
                                        @guest
                                            <button @click="window.location.href = '/login'"
                                                class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1">Laporkan</button>
                                        @endguest

                                    </div>
                                </div>
                                <p class="text-sm font-extralight" 
                                    style="color: {{ optional($comment->user->badges->first())->badge_color ?? '#6b7280' }}"    
                                >
                                {{ optional($comment->user->badges->first())->badge_name ?? ' ' }}
                            </p>
                                <p class="font-extralight mt-2 leading-tight">{{ $comment->content }}</p>
                                <div class="flex justify-between mt-2">
                                    <div class="items-center text-sm opacity-50">
                                        <small>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</small>
                                    </div>

                                    @auth
                                        {{-- VOte komeen --}}
                                        <div x-data="{
                                            upvoted: {{ auth()->user()->hasUpvotedComment($comment) ? 'true' : 'false' }},
                                            downvoted: {{ auth()->user()->hasDownvotedComment($comment) ? 'true' : 'false' }},
                                            loading: false,
                                            toggleUpvote() {
                                                if (this.loading) return;
                                                this.loading = true;
                                                axios.post('/comment/{{ $comment->id }}/upvote', { _token: '{{ csrf_token() }}' })
                                                    .then(() => {
                                                        this.upvoted = !this.upvoted;
                                                        if (this.upvoted) this.downvoted = false; // Upvote aktif, downvote harus nonaktif
                                                        $refs.voteCount.innerText = parseInt($refs.voteCount.innerText) + (this.upvoted ? 1 : -1);
                                                    })
                                                    .catch(err => console.error(err))
                                                    .finally(() => this.loading = false);
                                            },
                                            toggleDownvote() {
                                                if (this.loading) return;
                                                this.loading = true;
                                                axios.post('/comment/{{ $comment->id }}/downvote', { _token: '{{ csrf_token() }}' })
                                                    .then(() => {
                                                        const wasUpvoted = this.upvoted;
                                                        const wasDownvoted = this.downvoted;
                                                        this.downvoted = !this.downvoted;
                                                        if (this.downvoted) this.upvoted = false; // Downvote aktif, upvote harus nonaktif
                                                        let ogCount = {{ $post->upvoted_by_count }};
                                                        let current = parseInt($refs.voteCount.innerText);
                                                        if (wasDownvoted && !wasUpvoted) current += 0;
                                                        else if (wasUpvoted) current -= 1;
                                                        else if (!wasUpvoted && wasDownvoted) current -= 1;


                                                        $refs.voteCount.innerText = current;
                                                    })
                                                    .catch(err => console.error(err))
                                                    .finally(() => this.loading = false);
                                            }
                                        }" class="flex items-center justify-end gap-2">
                                            <button @click="toggleDownvote"
                                                :class="downvoted ? 'text-red-700 hover:text-red-500' :
                                                    'text-sl-text hover:text-red-700'"
                                                class="text-2xl cursor-pointer">
                                                <i :class="downvoted ? 'fa-solid' : 'fa-light'"
                                                    class="fa-light fa-down"></i>
                                            </button>
                                            <button @click="toggleUpvote"
                                                :class="upvoted ? 'text-emerald-500 hover:text-emerald-700' :
                                                    'text-sl-text hover:text-emerald-500'"
                                                class="text-2xl cursor-pointer">
                                                <i :class="upvoted ? 'fa-solid' : 'fa-light'" class="fa-up"></i>
                                            </button>

                                            <div x-ref="voteCount" class="text-xs"> {{ $comment->upvoted_by_count }}</div>
                                        </div>
                                        @endauth
                                        @guest
                                        <div class="flex items-center justify-end gap-2">

                                            <button @click="window.location.href = '/login'"
                                            class="text-2xl cursor-pointer text-sl-text hover:text-red-700">
                                            <i class="fa-light fa-down"></i>
                                            </button>

                                            <button @click="window.location.href = '/login'"
                                            class="text-2xl cursor-pointer text-sl-text hover:text-emerald-500">
                                            <i class="fa-light fa-up"></i>
                                            </button>

                                            <div x-ref="voteCount" class="text-xs"> {{ $comment->upvoted_by_count }}</div>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="flex justify-center opacity-50 text-white text-xs font-light italic px-2 xl:text-base">
                        Belum ada Komentar diposting.
                    </p>
            @endforelse
        </article>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const hash = window.location.hash;

                // Jika hash adalah #comment (form komentar), jalankan scroll biasa
                if (hash === "#comment") {
                    setTimeout(() => {
                        const el = document.getElementById('comment');
                        if (el) {
                            const yOffset = -100;
                            const y = el.getBoundingClientRect().top + window.pageYOffset + yOffset;
                            window.scrollTo({
                                top: y,
                                behavior: 'smooth'
                            });
                            el.focus();
                        }
                    }, 100);
                }

                // Jika hash adalah #comment-{id} (komentar spesifik), scroll ke komentar tersebut
                else if (hash.startsWith("#comment-")) {
                    setTimeout(() => {
                        const el = document.getElementById(hash.substring(1)); // Ambil ID tanpa #
                        if (el) {
                            const yOffset = -50; // Offset lebih kecil agar tidak terlalu jauh dari komentar
                            const y = el.getBoundingClientRect().top + window.pageYOffset + yOffset;

                            window.scrollTo({
                                top: y,
                                behavior: 'smooth'
                            });

                            // Tambahkan efek highlight sementara
                            el.classList.add("ring-custom-highlight");
                            setTimeout(() => {
                                el.classList.remove("ring-custom-highlight");
                            }, 2000);
                        }
                    }, 100);
                }
            });

            // Comment Button
            const commentButton = document.getElementById('commentButton');
            commentButton.addEventListener('click', function() {
                const el = document.getElementById('comment');
                if (el) {
                    const yOffset = -100; // sesuaikan offset
                    const y = el.getBoundingClientRect().top + window.pageYOffset + yOffset;
                    window.scrollTo({
                        top: y,
                        behavior: 'smooth'
                    });

                    el.focus();
                }
            })
        </script>
    </x-layout>
