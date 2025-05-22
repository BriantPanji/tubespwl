<x-layout>
    <x-slot:title>SudutLain - Notifikasi</x-slot:title>

    @php $notifications = auth()->user()->notifications @endphp
    <section>
        <h1 class="text-center text-2xl mb-2">Notifikasi</h1>
        @forelse ($notifications as $notification)
            {{-- @dd($notification->data) --}}
            @if ($notification->type == 'App\Notifications\VoteNotification')
                <article @click="window.location.href = '/post/{{ $notification->data['post_id'] }}'"
                    class="min-w-full max-w-full w-full min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 mb-2">
                    <section class="cursor-pointer">
                        <div class="flex items-center gap-2">
                            <a href="/profile">
                                <img class="w-9 h-9 rounded-full object-cover"
                                    src="{{ asset('storage/avatars/' . $notification->data['voter']['avatar']) }}"
                                    alt="Avatar">

                            </a>
                            <div class="flex items-center">
                                <p class="text-sm whitespace-pre">{{ $notification->data['message'] }} </p>
                                <p class="text-sm text-sl-text/60 italic">Pada postingan:
                                    <a class="underline hover:text-blue-400"
                                        href="/post/{{ $notification->data['post_id'] }}">{{ $notification->data['post_title'] }}</a>
                                </p>
                            </div>
                    </section>
                </article>
            @elseif($notification->type == 'App\Notifications\VoteCommentNotification')
                <article
                    @click="window.location.href = '/post/{{ $notification->data['post_id'] }}#comment-{{ $notification->data['comment_id'] }}'"
                    class="min-w-full max-w-full w-full min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 mb-2">
                    <section class="cursor-pointer">
                        <div class="flex items-center gap-2">
                            <a href="/profile">
                                <img class="w-9 h-9 rounded-full object-cover"
                                    src="{{ asset('storage/avatars/' . $notification->data['voter']['avatar']) }}"
                                    alt="Avatar">

                            </a>
                            <div class="flex items-center">
                                <p class="text-sm whitespace-pre">{{ $notification->data['message'] }} </p>
                                <p class="text-sm text-sl-text/60 italic">Pada postingan:
                                    <a class="underline hover:text-blue-400"
                                        href="/post/{{ $notification->data['post_id'] }}">{{ $notification->data['post_title'] }}</a>
                                </p>
                            </div>
                    </section>
                </article>
            @elseif($notification->type == 'App\Notifications\CommentNotification')
                <article
                    @click="window.location.href = '/post/{{ $notification->data['post_id'] }}#comment-{{ $notification->data['comment_id'] }}'"
                    class="min-w-full max-w-full w-full min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 mb-2">
                    <section class="cursor-pointer">
                        <div class="flex items-center gap-2">
                            <a href="/profile">
                                <img class="w-9 h-9 rounded-full object-cover"
                                    src="{{ asset('storage/avatars/' . $notification->data['user']['avatar']) }}"
                                    alt="Avatar">

                            </a>
                            <div class="flex items-center">
                                <p class="text-sm whitespace-pre">{{ $notification->data['message'] }} </p>
                                <p class="text-sm text-sl-text/60 italic">Pada postingan:
                                    <a class="underline hover:text-blue-400"
                                        href="/post/{{ $notification->data['post_id'] }}">{{ $notification->data['post_title'] }}</a>
                                </p>
                            </div>
                    </section>
                </article>
            @endif
        @empty
            <p class="text-center text-sl-text/60">Kamu belum memiliki notifikasi apa pun</p>
        @endforelse

</x-layout>
