<x-layout>
    <x-slot:title>Profil Pengguna</x-slot:title>

    @if (session('success'))
        <script>
            Swal.fire('', "{{ session('success') }}", 'success');
        </script>
    @endif

    {{-- PROFIL UTAMA --}}
    <section class="relative bg-sl-tertiary rounded-md p-6 flex flex-col gap-6">
        <button @click="history.back()" class="absolute top-4 left-4">
            <i class="fa-light fa-chevron-left xl:text-xl"></i>
        </button>
        {{-- BAGIAN KIRI: FOTO + USERNAME & BIO --}}
        <div class="flex mt-6 items-center gap-4">
            {{-- FOTO PROFIL --}}
            <div class="w-24 h-24 shrink-0">
                <img class="w-full h-full rounded-full border-4 border-white shadow-lg object-cover"
                    src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Foto Profil">
            </div>

            {{-- USERNAME & BIO --}}
            <div class="flex flex-col text-left max-w-5/8 xl:max-w-14/18"> {{-- ini ganti --}}
                <h1 class="text-xl font-bold text-sl-text/90 ">{{ $user->display_name }}</h1>
                <p class="text-sm leading-tight text-sl-text/90">{{ '@' . $user->username }}</p>
                <div
                    class="w-full  flex items-center customScrollbar h-10 rounded-md mt-2 overflow-x-auto overflow-y-hidden inset-shadow-2xs">
                    <div class="min-w-full h-full flex items-center gap-1.5 px-1.5 *:whitespace-nowrap">
                        @foreach ($user->badges()->get() as $badge)
                            <span
                                class="text-sm cursor-pointer min-w-fit max-h-full bg-sl-quinary px-1.5 py-1 rounded-md flex gap-1 group"
                                style="color:{{ $badge->badge_color }}"><img class="max-h-full w-5"
                                    src="{{ asset('img/badge/' . $badge->badge_icon) }}" alt=""> <b
                                    class="flex items-center justify-center font-normal group-hover:scale-101">{{ $badge->badge_name }}</b></span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @auth
            @if (auth()->user()->username == $user->username)
                <a href="{{ route('profile.edit') }}"
                    class="bg-white/10 hover:bg-white/20 text-sm text-sl-text/90 px-4 py-2 rounded-md shadow-sm text-center">
                    Edit Profil
                </a>
            @endif
        @endauth
    </section>

    {{-- RINGKASAN AKTIVITAS --}}
    <section class=" bg-sl-tertiary rounded-md p-6">
        <h2 class="text-lg font-semibold text-sl-text/90 mb-8 text-center">Summary of your activities</h2>

        {{-- ANIMASI COUNT --}}

        <div
            class="container max-w-full inline-flex justify-center items-center gap-5 flex-wrap content-center xl:gap-x-10 xl:gap-y-8">

            {{-- POST COUNT --}}
            <div class="inline-flex flex-col justify-start items-center gap-1" x-data="{
                count: 0,
                target: {{ $postCount }},
                scrambleDuration: 1250,
                finalDuration: 50,
                interval: null,
                start() {
                    {{-- Scramble random angka dulu --}}
                    this.interval = setInterval(() => {
                        this.count = Math.floor(Math.random() * (this.target + 10));
                        {{-- acak sampai sedikit di atas target --}}
                    }, 50);

                    {{-- // Setelah scrambleDuration, set ke angka asli --}}
                    setTimeout(() => {
                        clearInterval(this.interval);
                        let current = 0;
                        let step = this.target / (this.finalDuration / 30);
                        this.interval = setInterval(() => {
                            current += step;
                            this.count = Math.floor(current);
                            if (this.count >= this.target) {
                                this.count = this.target;
                                clearInterval(this.interval);
                            }
                        }, 30);
                    }, this.scrambleDuration);
                }
            }"
                x-init="start()">
                <div class="inline-flex justify-center items-center bg-white/8 rounded-full size-16 mb-2">
                    <i class="fa-light fa-rectangle-history text-sl-senary text-3xl"></i>
                </div>
                <div class="flex items-center gap-x-2">
                    <span>
                        <div class="transition-transform duration-300 ease-out max-w-full font-bold align-items-center justify-center flex text-3xl"
                            :class="{ 'scale-105': count < target }" x-text="count"> {{-- DISINI ATUR STYLENYAA --}}
                            0
                        </div>
                        <h2 class="">Post</h2>
                    </span>
                </div>
            </div>

            {{--  COMMENT COUNT --}}
            <div class="inline-flex flex-col justify-start items-center gap-1" x-data="{
                count: 0,
                target: {{ $commentCount }},
                scrambleDuration: 1250,
                finalDuration: 50,
                interval: null,
                start() {
                    {{-- Scramble random angka dulu --}}
                    this.interval = setInterval(() => {
                        this.count = Math.floor(Math.random() * (this.target + 10));
                        {{-- acak sampai sedikit di atas target --}}
                    }, 50);

                    {{-- // Setelah scrambleDuration, set ke angka asli --}}
                    setTimeout(() => {
                        clearInterval(this.interval);
                        let current = 0;
                        let step = this.target / (this.finalDuration / 30);
                        this.interval = setInterval(() => {
                            current += step;
                            this.count = Math.floor(current);
                            if (this.count >= this.target) {
                                this.count = this.target;
                                clearInterval(this.interval);
                            }
                        }, 30);
                    }, this.scrambleDuration);
                }
            }"
                x-init="start()">
                <div class="inline-flex justify-center items-center bg-white/8 rounded-full size-16 mb-2">
                    <i class="fa-light fa-comment text-sl-senary text-3xl"></i>
                </div>
                <div class="flex items-center gap-x-2">
                    <span>
                        <div class="transition-transform duration-300 ease-out max-w-full font-bold align-items-center justify-center flex text-3xl"
                            :class="{ 'scale-105': count < target }" x-text="count"> {{-- DISINI ATUR STYLENYAA --}}
                            0
                        </div>
                        <h2 class="">Komentar</h2>
                    </span>
                </div>
            </div>

            {{-- BADGE COUNT --}}
            <div class="inline-flex flex-col justify-start items-center gap-1" x-data="{
                count: 0,
                target: {{ $badgeCount }},
                scrambleDuration: 1250,
                finalDuration: 50,
                interval: null,
                start() {
                    {{-- Scramble random angka dulu --}}
                    this.interval = setInterval(() => {
                        this.count = Math.floor(Math.random() * (this.target + 10));
                        {{-- acak sampai sedikit di atas target --}}
                    }, 50);

                    {{-- // Setelah scrambleDuration, set ke angka asli --}}
                    setTimeout(() => {
                        clearInterval(this.interval);
                        let current = 0;
                        let step = this.target / (this.finalDuration / 30);
                        this.interval = setInterval(() => {
                            current += step;
                            this.count = Math.floor(current);
                            if (this.count >= this.target) {
                                this.count = this.target;
                                clearInterval(this.interval);
                            }
                        }, 30);
                    }, this.scrambleDuration);
                }
            }"
                x-init="start()">
                <div class="inline-flex justify-center items-center bg-white/8 rounded-full size-16 mb-2">
                    <i class="fa-light fa-shield text-sl-senary text-3xl"></i>
                </div>
                <div class="flex items-center gap-x-2">
                    <span>
                        <div class="transition-transform duration-300 ease-out max-w-full font-bold align-items-center justify-center flex text-3xl"
                            :class="{ 'scale-105': count < target }" x-text="count"> {{-- DISINI ATUR STYLENYAA --}}
                            0
                        </div>
                        <h2 class="">Badge</h2>
                    </span>
                </div>
            </div>

            {{-- VOTE COUNT --}}
            <div class="inline-flex flex-col justify-start items-center gap-1" x-data="{
                count: 0,
                target: {{ $postVoteCount }},
                scrambleDuration: 1250,
                finalDuration: 50,
                interval: null,
                start() {
                    {{-- Scramble random angka dulu --}}
                    this.interval = setInterval(() => {
                        this.count = Math.floor(Math.random() * (this.target + 10));
                        {{-- acak sampai sedikit di atas target --}}
                    }, 50);

                    {{-- // Setelah scrambleDuration, set ke angka asli --}}
                    setTimeout(() => {
                        clearInterval(this.interval);
                        let current = 0;
                        let step = this.target / (this.finalDuration / 30);
                        this.interval = setInterval(() => {
                            current += step;
                            this.count = Math.floor(current);
                            if (this.count >= this.target) {
                                this.count = this.target;
                                clearInterval(this.interval);
                            }
                        }, 30);
                    }, this.scrambleDuration);
                }
            }"
                x-init="start()">
                <div class="inline-flex justify-center items-center bg-white/8 rounded-full size-16 mb-2">
                    <i class="fa-light fa-up text-sl-senary text-3xl"></i>
                </div>
                <div class="flex items-center gap-x-2">
                    <span>
                        <div class="transition-transform duration-300 ease-out max-w-full font-bold align-items-center justify-center flex text-3xl"
                            :class="{ 'scale-105': count < target }" x-text="count"> {{-- DISINI ATUR STYLENYAA --}}
                            0
                        </div>
                        <h2 class="">Vote</h2>
                    </span>
                </div>
            </div>

            {{-- BOOKMARK COUNT --}}
            <div class="inline-flex flex-col justify-start items-center gap-1" x-data="{
                count: 0,
                target: {{ $bookmarkCount }},
                scrambleDuration: 1250,
                finalDuration: 50,
                interval: null,
                start() {
                    {{-- Scramble random angka dulu --}}
                    this.interval = setInterval(() => {
                        this.count = Math.floor(Math.random() * (this.target + 10));
                        {{-- acak sampai sedikit di atas target --}}
                    }, 50);

                    {{-- // Setelah scrambleDuration, set ke angka asli --}}
                    setTimeout(() => {
                        clearInterval(this.interval);
                        let current = 0;
                        let step = this.target / (this.finalDuration / 30);
                        this.interval = setInterval(() => {
                            current += step;
                            this.count = Math.floor(current);
                            if (this.count >= this.target) {
                                this.count = this.target;
                                clearInterval(this.interval);
                            }
                        }, 30);
                    }, this.scrambleDuration);
                }
            }"
                x-init="start()">
                <div class="inline-flex justify-center items-center bg-white/8 rounded-full size-16 mb-2">
                    <i class="fa-light fa-bookmark text-sl-senary text-2xl"></i>
                </div>
                <div class="flex items-center gap-x-2">
                    <span>
                        <div class="transition-transform duration-300 ease-out max-w-full font-bold align-items-center justify-center flex text-3xl"
                            :class="{ 'scale-105': count < target }" x-text="count"> {{-- DISINI ATUR STYLENYAA --}}
                            0
                        </div>
                        <h2 class="">Tersimpan</h2>
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- TOMBOL AKSI --}}
    <section class=" bg-sl-tertiary rounded-md p-6">
        <div class="container inline-flex justify-center items-center gap-1 flex-wrap content-start">
            @forelse($myposts as $post)
                <a href="/post/{{ $post->id }}">
                    <div class="overflow-hidden">
                        <img class="size-27 rounded-md xl:size-40 object-cover hover:scale-[1.1] overflow-hidden duration-300"
                            src="{{ asset('storage/posts/' . $post->attachments[0]->namafile) }}"
                            alt="Bookmark Image" />
                    </div>

                </a>

            @empty
                <p class="text-center justify-start text-white text-xs font-light leading-5 px-2 xl:text-base italic">
                    Belum ada postingan yang dibuat.</p>
            @endforelse
        </div>
    </section>

    {{-- Tombol Logout Absolut --}}
    <div class="relative mt-9">
        <form action="{{ route('logout') }}" method="POST" class="absolute bottom-0 left-0 right-0 mx-auto w-full">
            @csrf
            <button type="submit"
                class="w-full bg-transparent border border-sl-primary hover:bg-red-900 hover:border-transparent font-semibold text-sm text-sl-text/90 px-4 py-2 rounded-md">
                Logout
            </button>
        </form>
    </div>
</x-layout>
