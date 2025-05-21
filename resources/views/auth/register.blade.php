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

    <main class=" min-w-full max-w-full min-h-screen h-screen text-sl-text">
        <section
            class="min-w-full max-w-full min-h-screen flex flex-col justify-center py-8 px-4 xs:px-20 sm:px-32 md:px-48 lg:px-72 xl:px-92 2xl:px-124 ">
            <img src="{{ asset('img/backgroundLogin.png') }}" alt="SudutLain"
                class="size-[123%] absolute top-0 left-0 object-cover -z-99999 2xl:size-[100%]">

            <div class=" max-w-full msax-h-full px-8  py-8 bg-sl-tertiary rounded-xl inline-flex flex-col justify-start items-start gap-2.5 shadow-lg">
                <div
                class=" min-w-full max-w-full min-h-[15vh] max-h-[15vh] text-center flex items-center justify-center font-extrabold tracking-wider text-2xl ">
                <a href="/"><img src="{{ asset('img/logo/sudutlain_wm.png') }}" alt="SudutLain"></a>
            </div>

            <div class="min-w-full max-w-full min-h-fit flex flex-col justify-center items-center">
                <fieldset class="min-w-full max-w-full flex flex-col justify-center items-center text-center">
                    <legend class="float-left font-semibold">Buat akun</legend>
                    <span class="text-sm font-light mb-5">Lengkapi data Anda untuk mendaftar di <b>SudutLain</b></span>
                    <form method="POST" action="/register" class="min-w-full max-w-full min-h-2 flex flex-col justify-center items-center gap-2.5">
                        @csrf
                        <input type="text" value="{{ old('display_name') }}" name="display_name" id="display_name" class="min-w-full max-w-full min-h-3 h-12 px-4 font-medium text-neutral-900 bg-sl-secondary rounded-xl placeholder:text-neutral-100/60 placeholder:font-light border-2 border-transparent outline-none hover:border-sl-primary hover:scale-101 not-placeholder-shown:scale-101" required placeholder="nama lengkap">
                        <x-item.form-err name="display_name" />
                        <input type="text" value="{{ old('username') }}" name="username" id="username" class="min-w-full max-w-full min-h-3 h-12 px-4 font-medium text-neutral-900 bg-sl-secondary rounded-xl placeholder:text-neutral-100/60 placeholder:font-light border-2 border-transparent outline-none hover:border-sl-primary hover:scale-101 not-placeholder-shown:scale-101" required placeholder="username">
                        <x-item.form-err name="username" />
                        <input type="email" value="{{ old('email') }}" name="email" id="email" class="min-w-full max-w-full min-h-3 h-12 px-4 font-medium text-neutral-900 bg-sl-secondary rounded-xl placeholder:text-neutral-100/60 placeholder:font-light border-2 border-transparent outline-none hover:border-sl-primary hover:scale-101 not-placeholder-shown:scale-101" required placeholder="youremail@example.com">
                        <x-item.form-err name="email" />
                        <input type="password" name="password" id="password" class="min-w-full max-w-full min-h-3 h-12 px-4 font-medium text-neutral-900 bg-sl-secondary rounded-xl placeholder:text-neutral-100/60 placeholder:font-light border-2 border-transparent outline-none hover:border-sl-primary hover:scale-101 not-placeholder-shown:scale-101" required placeholder="password">
                        <x-item.form-err name="password" />
                        <input type="password" name="password_confirmation" id="password_confirmation" class="min-w-full max-w-full min-h-3 h-12 px-4 font-medium text-neutral-900 bg-sl-secondary rounded-xl placeholder:text-neutral-100/60 placeholder:font-light border-2 border-transparent outline-none hover:border-sl-primary hover:scale-101 not-placeholder-shown:scale-101" required placeholder="konfirmasi password">
                        <x-item.form-err name="password_confirmation" />
                        <button type="submit" class="min-w-full max-w-full min-h-3 h-12 px-4 font-normal text-sl-text bg-sl-primary rounded-xl border-2 border-transparent outline-none hover:border-sl-secondary hover:scale-99 cursor-pointer">Lanjutkan</button>
                    </form>
                </fieldset>
            </div>

            <div class="in-w-full max-w-full min-h-fit max-h-[40vh] flex flex-col">
                <div class="relative min-w-full max-w-full min-h-1 h-16 flex items-center justify-center text-sl-text/50">
                    <hr class="border-[1.5px] border-sl-text/50 min-w-full">
                    <div class="min-w-full max-w-full min-h-1 flex items-center justify-center bg-transparent absolute">
                        <span class="bg-sl-tertiary px-2 text-center">atau</span>
                    </div>
                </div>
                <div class="min-w-full max-w-full min-h-2 text-center flex flex-col items-center text-sl-text/60 gap-5">
                    <div>
                        Sudah punya akun?
                        <a class="text-blue-600 font-semibold" href="/login">Masuk</a>
                    </div>
                    <div class="text-xs">
                        Dengan mengklik <i>lanjutkan</i>, Anda menyetujui Persyaratan Layanan dan Kebijakan Privasi kami.
                    </div>
                </div>
            </div>

        </section>
    </main>
</x-authlayout>