<x-layout>
    <x-slot:title>Postingan Saya</x-slot:title>

    <div class="container bg-[#32283A] rounded-md max-w-full h-auto ">
        <div class="container inline-flex py-1">
            <div class="container flex justify-start items-center gap-2 px-2 py-1">
                <div class="container flex justify-start items-center w-4 ">
                    <div data-svg-wrapper data-layer="ic:round-arrow-back" class="IcRoundArr    owBack relative">
                        <button @click="history.back()">
                            <i class="fa-light fa-chevron-left xl:text-xl"></i>
                        </button>
                    </div>
                </div>
                <div class="container flex justify-center items-center gap-3">
                    <div data-svg-wrapper data-layer="ic:round-arrow-back" class="IcRoundArrowBack relative"><i class="fa-light fa-rectangle-history xl:text-xl"></i></div>
                    <h1 class=" text-white text-sm font-medium leading-tight xl:text-base">Postingan Saya</h1>
                </div>
                <div class="container flex justify-start items-center w-4 ">
                    <div data-svg-wrapper data-layer="ic:round-arrow-back" class="IcRoundArrowBack relative"></div>
                </div>
            </div>
        </div>
        <hr class="text-sl-quinary">
        <div class="container inline-flex flex-col justify-start items-center gap-4 py-4">
            <div class="container inline-flex justify-center items-center gap-1 flex-wrap content-start">
                @forelse($myposts as $post)
                    <a href="/post/{{ $post->id }}">
                        <div class="overflow-hidden">
                            <img class="size-27 rounded-md xl:size-40 object-cover hover:scale-[1.1] overflow-hidden duration-300"
                            src="{{ config('app.imagekit.url_endpoint') . $post->attachments[0]->namafile }}"
                            alt="Bookmark Image" />
                        </div>
                    </a>

                @empty
                    <p
                        class="text-center justify-start text-white text-xs font-light leading-5 px-2 xl:text-base italic">
                        Belum ada postingan yang dibuat.</p>
                @endforelse
            </div>
        </div>
    </div>

</x-layout>
