<x-layout>
    <x-slot:title>SudutLain - Komentarku</x-slot:title>

    <h1 class="text-xl font-bold mb-4 text-sl-text">Komentar Saya</h1>

    @forelse ($comments as $comment)
        <article class="min-w-full max-w-full w-full min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 gap-y-2">
            <section @click="window.location.href = '/post/{{ $comment->post->id }}#comment-{{ $comment->id }}'"
                class="cursor-pointer">
                <div class="flex items-center gap-2">
                    <a href="/profile/{{ $comment->user_id }}">
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