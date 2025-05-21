<x-authlayout>
    <x-slot:title>
        Masuk ke SudutLain
    </x-slot:title>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ session()->get('success') }}",
                icon: "success"
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                title: "Terjadi Kesalahan",
                text: "{{ $errors->first() }}",
                icon: "error"
            });
        </script>
    @endif

    <div class="p-4 max-w-[600px] xl:max-w-[700px] m-auto">
        <section
            class="w-full min-h-2 h-24 md:h-30 px-3 pb-2 bg-sl-tertiary rounded-t-md flex flex-col gap-1 justify-center items-center">
            <h1 class="font-bold text-xl md:text-2xl text-purple-700">Lupa Password</h1>
            <p class="text-xs text-center md:text-sm">Perbarui password Anda di sini!</p>
        </section>

        <section
            class="min-w-full max-w-full w-full min-h-2 h-auto bg-sl-tertiary px-3 pt-3 pb-3 flex flex-col gap-3 border-2 border-sl-tertiary">
            <form method="POST" action="/forget-password" enctype="multipart/form-data"
                class="w-full h-auto flex flex-col gap-3">
                @csrf

                <!-- Email -->
                <div class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                    <label for="email" class="px-1 font-semibold">Email</label>
                    <input type="email" name="email" id="email"
                        class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                        placeholder="Masukkan email">
                    <x-item.err-form name="email" />
                </div>
                <!-- Password -->
                <div class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                    <label for="password" class="px-1 font-semibold">Password Baru</label>
                    <input type="password" name="password" id="password"
                        class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                        placeholder="Masukkan password baru">
                    <x-item.err-form name="password" />
                </div>

                <!-- Konfirmasi Password -->
                <div class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                    <label for="password_confirmation" class="px-1 font-semibold">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                        placeholder="Masukkan ulang password baru">
                    <x-item.err-form name="password_confirmation" />
                </div>

                <div class="w-full h-auto px-2 pt-1 pb-2 flex justify-center items-center">
                    <button type="submit"
                        class="w-full border-2 border-sl-primary bg-sl-primary font-semibold cursor-pointer rounded-md py-2 hover:bg-sl-primary/50 hover:font-bold hover:scale-102 focus:scale-98">
                        Ubah Password
                    </button>
                </div>
                <div class="min-w-full max-w-full min-h-2 text-center flex flex-col items-center text-sl-text/60 gap-5">
                    <div>
                        Sudah punya akun?
                        <a class="text-blue-600 font-semibold" href="/login">Masuk</a>
                    </div>
                </div>
            </form>
        </section>

        <section
            class="min-w-full max-w-full w-full min-h-2 h-auto bg-sl-tertiary rounded-b-md px-3 pt-3 pb-3 flex flex-col gap-2 border-2 border-sl-tertiary">
            <h2 class="text-yellow-500 font-bold text-base md:text-lg">Note:</h2>
            <ol class="list-decimal list-inside flex flex-col gap-1 text-xs md:text-sm font-extralight">
                <li>Password harus memiliki minimal 8 karakter.</li>
                <li>Password harus huruf dan angka (tanpa simbol).</li>
            </ol>
        </section>
    </div>
</x-authlayout>
