<x-layout>
    <x-slot:title>SudutLain - Komentarku</x-slot:title>

    <!-- <div class="border flex items-center gap-2">
        <div data-svg-wrapper data-layer="ic:round-arrow-back">
            <button @click="history.back()" class="p-2 flex items-center">
                <i class="fa-light fa-chevron-left xl:text-xl"></i>
            </button>
        </div>
        <h1 class="text-xl font-bold text-sl-text">
            Komentar Saya
        </h1>
    </div> -->

    <div class="container rounded-md bg-sl-tertiary flex justify-between items-center px-2 py-2">
        <div class="flex items-center w-4">
            <button @click="history.back()" class="px-2">
                <i class="fa-light fa-chevron-left xl:text-xl"></i>
            </button>
        </div>
        <div class="flex justify-center items-center gap-3">
            <div class="flex items-center">
                <i class="fa-light fa-comment xl:text-xl"></i>
            </div>
            <h1 class="text-white text-sm font-medium leading-tight xl:text-base">Komentar Saya</h1>
        </div>
        <div class="w-10"></div>
    </div>

    @forelse ($comments as $comment)
        <article class="min-w-full max-w-full w-full min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 gap-y-2">
            <section @click="window.location.href = '/post/{{ $comment->post->id }}#comment-{{ $comment->id }}'"
                class="cursor-pointer">
                <div class="flex items-center gap-2">
                    <a href="/profile">
                        <img class="w-9 h-9 rounded-full object-cover"
                            src="{{ asset('storage/avatars/' . $comment->user->avatar) }}" alt="Avatar">
                    </a>
                    <div>
                        <p class="font-semibold text-sl-text/90">
                            {{ $comment->user->display_name ?? $comment->user->username }}
                        </p>
                        <p class="text-xs text-emerald-500/70">
                            {{ optional($comment->user->badges->first())->badge_name }}
                        </p>
                    </div>
                </div>
                <p class="mt-2 text-sm">{{ $comment->content }}</p>
                <p class="mt-1 text-xs text-sl-text/60 italic">Pada postingan: <a class="underline hover:text-blue-400"
                        href="/post/{{ $comment->post->id }}#comment-{{ $comment->id }}">{{ $comment->post->title }}</a></p>
            </section>
        </article>
    @empty
        <p class="text-center text-sl-text/60">Kamu belum membuat komentar apa pun.</p>
    @endforelse
</x-layout>
