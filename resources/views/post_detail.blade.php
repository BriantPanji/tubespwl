{{-- @dd($comments) --}}
<x-layout>
    <x-slot:title>Detail Postingan</x-slot:title>

    <article class="min-w-full max-w-full w-full min-h-16 h-auto bg-sl-tertiary rounded-md flex flex-col p-3 gap-y-2">
        <section x-data="{ showOption: false }" class="w-full min-h-12 flex items-center justify-between relative">
            <div class="max-w-[75%] h-full flex items-center gap-2">
                <a href=""><img class="w-9 h-9 rounded-full" src="{{ asset('img/' . $post->user->avatar) }}"></a>
                {{-- FOTO PROFIL USER --}}
                <div class="flex flex-col h-full justify-center">
                    <a href="" class="text-sm lg:text-base font-semibold text-sl-text/90">
                        @php
                            $display_name = $post->user->badges->first();
                        @endphp

                        @if ($display_name)
                            <span>{{ $post->user->display_name }}</span>
                        @else
                            <span>{{ $post->user->usename }}</span>
                        @endif

                    </a>
                    <a href="" class="text-[.65rem] lg:text-xs text-emerald-500/70">
                        @php
                            $firstBadge = $post->user->badges->first();
                        @endphp

                        @if ($firstBadge)
                            <span>
                                {{ $firstBadge->badge_name }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="max-w-[20%] h-full flex items-center gap-2 text-2xl pr-2">
                <button @click="showOption=!showOption" class="w-fit h-fit cursor-pointer"><i
                        class="fa-light fa-ellipsis"></i></button>
            </div>
            <div x-cloak x-show="showOption" @click.outside="showOption = false"
                class="absolute top-8 right-0 w-20 h-auto bg-white/10 backdrop-blur-sm rounded-md shadow-lg flex flex-col gap-y-2 p-1 text-xs text-sl-text/90 z-50">
                {{-- QUERY LAPORKAN (REPORT POST) DISINI --}}
                <button @click="showOption = false"
                    class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1">Laporkan</button>
            </div>
        </section>

        <section class="w-full min-h-12 !h-auto flex flex-col justify-start items-start " x-cloak>
            {{-- URL MENUJU DETAIL POST INI --}}
            <a href=""
                class="w-full h-full max-w-full max-h-full truncate font-bold text-base md:text-lg hover:underline">
                {{-- JUDUL POST --}}
                {{ $post->title }}
            </a>
            <div class="w-full font-light text-xs md:text-sm relative ">
                <p class="line-clamp-4">
                    {{-- CONTENT POST --}}
                    {{ $post->content }}

                </p>
            </div>
        </section>
        <section class="w-full h-auto">
            <img class="!aspect-video rounded-xl" src="{{ asset('img/contohgmb.jpg') }}"> {{-- FOTO PERTAMA DARI POST --}}
        </section>
        <section
            class="w-full min-h-3 h-10 flex items-center bg-[#42394a] mt-1 rounded-md px-3 md:px-5 xl:px-8 2xl:px-10 text-2xl justify-between">
            @guest

                {{-- ISI '/{DISINI}' DENGAN URI DARI DETAIL POSTINGAN INI --}}
                <div class="flex w-[35%] md:w-[30%] justify-between">
                    <span class="h-full flex items-center sm:w-[40%]">

                        <button @click="window.location.href = '/login'"
                            class="text-2xl cursor-pointer hover:text-emerald-500"><i class="fa-light fa-up "></i></button>

                        <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">5.3rb</div>
                    </span>

                    <button @click="window.location.href = '/login'" class="text-2xl cursor-pointer hover:text-red-700"><i
                            class="fa-light fa-down"></i></button>

                </div>
                <div class="flex w-[53%] justify-between items-center">
                    <span class="h-full flex items-center sm:w-[20%] md:w-[30%]">

                        <button @click="window.location.href = '/login'"
                            class="text-2xl cursor-pointer hover:text-yellow-500"><i
                                class="fa-light fa-comment "></i></button>

                        <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">21</div>
                    </span>

                    <button @click="window.location.href = '/login'" class="text-xl cursor-pointer hover:text-cyan-700"><i
                            class="fa-light fa-bookmark"></i></button>

                    <button class="text-xl cursor-pointer hover:scale-101"><i
                            class="fa-light fa-share-from-square "></i></button>
                </div>
            @endguest
            @auth

                {{-- ISI '/{DISINI}' DENGAN URI DARI DETAIL POSTINGAN INI --}}
                <div class="flex w-[35%] md:w-[30%] justify-between">
                    <span class="h-full flex items-center sm:w-[40%]">
                        <button class="text-2xl cursor-pointer hover:text-emerald-500"><i
                                class="fa-light fa-up "></i></button>
                        <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">5.3rb</div>
                    </span>
                    <button class="text-2xl cursor-pointer hover:text-red-700"><i class="fa-light fa-down"></i></button>
                </div>
                <div class="flex w-[53%] justify-between items-center">
                    <span class="h-full flex items-center sm:w-[20%] md:w-[30%]">
                        <button class="text-2xl cursor-pointer hover:text-yellow-500"><i
                                class="fa-light fa-comment "></i></button>
                        <div class="text-sm ml-2 truncate whitespace-nowrap overflow-hidden block">21</div>
                    </span>

                    <button class="text-xl cursor-pointer hover:text-cyan-700"><i class="fa-light fa-bookmark"></i></button>
                    <button class="text-xl cursor-pointer hover:scale-101"><i
                            class="fa-light fa-share-from-square "></i></button>
                </div>
            @endauth
        </section>
    </article>

    {{-- Komentar-container --}}

    <div class="mt-1 px-2">
        <div class="">
            <div class="flex justify-between items-center">
                <img src="{{ asset('img/' . $post->user->avatar) }}" class="w-[32px] rounded-full" alt="Foto User">
                <input type="text" class="ml-1 w-[80%] px-2 bg-[#42394a] rounded-sm p-2 focus:outline-none"
                    placeholder="Tambahkan komentar Anda">
                <i class="fa-light fa-paper-plane-top text-xl hover:opacity-70"></i>
            </div>
        </div>
    </div>

    {{-- Komentar --}}
    <article class="min-w-full max-w-full w-full min-h-16 h-[2000px] bg-sl-tertiary rounded-md flex flex-col gap-y-2">
        <h1 class="mt-1 text-center text-[14px]">Komentar</h1>

        {{-- Komen orang --}}
        <div class="mt-1 px-3">
            <div class="">
                <div class="flex gap-2.5 items-start">
                    <img src="{{ asset('img/' . $post->user->avatar) }}" class="w-[32px] rounded-full mt-2"
                        alt="Foto User">
                    <div class="w-full px-1 bg-[#42394a] rounded-md p-2">
                        <div class="py-.5 px-2.5">
                            <div class="flex justify-between items-center relative" x-data="{ showOption: false }">
                                <h1>Feri Gunawan</h1>
                                <button @click="showOption=!showOption" class="cursor-pointer"><i
                                        class="fa-light fa-ellipsis text-2xl"></i></button>

                                <div x-cloak x-show="showOption" @click.outside="showOption = false"
                                    class="absolute top-5 right-0 w-20 h-auto bg-white/10 backdrop-blur-sm rounded-md shadow-lg flex flex-col gap-y-2 p-1 text-xs text-sl-text/90 z-50">
                                    {{-- QUERY LAPORKAN (REPORT POST) DISINI --}}
                                    <button @click="showOption = false"
                                        class="w-full h-fit cursor-pointer hover:bg-sl-base/30 rounded-md px-2 py-1">Laporkan</button>
                                </div>
                            </div>
                            <p class="text-sm font-extralight">Pemburu</p>
                            <p class="font-extralight mt-2 leading-tight">kocak bgt</p>
                            <div class="flex justify-end items-center gap-2 mt-2">
                                <button class="text-xl cursor-pointer hover:text-red-700">
                                    <i class="fa-light fa-down "></i>
                                </button>
                                <button class="ml-2 text-xl cursor-pointer hover:text-emerald-500">
                                    <i class="fa-light fa-up "></i>
                                </button>
                                <div class="text-xs">
                                    1234</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</x-layout>
