<x-layout>
    <x-slot:title>Bookmarks</x-slot:title>

    <div class="container bg-sl-tertiary rounded-md max-w-full h-auto ">
        <div class="container inline-flex py-1">
            <div class="container flex justify-start items-center gap-2 px-2 py-1">
                <div class="container flex justify-start items-center w-4 ">
                    <div data-svg-wrapper data-layer="ic:round-arrow-back" class="IcRoundArr    owBack relative">
                        <a href="/profile"><i class="fa-light fa-chevron-left xl:text-xl hover:text-yellow-500"></a></i>
                    </div>
                </div>
                <div class="container flex justify-center items-center gap-2">
                    <div data-svg-wrapper data-layer="ic:round-arrow-back" class="IcRoundArrowBack relative"><i
                            class="fa-light fa-bookmark xl:text-xl hover:text-yellow-500"></i></div>
                    <h1 class=" text-white text-sm font-medium leading-tight xl:text-base">Tersimpan</h1>
                </div>
                <div class="container flex justify-start items-center w-4 ">
                    <div data-svg-wrapper data-layer="ic:round-arrow-back" class="IcRoundArr    owBack relative"></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container inline-flex flex-col justify-start items-center gap-4 py-4">
            <h1 class="text-center justify-start text-white text-xs font-light leading-5 px-2 xl:text-base ">Postingan yang
                disimpan bersifat rahasia dan hanya tersedia untuk Anda.</h1>

                <div class="container inline-flex justify-center items-center gap-1 flex-wrap content-start">
                    @forelse($bookmarks as $post)
                        <img class="size-27 rounded-md xl:size-40"
                             src="{{ $post->image_url ?? 'https://placehold.co/116x116' }}"
                             alt="Bookmark Image" />
                    @empty
                        <p class="text-center justify-start text-white text-xs font-light leading-5 px-2 xl:text-base italic">Belum ada postingan disimpan.</p>
                    @endforelse
                </div>
        </div>
    </div>

</x-layout>