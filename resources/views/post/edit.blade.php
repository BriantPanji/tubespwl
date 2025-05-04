<x-layout>
    <x-slot:title>SudutLain - Edit Postingan</x-slot:title>

    <section
        class="w-full min-h-2 h-24 md:h-30 px-3 pb-2 bg-sl-tertiary rounded-md flex flex-col gap-1 justify-center items-center">
        <h1 class="font-bold text-xl md:text-2xl text-purple-700">Edit Postingan</h1>
    </section>

    <section
        class="w-full h-auto bg-sl-tertiary rounded-md px-3 pt-3 pb-3 flex flex-col gap-3 border-2 border-sl-tertiary">
        <form method="POST" action="{{ route('post.update', $post) }}" class="flex flex-col gap-3">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="title" class="px-1 font-semibold">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60"
                    placeholder="Masukkan judul postingan..." required autocomplete="off">
                <x-item.err-form name="title" />
            </div>

            <div class="flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="content" class="px-1 font-semibold">Deskripsi</label>
                <textarea name="content" id="content"
                    class="min-h-17 max-h-50 h-40 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60"
                    placeholder="Masukkan deskripsi postingan..." required autocomplete="off">{{ old('content', $post->content) }}</textarea>
                <x-item.err-form name="content" />
            </div>

            <div class="flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="place_name" class="px-1 font-semibold">Nama Tempat</label>
                <input type="text" name="place_name" id="place_name"
                    value="{{ old('place_name', $post->place_name) }}"
                    class="w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60"
                    placeholder="Ayam Penyet Mas Panji" required autocomplete="off">
                <x-item.err-form name="place_name" />
            </div>

            <div class="flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="location" class="px-1 font-semibold">Lokasi</label>
                <input type="text" name="location" id="location" value="{{ old('location', $post->location) }}"
                    class="w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60"
                    placeholder="Jl. Ayam goreng No. 231, Medan Selayang" required autocomplete="off">
                <x-item.err-form name="location" />
            </div>

            <div class="flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="gmap_url" class="px-1 font-semibold">Link Google Map</label>
                <input type="url" name="gmap_url" id="gmap_url" value="{{ old('gmap_url', $post->gmap_url) }}"
                    class="w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60"
                    placeholder="https://maps.app.goo.gl/a4vv1n6h8e87g4uq" required autocomplete="off">
                <x-item.err-form name="gmap_url" />
            </div>


            <div class="flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="hashtag" class="px-1 font-semibold">Tagar</label>
                <input type="text" name="hashtag" id="hashtag" value="{{ old('hashtag', $post->hashtag) }}"
                    class="w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60"
                    placeholder="makanan, ayampenyet, geprek, sambalijo" required autocomplete="off">
                <x-item.err-form name="hashtag" />
            </div>

            <div class="px-2 pt-1 pb-2 flex justify-center">
                <button type="submit"
                    class="w-full border-2 border-sl-primary bg-sl-primary font-semibold cursor-pointer rounded-md py-2 hover:bg-sl-primary/50 hover:font-bold hover:scale-102 focus:scale-98">
                    Selesai
                </button>
            </div>
        </form>
    </section>

    <section
        class="w-full h-auto bg-sl-tertiary rounded-md px-3 pt-3 pb-3 flex flex-col gap-2 border-2 border-sl-tertiary">
        <h2 class="text-yellow-500 font-bold text-base md:text-lg">Note:</h2>
        <ol class="list-decimal list-inside flex flex-col gap-1 text-xs md:text-sm font-extralight">
            <li>Pastikan semua informasi yang kamu masukkan sudah benar dan sesuai.</li>
            <li>Tagar / Hashtag dipisah dengan tanda koma (,) dan tidak boleh diakhiri dengan tanda koma.</li>
            <li>Jika ada kesalahan, kamu bisa mengedit postingannya lagi nanti.</li>
            <li>Terima kasih telah berkontribusi di
                <img class="h-[10px] md:h-3 mb-1 inline" src="{{ asset('img/logo/sudutlain_wmcropped.png') }}"
                    alt="SudutLain">
            </li>
        </ol>
    </section>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Oke'
                });
            });
        </script>
    @endif

</x-layout>
