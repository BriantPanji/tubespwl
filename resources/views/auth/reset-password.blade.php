<x-authlayout>
    <x-slot:title>
        Lupa Password - SudutLain
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

    <main class="bg-sl-base *:bg-sl-base min-w-full max-w-full min-h-screen h-screen text-sl-text">
        <section
            class="min-w-full max-w-full min-h-screen flex flex-col justify-center py-10 px-7 xs:px-20 sm:px-32 md:px-48 lg:px-72 xl:px-92 2xl:px-124">
            <div
                class=" min-w-full max-w-full min-h-[30vh] max-h-[30vh] text-center flex items-center justify-center font-extrabold tracking-wider text-2xl">
                <a href="/"><img src="{{ asset('img/logo/sudutlain_wm.png') }}" alt="SudutLain"></a>
            </div>
            <div class="min-w-full max-w-full min-h-fit flex flex-col justify-center items-center">
                <fieldset class="min-w-full max-w-full flex flex-col justify-center items-center text-center">
                    <legend class="float-left font-semibold">Masukkan password baru Anda</legend>
                    <span class="text-sm font-light mb-5">Silahkan masukkan password baru Anda</span>
                    <form method="POST" action="{{ route('password.renew') }}"
                        class="min-w-full max-w-full min-h-2 flex flex-col justify-center items-center gap-2.5 *:transition-all">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        
                        <input type="email" name="email" id="email"
                            class="min-w-full max-w-full min-h-3 h-12 px-4 font-medium text-neutral-900 border border-transparent bg-sl-secondary rounded-xl placeholder:text-neutral-100/60 placeholder:font-light outline-none hover:border-sl-primary hover:scale-101 not-placeholder-shown:scale-101"
                            value="{{ old('login', $email) }}" required placeholder="youremail@example.com">
                        <x-item.form-err name="email" />
                        
                        <input type="password" name="password" id="password"
                            class="min-w-full max-w-full min-h-3 h-12 px-4 font-medium text-neutral-900 border border-transparent bg-sl-secondary rounded-xl placeholder:text-neutral-100/60 placeholder:font-light outline-none hover:border-sl-primary hover:scale-101 not-placeholder-shown:scale-101"
                            required placeholder="Password Baru">
                        <x-item.form-err name="password" />
                        
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="min-w-full max-w-full min-h-3 h-12 px-4 font-medium text-neutral-900 border border-transparent bg-sl-secondary rounded-xl placeholder:text-neutral-100/60 placeholder:font-light outline-none hover:border-sl-primary hover:scale-101 not-placeholder-shown:scale-101"
                            required placeholder="Konfirmasi Password Baru">
                        <x-item.form-err name="password_confirmation" />


                        <button type="submit"
                            class="min-w-full max-w-full min-h-3 h-12 px-4 font-normal text-sl-text bg-sl-primary rounded-xl border-2 border-transparent outline-none hover:border-sl-secondary hover:scale-99 cursor-pointer">Lanjutkan</button>
                    </form>
                </fieldset>
            </div>
            <div class="min-w-full max-w-full min-h-[40vh] max-h-[40vh] flex flex-col">
                <div
                    class="relative min-w-full max-w-full min-h-1 h-16 flex items-center justify-center text-sl-text/50">
                    <hr class="border-[1.5px] border-sl-text/50 min-w-full">
                    <div class="min-w-full max-w-full min-h-1 flex items-center justify-center bg-transparent absolute">
                        <span class="bg-sl-base px-2 text-center">atau</span>
                    </div>
                </div>
                <div class="min-w-full max-w-full min-h-2 text-center flex flex-col items-center text-sl-text/60 gap-5">
                    <div>
                        <a class="text-blue-600 font-semibold" href="{{ route('login') }}">Masuk</a>
                    </div>
                    <div class="text-xs">
                        Dengan mengklik <i>lanjutkan</i>, Anda menyetujui Persyaratan Layanan dan Kebijakan Privasi
                        kami.
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-authlayout>
