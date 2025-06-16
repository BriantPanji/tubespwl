<x-layout>
    {{-- Judul Halaman --}}
    <x-slot:title>About Us</x-slot:title>

    <div class="">
        <div class="max-w-[500px]">
            <h1 class="text-5xl font-bold text-center">Tentang Kami</h1>
            <p class="mt-5 font-light opacity-70 text-center">
                Kami adalah tim kreatif dari Kom A st'24 Teknologi
                Informasi Fasilkom-TI USU yang mengembangkan website ini sebagai proyek akhir kuliah Pemrograman Web
                Lanjutan. Dengan semangat inovasi dan eksplorasi, kami menghadirkan <strong>Sudut Lain</strong> sebagai
                ruang untuk berbagi hal-hal unik dan tersembunyi.</p>

        </div>
        <div class="relative">
            <div
                class="after:content-[''] after:block after:w-[60px] after:h-[60px] after:absolute after:right-[0px] after:top-[0px] after:border-b-[60px] after:border-r-[60px] after:border-b-transparent after:border-r-sl-base ">
            </div>
            <div
                class="after:content-[''] after:block after:w-[40px] after:h-[40px] after:absolute after:left-0 after:bottom-[0px] after:border-t-[40px] after:border-l-[30px] after:border-t-transparent after:border-l-sl-base">
            </div>
            <img src="{{ asset('img/fotbar.jpg') }}" class="mt-12 rounded-md" alt="">
        </div>
        <div class="flex w-[100%] mt-10 gap-1 items-center">
            <div class="flex-1/3 text-center">
                <img src="{{ asset('img/logo/sudutlain_kombinasi2.png') }}" alt="" width="200"
                    class="mx-auto">
                <a href="#profile"
                    class="py-4 px-4 bg-sl-senary rounded-lg text-sm mt-3 block hover:bg-sl-senary/90">Contact us<i
                        class="fa-solid
                    fa-arrow-right ml-3"></i></a>
            </div>
            <div class="flex-2/3">
                <p class="opacity-70 text-sm ml-4">Sudut Lain adalah platform media sosial untuk berbagi informasi
                    seputar tempat, produk, game,
                    pengalaman, atau fenomena unik yang sering tersembunyi dari arus utama. Kami mengangkat konten
                    hidden
                    gems agar bisa dieksplorasi lebih luas.</p>
            </div>
        </div>
        <div class="relative">
            <div
                class="after:content-[''] after:block after:w-[60px] after:h-[60px] after:absolute after:right-[0px] after:top-[0px] after:border-b-[60px] after:border-r-[60px] after:border-b-transparent after:border-r-sl-base">
            </div>
            <div
                class="after:content-[''] after:block after:w-[40px] after:h-[40px] after:absolute after:left-0 after:bottom-[0px] after:border-t-[40px] after:border-l-[30px] after:border-t-transparent after:border-l-sl-base">
            </div>
            <img src="{{ asset('img/laptop.jpg') }}" class="mt-12 rounded-md" alt="">
        </div>
        <div class="flex flex-col items-center text-center justify-center w-[100%] mt-10 gap-1">
            <h1 class="font-bold text-4xl scroll-mt-16" id="profile">Mengenal Lebih Dekat Tim Kami</h1>

            <p class="opacity-70 text-md">Kami adalah mahasiswa yang tergabung dalam sebuah tim yang solid, penuh
                semangat, dan siap memberikan pengalaman terbaik melalui acara dan kegiatan yang kami selenggarakan.</p>
        </div>
        <div class="flex flex-wrap gap-x-4 mb-7">
            <div class="relative flex flex-col mx-auto w-[80%] md:w-[60%] lg:w-[40%] group mt-12">
                <div
                    class="after:content-[''] after:block after:w-[30px] after:h-[30px] after:absolute after:left-0 after:bottom-[0px] after:border-l-[65px] after:border-l-sl-base after:rounded-tr-lg after:z-10">
                </div>
                <div
                    class="after:content-[''] after:block after:absolute after:left-[60px] after:bottom-[0px] after:border-t-[30px] after:border-l-[30px] after:border-t-transparent after:border-l-sl-base after:z-10">
                </div>
                <div class="absolute bottom-[-5px] z-10">
                    <h1 class="text-[14px] font-bold">Andreas L.</h1>
                    <p class="opacity-70 text-[8px]">Front-End</p>
                </div>
                <img src="{{ asset('img/andreas.jpg') }}" class="w-full h-full object-cover object-bottom rounded-xl"
                    alt="">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="group-hover:opacity-100 opacity-0 duration-300 absolute bottom-[5px] right-[20px] text-2xl">
                    <a target="_blank" href="https://www.instagram.com/_andreaslim_?igsh=MXQ5M2F4a2gwcmVwZQ=="><i
                            class="fa-brands fa-instagram"></i></a>
                    <a target="_blank" href="https://wa.me/62082166778280"><i
                            class="fa-brands fa-whatsapp ml-2"></i></a>
                </div>

            </div>
            <div class="relative flex flex-col mx-auto w-[80%] md:w-[60%] lg:w-[40%] group mt-12">
                <div
                    class="after:content-[''] after:block after:w-[30px] after:h-[30px] after:absolute after:left-0 after:bottom-[0px] after:border-l-[65px] after:border-l-sl-base after:rounded-tr-lg after:z-10">
                </div>
                <div
                    class="after:content-[''] after:block after:absolute after:left-[60px] after:bottom-[0px] after:border-t-[30px] after:border-l-[30px] after:border-t-transparent after:border-l-sl-base after:z-10">
                </div>
                <div class="absolute bottom-[-5px] z-10">
                    <h1 class="text-[14px] font-bold">Delrico L.</h1>
                    <p class="opacity-70 text-[8px]">Front-End</p>
                </div>
                <img src="{{ asset('img/delrico.jpg') }}" class="w-full h-full object-cover object-bottom rounded-xl"
                    alt="">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="group-hover:opacity-100 opacity-0 duration-300 absolute bottom-[5px] right-[20px] text-2xl">
                    <a target="_blank" href="https://www.instagram.com/delricoo_?igsh=bG43cTNvemY4azAz"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a target="_blank" href="wa.me/62082166778280"><i class="fa-brands fa-whatsapp ml-2"></i></a>
                </div>

            </div>
            <div class="relative flex flex-col mx-auto w-[80%] md:w-[60%] lg:w-[40%] group mt-12">
                <div
                    class="after:content-[''] after:block after:w-[30px] after:h-[30px] after:absolute after:left-0 after:bottom-[0px] after:border-l-[65px] after:border-l-sl-base after:rounded-tr-lg after:z-10">
                </div>
                <div
                    class="after:content-[''] after:block after:absolute after:left-[60px] after:bottom-[0px] after:border-t-[30px] after:border-l-[30px] after:border-t-transparent after:border-l-sl-base after:z-10">
                </div>
                <div class="absolute bottom-[-5px] z-10">
                    <h1 class="text-[14px] font-bold">Feri G.</h1>
                    <p class="opacity-70 text-[8px]">UI/UX</p>
                </div>
                <img src="{{ asset('img/feri.jpg') }}" class="w-full h-full object-cover object-bottom rounded-xl"
                    alt="">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="group-hover:opacity-100 opacity-0 duration-300 absolute bottom-[5px] right-[20px] text-2xl">
                    <a target="_blank" href="https://www.instagram.com/feri.gnwn_?igsh=OXVzYWlhcXRkbXQ2"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a target="_blank" href="wa.me/62082166778280"><i class="fa-brands fa-whatsapp ml-2"></i></a>
                </div>

            </div>
            <div class="relative flex flex-col mx-auto w-[80%] md:w-[60%] lg:w-[40%] group mt-12">
                <div
                    class="after:content-[''] after:block after:w-[30px] after:h-[30px] after:absolute after:left-0 after:bottom-[0px] after:border-l-[65px] after:border-l-sl-base after:rounded-tr-lg after:z-10">
                </div>
                <div
                    class="after:content-[''] after:block after:absolute after:left-[60px] after:bottom-[0px] after:border-t-[30px] after:border-l-[30px] after:border-t-transparent after:border-l-sl-base after:z-10">
                </div>
                <div class="absolute bottom-[-5px] z-10">
                    <h1 class="text-[14px] font-bold">Panji B.</h1>
                    <p class="opacity-70 text-[8px]">Back-End</p>
                </div>
                <img src="{{ asset('img/panji.jpg') }}" class="w-full h-full object-cover object-bottom rounded-xl"
                    alt="">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="group-hover:opacity-100 opacity-0 duration-300 absolute bottom-[5px] right-[20px] text-2xl">
                    <a target="_blank" href="https://www.instagram.com/panjidepari?igsh=MTk5aWU1aG83Y29jeA=="><i
                            class="fa-brands fa-instagram"></i></a>
                    <a target="_blank" href="wa.me/62082166778280"><i class="fa-brands fa-whatsapp ml-2"></i></a>
                </div>

            </div>
            <div class="relative flex flex-col mx-auto w-[80%] md:w-[60%] lg:w-[40%] group mt-12">
                <div
                    class="after:content-[''] after:block after:w-[30px] after:h-[30px] after:absolute after:left-0 after:bottom-[0px] after:border-l-[65px] after:border-l-sl-base after:rounded-tr-lg after:z-10">
                </div>
                <div
                    class="after:content-[''] after:block after:absolute after:left-[60px] after:bottom-[0px] after:border-t-[30px] after:border-l-[30px] after:border-t-transparent after:border-l-sl-base after:z-10">
                </div>
                <div class="absolute bottom-[-5px] z-10">
                    <h1 class="text-[14px] font-bold">Sutanto L.</h1>
                    <p class="opacity-70 text-[8px]">Back-End</p>
                </div>
                <img src="{{ asset('img/sutanto.jpg') }}" class="w-full h-full object-cover object-bottom rounded-xl"
                    alt="">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div
                    class="group-hover:opacity-100 opacity-0 duration-300 absolute bottom-[5px] right-[20px] text-2xl">
                    <a target="_blank" href="https://www.instagram.com/suttkah?igsh=NmNqYzE1aWk0ZG8z"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a target="_blank" href="wa.me/62082166778280"><i class="fa-brands fa-whatsapp ml-2"></i></a>
                </div>

            </div>
        </div>
    </div>
</x-layout>
