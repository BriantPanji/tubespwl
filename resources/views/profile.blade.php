<x-layout>
    <x-slot:title>Profil Pengguna</x-slot:title>

    {{-- PROFIL UTAMA --}}
    <section class="w-full bg-sl-tertiary rounded-md p-6 flex flex-col gap-6">
        {{-- BAGIAN KIRI: FOTO + USERNAME & BIO --}}
        <div class="flex items-center gap-4">
            {{-- FOTO PROFIL --}}
            <div class="w-24 h-24 shrink-0">
                <img class="w-full h-full rounded-full border-4 border-white shadow-lg object-cover"
                    src="{{ asset('img/veszeta.jpg') }}" alt="Foto Profil">
            </div>

            {{-- USERNAME & BIO --}}
            <div class="flex flex-col text-left">
                <h1 class="text-xl font-bold text-sl-text/90">{{ $user->display_name }}</h1>
                <p class="text-sm leading-tight text-sl-text/90 ">{{ '@' . $user->username }}</p>
                <div>
                    <p class="text-sm text-sl-text/70 mt-1">
                        Isikan Badge gimana Panji🌶️🍜
                    </p>
                </div>
            </div>
        </div>

        <a href = "/profile/edit"
            class="bg-white/10 hover:bg-white/20 text-sm text-sl-text/90 px-4 py-2 rounded-md shadow-sm text-center">
            Edit Profil
        </a>
    </section>

    {{-- RINGKASAN AKTIVITAS --}}
    <section class="w-full bg-sl-tertiary mt-6 rounded-md p-6">
        <h2 class="text-lg font-semibold text-sl-text/90 mb-4">Summary of your activities:</h2>

        <div class="flex w-full gap-4">
            {{-- KIRI: POST, COMMENT, BADGE --}}
            <div class="w-3/5 flex flex-col gap-3 text-sl-text/80">
                <div class="flex items-center gap-2">
                    <i class="fa-light fa-photo-film-music w-5"></i>
                    <span>Post: <strong>{{ $postCount }}</strong></span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-light fa-comment w-5"></i>
                    <span>Comment: <strong>{{ $commentCount }}</strong></span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-light fa-wreath-laurel w-5"></i>
                    <span>Badge: <strong>{{ $badgeCount }}</strong></span>
                </div>
            </div>

            {{-- KANAN: VOTE, APA INI --}}
            <div class="w-2/5 flex flex-col gap-3 text-sl-text/80">
                <div class="flex items-center gap-2">
                    <i class="fa-light fa-up w-5"></i>
                    <span>Vote: <strong>{{ $postVoteCount }}</strong></span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-light fa-block-question w-5"></i>
                    <span>Bookmark: <strong>{{ $bookmarkCount }}</strong></span>
                </div>
            </div>
        </div>
    </section>

    {{-- TOMBOL AKSI --}}
    <section class="w-full h-full mt-6 rounded-md relative min-h-[200px] pb-16">
        <div class="flex flex-col items-center gap-4">
            {{-- Baris pertama: 2 tombol --}}
            <div class="flex gap-4 w-full justify-center">
                <a href="/my/post"
                    class="bg-white/10 hover:bg-white/20 text-sm text-sl-text/90 px-4 py-2 rounded-md shadow-sm w-48 text-center">
                    Lihat Postinganmu
                </a>
                <a href="/my/komentar"
                    class="bg-white/10 hover:bg-white/20 text-sm text-sl-text/90 px-4 py-2 rounded-md shadow-sm w-48 text-center">
                    Lihat Komentarmu
                </a>
            </div>

            {{-- Baris kedua: tombol tengah --}}
            <div class="flex gap-4 w-full justify-center">
                <a href="/my/vote"
                    class="bg-white/10 hover:bg-white/20 text-sm text-sl-text/90 px-4 py-2 rounded-md shadow-sm w-48 text-center">
                    Lihat Votinganmu
                </a>
                <a href="/my/bookmarks"
                    class="bg-white/10 hover:bg-white/20 text-sm text-sl-text/90 px-4 py-2 rounded-md shadow-sm w-48 text-center">
                    Lihat Bookmarksmu
                </a>
            </div>
        </div>
    </section>

    {{-- Tombol Logout Absolut --}}
    <div class="relative">
        <form action="{{ route('logout') }}" method="POST" class="absolute bottom-0 left-0 right-0 mx-auto w-full">
            @csrf
            <button type="submit"
                class="w-full bg-transparent border border-sl-primary hover:bg-red-900 hover:border-transparent font-semibold text-sm text-sl-text/90 px-4 py-2 rounded-md">
                Logout
            </button>
        </form>
    </div>
</x-layout>