<x-layout>
    <x-slot:title>Bookmarks</x-slot:title>

    <div class="container bg-sl-tertiary rounded-md max-w-full h-auto">
        <!-- Header -->
        <div class="container inline-flex py-1">
            <div class="container flex justify-start items-center gap-2 px-2 py-1">
                <div class="container flex justify-start items-center w-4">
                    <div class="IcRoundArrowBack relative">
                        <button @click="history.back()">
                            <i class="fa-light fa-chevron-left xl:text-xl"></i>
                        </button>
                    </div>
                </div>
                <div class="container flex justify-center items-center gap-2">
                    <i class="fa-light fa-bookmark xl:text-xl hover:text-yellow-500"></i>
                    <h1 class="text-white text-sm font-medium leading-tight xl:text-base">Tersimpan</h1>
                </div>
                <div class="container flex justify-start items-center w-4"></div>
            </div>
        </div>

        <hr class="text-sl-quinary">

        <!-- Info -->
        <div class="container inline-flex flex-col justify-start items-center gap-4 py-4">
            <h1 class="text-center text-white text-xs font-light leading-5 px-2 xl:text-base"><i>
                    Postingan yang disimpan bersifat rahasia dan hanya tersedia untuk Anda.</i>
            </h1>

            <!-- Post Images -->
            <div class="container inline-flex justify-center items-center gap-1 flex-wrap content-start">
                @forelse($bookmarks as $post)
                    {{-- @dd($post->attachments->first()->namafile) --}}


                    <a href="/post/{{ $post->id }}">
                        <div class="overflow-hidden">
                            <img class="size-27 rounded-md xl:size-40 object-cover hover:scale-[1.1] overflow-hidden duration-300"
                                src="{{ asset(\Illuminate\Support\Str::startsWith($post->attachments[0]->namafile, 'http') ? $post->attachments[0]->namafile : 'uploads/posts/' . $post->attachments[0]->namafile) }}"
                                alt="Bookmark Image" />
                        </div>
                    </a>

                @empty
                    <p class="text-white text-xs font-light italic px-2 xl:text-base">
                        Belum ada postingan disimpan.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
