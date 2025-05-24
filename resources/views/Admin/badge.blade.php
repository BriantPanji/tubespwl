<x-adminlayout>
    <x-slot:title>SudutLain - Edit Badge</x-slot:title>


    <section class="min-h-screen w-full bg-sl-base text-sl-text flex flex-col items-center px-4 md:px-18 lg:px-32 xl:px-40 2xl:px-52">

        <div
            class="container rounded-md bg-sl-tertiary flex justify-between items-center px-4 py-3 shadow-md shadow-black/40">
            <div class="flex items-center w-10">
                <button @click="location.href='{{ route('admin.user')  }}'" class="text-sl-text hover:text-sl-secondary transition cursor-pointer">
                    <i class="fa-light fa-chevron-left text-xl"></i>
                </button>
            </div>
            <div class="flex justify-center items-center gap-2">
                <i class="fa-light fa-exclamation-circle text-xl text-sl-secondary"></i>
                <h1 class="text-sl-text text-base xl:text-lg font-semibold">Edit Badge User</h1>
            </div>
            <div class="w-10"></div>
        </div>

        <div class="container flex flex-col gap-4 mt-5">
            <div class="flex flex-col gap-2">
                <h1 class="text-sl-text text-lg font-semibold">Edit Badge: <small class="italic text-lg font-semibold">{{ $user->username }}</small></h1>
                <p class="text-sm text-gray-400">Edit badge yang dimiliki oleh <small class="italic text-sm font-semibold">{{ $user->display_name }} : {{ $user->username }}</small></p>
            </div>

            <div class="overflow-x-auto no-scrollbar rounded-md border border-sl-septenary text-sm">
                <table class="w-full table-auto text-left bg-sl-tertiary rounded-md shadow-md shadow-black/40 divide-y-2 divide-sl-septenary">
                    <thead class="w-full h-10">
                    <tr class="text-white text-sm font-semibold">
                        <th class="px-4 py-2">Id</th>
                        <th class="px-4 py-2 max-w-20">Name</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-sl-septenary">
                    @foreach ($badges as $badge)
                        <tr class="text-sl-text font-normal">
                            <td class="px-4 py-2">{{ $badge->id }}</td>
                            <td class="px-4 py-2 max-w-20 truncate">{{ $badge->badge_name }}</td>
                            <td class="px-4 py-2">{{ $user->hasBadge($badge) ? 'Dimiliki' : 'Tidak Dimiliki' }}</td>
                            <td class="px-4 py-2 flex gap-2 *:shadow-md *:cursor-pointer">
                                @if($user->hasBadge($badge))
                                    <button @click="
                                        Swal.fire({
                                            title: 'Hapus Badge',
                                            text: 'Apakah Anda yakin ingin menghapus badge ini dari user?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Ya, hapus!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                axios.post('{{ route('admin.badge-remove', $user->id)}}', {
                                                    _method: 'DELETE',
                                                    badge_id: {{ $badge->id }},
                                                    _token: '{{ csrf_token() }}'
                                                })
                                                .then(response => {
                                                    Swal.fire({
                                                        title: 'Berhasil',
                                                        text: 'Badge berhasil dihapus dari user.',
                                                        icon: 'success'
                                                    }).then(() => {
                                                        location.reload();
                                                    });
                                                })
                                                .catch(error => {
                                                    Swal.fire({
                                                        title: 'Gagal',
                                                        text: 'Terjadi kesalahan saat menghapus badge.',
                                                        icon: 'error'
                                                    });
                                                });
                                            }
                                        });
                                    " class="text-rose-600 hover:text-rose-800 transition bg-sl-septenary/60 px-2 py-1 rounded-md" title="Hapus badge dari user"><i class="fa-light fa-minus-large"></i></button>
                                @else
                                    <button @click="
                                        Swal.fire({
                                            title: 'Tambahkan Badge',
                                            text: 'Apakah Anda yakin ingin menambahkan badge ini ke user?',
                                            icon: 'question',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Ya, tambahkan!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                axios.post('{{ route('admin.badge-add', $user->id)}}', {
                                                    _method: 'PATCH',
                                                    badge_id: {{ $badge->id }},
                                                    _token: '{{ csrf_token() }}'
                                                })
                                                .then(response => {
                                                    Swal.fire({
                                                        title: 'Berhasil',
                                                        text: 'Badge berhasil ditambahkan ke user.',
                                                        icon: 'success'
                                                    }).then(() => {
                                                        location.reload();
                                                    });
                                                })
                                                .catch(error => {
                                                    Swal.fire({
                                                        title: 'Gagal',
                                                        text: 'Terjadi kesalahan saat menambahkan badge.',
                                                        icon: 'error'
                                                    });
                                                });
                                            }
                                        });
                                    " class="text-green-600 hover:text-green-800 transition bg-sl-septenary/60 px-2 py-1 rounded-md" title="Tambahkan badge ke user"><i class="fa-light fa-plus-large"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</x-adminlayout>
