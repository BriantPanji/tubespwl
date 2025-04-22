<x-layout>
    <x-slot:title>TEST BRO</x-slot:title>
    <x-item.postbanner></x-item.postbanner>


    <article class="min-w-full max-w-full w-full min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 gap-y-2">
        <section x-data="{showOption: false}" class="w-full min-h-12 flex items-center justify-between relative">
            <div class="max-w-[75%] h-full flex items-center gap-2">
                <a href=""><img class="w-9 h-9 rounded-full" src="{{ asset('img/veszeta.jpg') }}"></a> {{-- FOTO PROFIL USER --}}
                <div class="flex flex-col h-full justify-center">
                    <a href="" class="text-sm lg:text-base font-semibold text-sl-text/90"><span>Vestia Zeta</span></a>
                    <a href="" class="text-[.65rem] lg:text-xs text-emerald-500/70"><span>Pencari Rasa</span></a>
                </div>
            </div>
            <div class="max-w-[20%] h-full flex items-center gap-2 text-2xl pr-2">
                <button @click="showOption=!showOption" class="w-fit h-fit cursor-pointer"><i class="fa-light fa-ellipsis"></i></button>
            </div>
            <div x-cloak x-show="showOption" @click.outside="showOption = false" class="absolute top-0 right-0 w-20 h-auto bg-white/10 backdrop-blur-sm rounded-md shadow-lg flex flex-col gap-y-2 p-1 text-xs text-sl-text/90 z-50">
                {{-- QUERY LAPORKAN (REPORT POST) DISINI --}}
                <button @click="showOption = false" class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1">Laporkan</button>
            </div>
        </section>

        <section class="w-full min-h-12 !h-auto flex flex-col justify-start items-start " x-cloak>
            {{-- URL MENUJU DETAIL POST INI --}}
            <a href="" class="w-full h-full max-w-full max-h-full truncate font-bold text-base md:text-lg hover:underline">
                {{-- JUDUL POST --}}
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempore, autem?
            </a>
            <div class="w-full font-light text-xs md:text-sm relative ">
                <p class="line-clamp-4">
                    {{-- CONTENT POST --}}
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. At voluptatum ipsam ea ratione repudiandae
                    enim repellendus ipsum. Et provident eveniet quia obcaecati qui accusamus incidunt, mollitia itaque
                    quis, vero vitae, adipisci impedit rerum nisi velit necessitatibus tempore libero cum cupiditate
                    culpa quod illo iste reprehenderit! Nesciunt dignissimos officiis possimus dolore.

                </p>
                <div class="absolute mt-10 bottom-0 right-1 w-full text-right cursor-text">
                    <a class="text-blue-500 text-xs font-medium hover:underline bg-sl-tertiary" href="">
                        ...lihat selengkapnya
                    </a>
                </div>
            </div>
        </section>
        <section class="w-full h-auto">
            <img class="!aspect-video rounded-xl" src="{{ asset('img/contohgmb.jpg') }}"> {{-- FOTO PERTAMA DARI POST --}}
        </section>
        <section class="w-full min-h-3 h-10 flex items-center bg-white/10 mt-1 rounded-md px-3 md:px-5 xl:px-8 2xl:px-10 text-2xl justify-between">
            @guest
            {{-- ISI '/{DISINI}' DENGAN URI DARI DETAIL POSTINGAN INI --}}
                <span class="h-full flex items-center gap-1 max-w-[30%] w-[30%] sm:w-[18%] md:w-[15%] lg:w-[12%]">
                    <button @click="window.location.href = '/'" class="text-2xl cursor-pointer hover:text-emerald-500"><i class="fa-light fa-up "></i></button>
                    <div class="text-xs truncate whitespace-nowrap overflow-hidden block">Dukung (5.3k)</div>
                </span>
                <button @click="window.location.href = '/'" class="text-2xl cursor-pointer hover:text-red-700"><i class="fa-light fa-down "></i></button>
                <button @click="window.location.href = '/'" class="text-xl cursor-pointer hover:text-yellow-500"><i class="fa-light fa-comment "></i></button>
                <button @click="window.location.href = '/'" class="text-xl cursor-pointer hover:text-cyan-700"><i class="fa-light fa-bookmark "></i></button>
            @endguest
            @auth
                {{-- LAKUKAN AJAX UNTUK QUERY UPVOTE & DOWNVOTE, SERTA BOOKMARK --}}
                {{-- REDIRECT KE DETAIL POST JIKA MENEKAN KOMEN --}}
                <span class="h-full flex items-center gap-1 max-w-[30%] w-[30%] sm:w-[18%] md:w-[15%] lg:w-[12%]">
                    <button class="text-2xl cursor-pointer hover:text-emerald-500"><i class="fa-light fa-up "></i></button>
                    <div class="text-xs truncate whitespace-nowrap overflow-hidden block">Dukung (5.3k)</div>
                </span>
                <button class="text-2xl cursor-pointer hover:text-red-700"><i class="fa-light fa-down "></i></button>
                <button class="text-xl cursor-pointer hover:text-yellow-500"><i class="fa-light fa-comment "></i></button>
                <button class="text-xl cursor-pointer hover:text-cyan-700"><i class="fa-light fa-bookmark "></i></button>
            @endauth
            <button class="text-xl cursor-pointer hover:scale-101"><i class="fa-light fa-share-from-square "></i></button>
        </section>
    </article>
</x-layout>
