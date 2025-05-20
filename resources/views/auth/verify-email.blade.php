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

    <div class="flex justify-center items-center h-[100vh] flex-col">
        <img width="250" src="{{ asset('img/logo/sudutlain_icon.png') }}" alt="">
        
        <div class="bg-sl-tertiary p-4 rounded-md mt-4 max-w-[400px] xl:max-w-[600px]">
            <p class="text-sm text-sl-text mb-6">
                Pendaftaran Anda telah diterima! Demi keamanan akun, mohon cek email Anda untuk melakukan verifikasi.
                <br><span class="font-medium text-sl-primary">Belum mendapatkan email?</span> Klik tombol di bawah ini
                untuk mengirim ulang tautan verifikasi.
            </p>

            <div class="flex justify-between items-center mt-4 gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="bg-sl-base rounded-md py-2 px-4">
                        Kirim Ulang Link Verifikasi
                    </button>
                </form>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-sl-base hover:bg-red-900 font-semibold text-sm text-sl-text/90 px-4 py-2 rounded-md">
                        Kembali
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-authlayout>
