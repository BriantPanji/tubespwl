<x-layout>
    <x-slot:title>
        Home
    </x-slot:title>

    <div class="px-4 navbar h-[60px] bg-purple-600 justify-between items-center flex">
        <img src="{{ Vite::asset('resources/img/Conan.jpg') }}" alt="Logo" class="w-[50px] rounded-full">
        <h1 class="text-[20px]">SudutLain</h1>
        <div class="feature flex justify-between">
            <i class="fa-solid fa-magnifying-glass"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 56 56"><path fill="currentColor" d="M46.867 9.262c-2.39-2.39-5.765-2.766-9.75-2.766H18.836c-3.937 0-7.312.375-9.703 2.766S6.39 15.004 6.39 18.918v18.094c0 4.008.351 7.336 2.742 9.726s5.766 2.766 9.773 2.766h18.211c3.985 0 7.36-.375 9.75-2.766c2.391-2.39 2.742-5.718 2.742-9.726V18.988c0-4.008-.351-7.36-2.742-9.726m-1.031 9.07v19.313c0 2.437-.305 4.921-1.71 6.351c-1.43 1.406-3.962 1.734-6.376 1.734h-19.5c-2.414 0-4.945-.328-6.351-1.734c-1.43-1.43-1.735-3.914-1.735-6.352V18.403c0-2.46.305-4.992 1.711-6.398c1.43-1.43 3.984-1.734 6.445-1.734h19.43c2.414 0 4.945.328 6.375 1.734c1.406 1.43 1.711 3.914 1.711 6.328M28 40.504c.938 0 1.688-.727 1.688-1.664v-9.164h9.164c.937 0 1.687-.797 1.687-1.664c0-.914-.75-1.688-1.687-1.688h-9.164v-9.187c0-.938-.75-1.664-1.688-1.664a1.64 1.64 0 0 0-1.664 1.664v9.187h-9.164c-.938 0-1.688.774-1.688 1.688c0 .867.75 1.664 1.688 1.664h9.164v9.164c0 .937.727 1.664 1.664 1.664"/></svg>
        </div>
    </div>
    <div class="px-4 content mt-4">
        <div class="what-u-post w-full bg-purple-900 h-[52px]"></div>
        <div class="post mt-4 p-4 w-full bg-purple-900">
            <div class="header flex items-center">
                <img src="{{ Vite::asset('resources/img/Conan.jpg') }}" alt="Logo" class="w-[50px] rounded-full flex-none">
                <div class="flex-1 ml-4">
                    <h4>Delrico Lie</h4>
                    <h6>Pemburu</h6>
                </div>
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><path fill="#fff" d="M5 10c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2m14 0c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2m-7 0c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2"/></svg>
                </div>
            </div>
            <div class="content">
                <h1 class="text-[16px] mt-[1rem] font-semibold">Judul hidden gem guys</h1>
                <p class="mt-[4px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi nostrum soluta consequatur deleniti dicta dolore ut voluptas at consequuntur modi? Sequi harum temporibus atque alias doloribus! Cum doloribus labore exercitationem dolore assumenda sed, similique est minus dolorem, corrupti blanditiis possimus amet facilis consequuntur ipsam? Dignissimos error neque, nisi incidunt praesentium maiores in aperiam eveniet. Obcaecati maxime veritatis odit dolorum accusantium? <span class="opacity-50">...lihat selengkapnya</span></p>
                <img class="mt-[13px] rounded-2xl" src="{{ Vite::asset('resources/img/tes.png') }}" alt="">
                <div class="w-full bg-purple-700 mt-4 px-4 h-[40px] rounded-lg flex items-center">
                    <div class="vote flex flex-none w-72">
                        <div class="up-vote flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#fff" d="M12.781 2.375c-.381-.475-1.181-.475-1.562 0l-8 10A1.001 1.001 0 0 0 4 14h4v7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7h4a1.001 1.001 0 0 0 .781-1.625zM15 12h-1v8h-4v-8H6.081L12 4.601L17.919 12z"/></svg>
                            <span class="ml-1">Dukung (5,4rb)</span>
                        </div>
                        <svg class="ml-3" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#fff" d="M20.901 10.566A1 1 0 0 0 20 10h-4V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v7H4a1.001 1.001 0 0 0-.781 1.625l8 10a1 1 0 0 0 1.562 0l8-10c.24-.301.286-.712.12-1.059M12 19.399L6.081 12H10V4h4v8h3.919z"/></svg>
                    </div>

                    <div class="comment flex flex-1 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.099 19q-1.949-.192-2.927-1.172C2 16.657 2 14.771 2 11v-.5c0-3.771 0-5.657 1.172-6.828S6.229 2.5 10 2.5h4c3.771 0 5.657 0 6.828 1.172S22 6.729 22 10.5v.5c0 3.771 0 5.657-1.172 6.828S17.771 19 14 19c-.56.012-1.007.055-1.445.155c-1.199.276-2.309.89-3.405 1.424c-1.563.762-2.344 1.143-2.834.786c-.938-.698-.021-2.863.184-3.865" color="#fff"/></svg>
                        <span class="ml-1">3,2rb</span>
                    </div>

                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="70" viewBox="0 0 24 24"><path fill="#fff" d="m12 18l-4.2 1.8q-1 .425-1.9-.162T5 17.975V5q0-.825.588-1.412T7 3h10q.825 0 1.413.588T19 5v12.975q0 1.075-.9 1.663t-1.9.162zm0-2.2l5 2.15V5H7v12.95zM12 5H7h10z"/></svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="post mt-4 p-4 w-full bg-purple-900 backdrop-opacity-70">
            <div class="header flex items-center">
                <img src="{{ Vite::asset('resources/img/Conan.jpg') }}" alt="Logo" class="w-[50px] rounded-full flex-none">
                <div class="flex-1 ml-4">
                    <h4>Delrico Lie</h4>
                    <h6>Pemburu</h6>
                </div>
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><path fill="#fff" d="M5 10c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2m14 0c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2m-7 0c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2"/></svg>
                </div>
            </div>
            <div class="content">
                <h1 class="text-[16px] mt-[1rem] font-semibold">Judul hidden gem guys</h1>
                <p class="mt-[4px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi nostrum soluta consequatur deleniti dicta dolore ut voluptas at consequuntur modi? Sequi harum temporibus atque alias doloribus! Cum doloribus labore exercitationem dolore assumenda sed, similique est minus dolorem, corrupti blanditiis possimus amet facilis consequuntur ipsam? Dignissimos error neque, nisi incidunt praesentium maiores in aperiam eveniet. Obcaecati maxime veritatis odit dolorum accusantium? <span class="opacity-50">...lihat selengkapnya</span></p>
                <img class="mt-[13px]" src="{{ Vite::asset('resources/img/tes.png') }}" alt="">
            </div>
        </div>
    </div>
</x-layout>