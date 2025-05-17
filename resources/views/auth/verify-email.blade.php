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
        <img width="80" src="{{ asset('img/logo/sudutlain_icon.png') }}" alt="">
            <div class="bg-sl-tertiary p-4 rounded-md mt-4 max-w-[400px] xl:max-w-[600px]">

    <p>Pendaftaran Anda telah diterima, tetapi untuk keamanan, tolong cek email Anda untuk melakukan verifikasi. Belum mendapatkan email verifikasi? Klik tombol dibawah ini</p>

    <div class="flex justify-between items-end">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="mt-4 bg-sl-base rounded-md py-2 px-4">Kirim Ulang Link Verifikasi</button>
            </form>

        <div class="">
            <a href="/" class="hover:underline text-blue-600 font-semibold">Masuk</a>
        </div>
    </div>
            </div>
    </div>
</x-authlayout>
