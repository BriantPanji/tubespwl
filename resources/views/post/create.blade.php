<x-layout>
    <x-slot:title>SudutLain - Membuat Postingan</x-slot:title>

    <section
        class="w-full min-h-2 h-24 md:h-30 px-3 pb-2 bg-sl-tertiary rounded-md flex flex-col gap-1 justify-center items-center ">
        <h1 class="font-bold text-xl md:text-2xl text-purple-700">Buat Postingan</h1>
        <p class="text-xs text-center md:text-sm">Ceritakan pengalamanmu tentang suatu tempat. Bagikan kisah indahmu ke
            dunia!</p>
    </section>

    <section class="min-w-full max-w-full w-full min-h-2 h-auto bg-sl-tertiary rounded-md px-3 pt-3 pb-3 flex flex-col gap-3 border-2 border-sl-tertiary">
        {{--        <legend class="float-start font-semibold text-xl">Buat Postingan</legend>--}}
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" class="w-full h-auto flex flex-col gap-3">
            @method('PATCH')
            @csrf
            <div
                class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="title" class="px-1 font-semibold">Judul</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title') }}"
                       class=" group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                       placeholder="Masukkan judul postingan..." required autocomplete="off">
                <x-item.err-form name="title"/>
            </div>
            <div
                class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="content" class="px-1 font-semibold">Deskripsi:</label>
                <textarea
                    class="group-hover:scale-101 pt-1 not-placeholder-shown:scale-101 min-w-full max-w-full w-full min-h-17 max-h-50 h-40 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                    name="content" id="content" placeholder="Masukkan deskripsi postingan..." required
                    autocomplete="off">{{ old('content') }}</textarea>
                <x-item.err-form name="content"/>
            </div>

            <div
                class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="place_name" class="px-1 font-semibold">Nama Tempat:</label>
                <input type="text" name="place_name" id="place_name"
                       value="{{ old('place_name') }}"
                       class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                       placeholder="Ayam Penyet Mas Panji" required autocomplete="off">
                <x-item.err-form name="place_name"/>
            </div>
            
            <div
                class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="location" class="px-1 font-semibold">Lokasi:</label>
                <input type="text" name="location" id="location"
                       value="{{ old('location') }}"
                       class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                       placeholder="Jl. Ayam goreng No. 231, Medan Selayang" required autocomplete="off">
                <x-item.err-form name="location"/>
            </div>
            <div
                class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="gmap_url" class="px-1 font-semibold">Link Google Map:</label>
                <input type="url" name="gmap_url" id="gmap_url"
                       value="{{ old('gmap_url') }}"
                       class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                       placeholder="https://maps.app.goo.gl/a4vv1n6h8e87g4uq" required autocomplete="off">
                <x-item.err-form name="gmap_url"/>
            </div>
            

            <div
                class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="hashtag" class="px-1 font-semibold">Tagar:</label>
                <input type="text" name="hashtag" id="hashtag"
                       value="{{ old('hashtag') }}"
                       class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                       placeholder="makanan, ayampenyet, geprek, sambalijo" required autocomplete="off">
                <x-item.err-form name="hashtag"/>
            </div>

            {{--            <div class="w-full min-h-10 h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">--}}
            {{--                <label for="postattach" class="px-1"><i class="fa-light fa-images text-sm"></i> Gambar:</label>--}}
            {{--                <input id="fileInput" type="file" class="w-full overflow-clip rounded-sm border border-sl-primary bg-sl-tertiary text-sm text-sl-text file:mr-2 file:border-none file:bg-sl-primary/50 file:px-4 file:py-2 file:font-medium file:text-sl-text focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 truncate" />--}}
            {{--            </div>--}}
            <div
                class="w-full min-h-10 h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="postattach" class="px-1 font-semibold">Gambar:</label>
                <div x-cloak x-data="{
    files: [{ file: null, id: Date.now() }],
    addInput(index) {
        if (index === this.files.length - 1 && this.files.length < 5) {
            this.files.push({ file: null, id: Date.now() + this.files.length });
        }
    },
    removeFile(index) {
        this.files.splice(index, 1);
    }
}" class="flex flex-col gap-2">
                    <template x-for="(fileItem, index) in files" :key="fileItem.id">
                        <div class="relative w-full">
                            <input
                                type="file"
                                accept="image/png, image/jpeg"
                                multiple
                                :id="'fileInput' + index"
                                name="images[]"
                                class="w-full rounded-sm border border-sl-primary bg-sl-tertiary text-sm text-sl-text
                    file:mr-2 file:border-none file:bg-sl-primary/50 file:px-4 file:py-2 file:font-medium file:text-sl-text
                    focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black
                    disabled:cursor-not-allowed disabled:opacity-75 truncate"
                                @change="fileItem.file = $event.target.files[0]; addInput(index);"
                            />

                            <!-- Tombol batal hanya muncul jika file sudah dipilih -->
                            <button
                                x-show="fileItem.file"
                                @click.prevent="removeFile(index)"
                                type="button"
                                class="absolute top-0 right-2 text-xl h-full w-5 text-red-500 hover:underline shadow-sm"
                            >
                                <i class="fa-light fa-xmark"></i>
                            </button>
                        </div>
                    </template>
                </div>
                @if ($errors->any())
                    <i class="px-1 text-[.7rem] text-red-500 font-semibold">Pastikan memilih ulang gambar karena file upload tidak bisa disimpan otomatis.</i>
                @endif
            </div>


            <div class="w-full h-auto px-2 pt-1 pb-2 flex justify-center items-center">
                <button type="submit"
                        class="w-full border-2 border-sl-primary bg-sl-primary font-semibold cursor-pointer rounded-md py-2 hover:bg-sl-primary/50 hover:font-bold hover:scale-102 focus:scale-98">
                    Posting
                </button>
            </div>
        </form>
    </section>

    <section
        class="min-w-full max-w-full w-full min-h-2 h-auto bg-sl-tertiary rounded-md px-3 pt-3 pb-3 flex flex-col gap-2 border-2 border-sl-tertiary">
        <h2 class="text-yellow-500 font-bold text-base md:text-lg">Note:</h2>
        <ol class="list-decimal list-inside flex flex-col gap-1 text-xs md:text-sm font-extralight">
            <li>Pastikan semua informasi yang kamu masukkan sudah benar dan sesuai.</li>
            <li>Tagar / Hashtag dipisah dengan tanda koma (,) dan tidak boleh diakhiri dengan tanda koma.</li>
            <li>Minimal harus memposting 1 gambar.</li>
            <li>Jika ada kesalahan, kamu bisa mengedit postingannya nanti.</li>
            <li>Terima kasih telah berkontribusi di <img class=" h-[10px] md:h-3 mb-1 inline" src="{{ asset('img/logo/sudutlain_wmcropped.png') }}" alt="SudutLain">!
            </li>
        </ol>
    </section>
</x-layout>
