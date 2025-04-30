<x-layout>
    <x-slot:title>Postingan Saya</x-slot:title>

    <div class="container bg-[#32283A] rounded-md max-w-full h-auto ">
        <div class="container inline-flex py-1">
            <div class="container flex justify-start items-center gap-2 px-2 py-1">
                <div class="container flex justify-start items-center w-4 ">
                    <div data-svg-wrapper data-layer="ic:round-arrow-back" class="IcRoundArr    owBack relative">
                        <a href="/profile"><i class="fa-light fa-chevron-left xl:text-xl"></a></i>
                    </div>
                </div>
                <div class="container flex justify-center items-center gap-3">
                    <div data-svg-wrapper data-layer="ic:round-arrow-back" class="IcRoundArrowBack relative"><i class="fa-light fa-rectangle-history xl:text-xl"></i></div>
                    <h1 class=" text-white text-sm font-medium leading-tight xl:text-base">Postingan Saya</h1>
                </div>
                <div class="container flex justify-start items-center w-4 ">
                    <div data-svg-wrapper data-layer="ic:round-arrow-back" class="IcRoundArr    owBack relative"></div>
                </div>
            </div>
        </div>
        <hr class="text-sl-quinary">
        <div class="container inline-flex flex-col justify-start items-center gap-4 py-4">
            <h1 class="text-center justify-start text-white text-xs font-light leading-5 px-2 pb-4 xl:text-sm "><i>Postingan
                anda
                bersifat rahasia dan hanya tersedia untuk Anda.</i></h1>

            <div class="container inline-flex justify-center items-center gap-1 flex-wrap content-start">
                @forelse($myposts as $post)
                    <a href="/post/{{ $post->id }}">
                        <img class="size-27 rounded-md xl:size-40 object-cover hover:size-29 xl:hover:size-42 duration-300"
                            src="{{ asset('storage/posts/' . $post->attachments[0]->namafile) }}"
                            alt="Bookmark Image" />

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
