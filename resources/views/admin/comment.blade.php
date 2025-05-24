<x-adminlayout>
    <x-slot:title>SudutLain - Comment yang Dilaporkan</x-slot:title>

    <!-- Header Section -->
    <section class="min-h-screen w-full bg-sl-base text-sl-text flex flex-col items-center px-4 md:px-18 lg:px-32 xl:px-40 2xl:px-52">

    <div
        class="container rounded-md bg-sl-tertiary flex justify-between items-center px-4 py-3 shadow-md shadow-black/40">
        <div class="flex items-center w-10">
            <button @click="history.back()" class="text-white hover:text-sl-secondary transition cursor-pointer">
                <i class="fa-light fa-chevron-left text-xl"></i>
            </button>
        </div>
        <div class="flex justify-center items-center gap-2">
            <i class="fa-light fa-exclamation-circle text-xl text-sl-secondary"></i>
            <h1 class="text-white text-base xl:text-lg font-semibold">Komentar yang Dilaporkan</h1>
        </div>
        <div class="w-10"></div>
    </div>

    <!-- Main Content -->
    <div class="container mt-6 space-y-4">
        @if ($reportedComs->isEmpty())
            <div class="text-center text-sl-text/60 py-8">Tidak ada Komentar yang dilaporkan.</div>
        @else
            @foreach ($reportedComs as $comment)
                <div
                    class="bg-sl-tertiary border border-sl-quinary rounded-xl shadow-md hover:shadow-lg transition duration-300 p-5 card-glow">
                    <div class="mb-2">
                        <h2 class="text-xl font-bold text-sl-text">{{ $comment->title }}</h2>
                        <p class="text-sm text-sl-text/70">Dicommenting oleh:
                            <span class="font-medium">{{ $comment->user->display_name }}</span>
                            <span class="text-xs text-sl-text/50">({{ $comment->user->username }})</span>
                        </p>
                        <p class="text-sm text-amber-400 mt-2">Dilaporkan sebanyak {{ $comment->reports->count() }} kali
                        </p>
                    </div>

                    <!-- Pelapor -->
                    <div class="mt-3">
                        <h3 class="text-sm text-sl-text/60 mb-1">Pelapor:</h3>
                        <ol class="list-decimal list-inside text-sm text-sl-text/80 space-y-1">
                            @foreach ($comment->reports as $reporter)
                                <li>
                                    <strong>{{ $reporter->display_name ?? $reporter->username }}</strong>:
                                    <span class="italic">"{{ $reporter->pivot->content }}"</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('post.detail', $comment->post->id) }}#comment-{{ $comment->id }}"
                            class="inline-block text-sm text-blue-400 hover:text-blue-500 hover:underline transition">
                            Lihat Komentar →
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    </section>
</x-adminlayout>
