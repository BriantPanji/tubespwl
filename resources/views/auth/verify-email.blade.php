<x-authlayout>
    <x-slot:title>
        Verifikasi Email
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

    @if (session('message'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ session()->get('message') }}",
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

<section
    class="text-sm lg:text-base min-w-full max-w-full min-h-screen flex flex-col justify-center py-8 px-4 xs:px-20 sm:px-32 md:px-48 lg:px-72 xl:px-92 2xl:px-124 ">
    <img src="{{ asset('img/backgroundLogin.png') }}" alt="SudutLain"
    class="size-[100%] absolute top-0 left-0 object-cover -z-99999">

    <div class="flex justify-center items-center max-h-fit flex-col">
        <img width="250" src="{{ asset('img/logo/sudutlain_kombinasi1.png') }}" alt="SudutLain"
            class="mb-4  w-[250px] h-[auto]">
        
        <div class="bg-sl-tertiary p-4 rounded-xl mt-4 max-w-[400px] xl:max-w-[600px] shadow-lg">
            <p class="text-sl-text mb-4">
                Terima kasih telah bergabung di <span class="text-sl-senary font-bold">Sudut Lain</span>!
                Sebelum mulai menjelajahi lebih jauh, silakan verifikasi alamat email kamu dengan mengklik tautan yang telah kami kirimkan ke inbox-mu.
                Belum menerima emailnya? Tenang, kami siap mengirim ulang kapan saja.
            </p>

            <div class="flex justify-between items-center mt-4 gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="bg-sl-base rounded-md py-2 px-4 hover:bg-sl-primary/90 cursor-pointer">
                        Kirim Ulang Link Verifikasi
                    </button>
                </form>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-sl-base/50 hover:bg-red-900 font-semibold  text-sl-text/90 px-4 py-2 rounded-md cursor-pointer">
                        Kembali
                    </button>
                </form>
            </div>

        </div>
    </div>

</section>
</x-authlayout>
