<x-layout>
    <x-slot:title>SudutLain - Notifikasi</x-slot:title>

    @php
    $notifications = auth()->user()->notifications
    @endphp
    <h1 class="text-center text-md font-semibold xl:text-xl mb-2 mt-4">Notifikasi</h1>
    <section class="bg-sl-tertiary rounded-lg">
        @forelse ($notifications as $notification)
            {{-- @dd($notification) --}}
            @if ($notification->type == 'App\Notifications\VoteNotification')
                <article @click="window.location.href = '/post/{{ $notification->data['post_id'] }}'"
                    class="md:max-w-full w-full min-h-16 h-auto rounded-md flex flex-col p-3">
                    <section class="cursor-pointer">
                        <div class="flex items-center gap-2">
                            <a href="/profile">
                                <img class="w-9 rounded-full object-cover"
                                    src="{{ asset('uploads/avatars/' . $notification->data['voter']['avatar']) }}"
                                    alt="Avatar">
                            </a>
                            <div class="flex items-center justify-between w-full text-left md:ml-0 md:flex-row md:items-center">
                                <div class="ml-3">
                                    <div class="text-xs whitespace-pre flex">
                                        <p class="font-bold">{{ $notification->data['voter']['display_name']}}</p> {{ $notification->data['message'] }} </div>
                                    <p class="text-sm font-extralight opacity-70">{{ \Carbon\Carbon::parse($notification->data['post_created_at'])->diffForHumans() }}</p>

                                </div>
                                <div class="w-[50px] h-[50px]">
                                    <img src="{{ asset(\Illuminate\Support\Str::startsWith($post->attachments[0]->namafile, 'http') ? $post->attachments[0]->namafile : 'uploads/posts/' . $notification->data['post_img']) }}" class="object-cover w-[100%] h-[50px] rounded-md" alt="">
                                </div>
                            </div>
                    </section>
                </article>
            @elseif($notification->type == 'App\Notifications\VoteCommentNotification')
                <article
                    @click="window.location.href = '/post/{{ $notification->data['post_id'] }}#comment-{{ $notification->data['comment_id'] }}'"
                    class="md:max-w-full w-full min-h-16 h-auto rounded-md flex flex-col p-3">
                    <section class="cursor-pointer">
                        <div class="flex items-center gap-2">
                            <a href="/profile">
                                <img class="w-9 rounded-full object-cover"
                                    src="{{ asset('uploads/avatars/' . $notification->data['voter']['avatar']) }}"
                                    alt="Avatar">
                            </a>
                            <div class="flex items-center justify-between w-full text-left md:ml-0 md:flex-row md:items-center">
                                <div class="ml-3">
                                    <div class="text-sm whitespace-pre flex">
                                        <p class="font-bold">{{ $notification->data['voter']['display_name']}}</p> {{ $notification->data['message'] }} Anda "{{ Str::limit($notification->data['comment_content'], 15) }}" </div>
                                        <p class="text-sm font-extralight opacity-70">{{ \Carbon\Carbon::parse($notification->data['comment_created_at'])->diffForHumans() }}</p>
                                </div>
                                <div class="w-[50px] h-[50px]">
                                    <img src="{{ asset("uploads/post/" . $notification->data['post_img']) }}" class="object-cover w-[100%] h-[50px] rounded-md" alt="">
                                </div>
                            </div>
                    </section>
                </article>
            @elseif($notification->type == 'App\Notifications\CommentNotification')
                <article
                    @click="window.location.href = '/post/{{ $notification->data['post_id'] }}#comment-{{ $notification->data['comment_id'] }}'"
                    class="md:max-w-full w-full min-h-16 h-auto rounded-md flex flex-col p-3">
                    <section class="cursor-pointer">
                        <div class="flex items-center gap-2">
                            <a href="/profile">
                                <img class="w-9 rounded-full object-cover"
                                    src="{{ asset('uploads/avatars/' . $notification->data['user']['avatar']) }}"
                                    alt="Avatar">
                            </a>
                            <div class="flex items-center justify-between w-full text-left md:ml-0 md:flex-row md:items-center">
                                <div class="ml-3">
                                    <div class="text-sm whitespace-pre flex">
                                        <p class="font-bold">{{ $notification->data['user']['display_name']}}</p> {{ $notification->data['message'] }} "{{ Str::limit($notification->data['comment_content'], 15) }}" </div>
                                        <p class="text-sm font-extralight opacity-70">{{ \Carbon\Carbon::parse($notification->data['comment_created_at'])->diffForHumans() }}</p>
                                </div>
                                <div class="w-[50px] h-[50px]">
                                    <img src="{{ asset("uploads/post/" . $notification->data['post_img']) }}" class="object-cover w-[100%] h-[50px] rounded-md" alt="">
                                </div>
                            </div>
                    </section>
                </article>
            @endif
        @empty
            <p class="text-center text-sl-text/60">Kamu belum memiliki notifikasi apa pun</p>
        @endforelse
    </section>
</x-layout>
