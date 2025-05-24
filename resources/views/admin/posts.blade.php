<x-adminlayout>
    <x-slot:title>SudutLain - Posts</x-slot:title>


    <section class="min-h-screen w-full bg-sl-base text-sl-text flex flex-col items-center px-4 md:px-18 lg:px-32 xl:px-40 2xl:px-52">

        <div
        class="container rounded-md bg-sl-tertiary flex justify-between items-center px-4 py-3 shadow-md shadow-black/40">
        <div class="flex items-center w-10">
            <button @click="history.back()" class="text-white hover:text-sl-secondary transition cursor-pointer">
                <i class="fa-light fa-chevron-left text-xl"></i>
            </button>
        </div>
        <div class="flex justify-center items-center gap-2">
            <i class="fa-light fa-exclamation-circle text-xl text-sl-secondary"></i>
            <h1 class="text-white text-base xl:text-lg font-semibold">Posts di database</h1>
        </div>
        <div class="w-10"></div>
    </div>

        <div class="container flex flex-col gap-4 mt-5">
            <div class="flex flex-col gap-2">
                <h1 class="text-white text-lg font-semibold">Daftar Post</h1>
                <p class="text-sm text-gray-400">Berikut adalah daftar post yang terdaftar di database SudutLain</p>
            </div>

            <div class="min-w-full max-w-full min-h-2 rounded-md">
                <form method="GET" action="{{ route('admin.posts') }}" class="flex items-center gap-2">
                    <input type="search" name="cari" id="cari" placeholder="Cari user berdasarkan nama, username, atau email" class="w-full h-10 px-4 bg-sl-tertiary ring-sl-septenary ring-1 text-sl-text rounded-md focus:outline-none focus:ring-2 focus:ring-sl-secondary/80 focus:border-transparent" autocomplete="cariuser">
                </form>
            </div>

            <div class="overflow-x-auto no-scrollbar rounded-md border border-sl-septenary">
                <table class="w-full table-auto text-left bg-sl-tertiary rounded-md shadow-md shadow-black/40 divide-y-2 divide-sl-septenary">
                    <thead class="w-full h-10">
                        <tr class="text-white
                            text-sm
                            font-semibold">
                            <th class="px-4 py-2">Id</th>
                            <th class="px-4 py-2 max-w-20">Name</th>
                            <th class="px-4 py-2">Username</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sl-septenary">
                        @foreach ($users as $user)
                            <tr class="{{ $user->is_admin ? 'text-sl-secondary' : 'text-sl-text' }}
                                text-sm
                                {{ $user->is_admin ? 'font-semibold' : 'font-normal'}}">
                                <td class="px-4 py-2">{{ $user->id }}</td>
                                <td class="px-4 py-2 max-w-20 truncate">{{ $user->display_name }}</td>
                                <td class="px-4 py-2">{{ $user->username }}</td>
                                <td class="px-4 py-2 max-w-25 truncate">{{ $user->email }}</td>
                                <td class="px-4 py-2 ">{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                                <td class="px-4 py-2 flex gap-2 *:shadow-md">
                                    <a href="/profile/{{ $user->username }}" class="text-cyan-600 hover:text-cyan-800 transition bg-sl-septenary/60 px-2 py-1 rounded-md"><i class="fa-light fa-eye"></i></a>
                                    @if($user->is_admin)
                                        <button @click="
                                            Swal.fire({
                                                title: 'Anda yakin?',
                                                text: 'User ini tidak akan menjadi Admin lagi',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Ya, saya yakin!',
                                                cancelButtonText: 'Batalkan'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    axios.post('{{ route('admin.revoke-admin', $user->id) }}', {
                                                        data: {
                                                            _token: '{{ csrf_token() }}'
                                                        }
                                                    })
                                                    .then(response => {
                                                            Swal.fire(
                                                                'Berhasil!',
                                                                'User ini sudah tidak menjadi Admin lagi',
                                                                'success'
                                                            ).then(() => {
                                                                location.reload();
                                                            });
                                                    })
                                                    .catch(error => {
                                                        Swal.fire(
                                                            'Gagal!',
                                                            'Terjadi kesalahan, silakan coba lagi',
                                                            'error'
                                                        );
                                                    });
                                                }
                                            })
                                        " class=" cursor-pointer text-orange-600 hover:text-orange-800 transition bg-sl-septenary/60 px-2 py-1 rounded-md">Demote</button>
                                    @else
                                        <button @click="
                                            Swal.fire({
                                                title: 'Anda yakin?',
                                                text: 'User akan menjadi Admin',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Ya, saya yakin!',
                                                cancelButtonText: 'Batalkan'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    axios.post('{{ route('admin.make-admin', $user->id) }}', {
                                                        data: {
                                                            _token: '{{ csrf_token() }}'
                                                        }
                                                    })
                                                    .then(response => {
                                                            Swal.fire(
                                                                'Berhasil!',
                                                                'User ini sudah menjadi Admin',
                                                                'success'
                                                            ).then(() => {
                                                                location.reload();
                                                            });
                                                    })
                                                    .catch(error => {
                                                        Swal.fire(
                                                            'Gagal!',
                                                            'Terjadi kesalahan, silakan coba lagi',
                                                            'error'
                                                        );
                                                    });
                                                }
                                            })
                                        " class=" cursor-pointer text-yellow-600 hover:text-yellow-800 transition bg-sl-septenary/60 px-2 py-1 rounded-md">Promote</button>
                                    @endif

                                    <button @click="
                                            Swal.fire({
                                                title: 'Anda yakin?',
                                                text: 'User ini akan dihapus dari database',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Ya, saya yakin!',
                                                cancelButtonText: 'Batalkan'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    axios.post('{{ route('admin.delete-user', $user->id) }}', {
                                                        _method: 'DELETE',
                                                        data: {
                                                            _token: '{{ csrf_token() }}'
                                                        }
                                                    })
                                                    .then(response => {
                                                            Swal.fire(
                                                                'Berhasil!',
                                                                'User ini sudah dihapus dari database',
                                                                'success'
                                                            ).then(() => {
                                                                location.reload();
                                                            });
                                                    })
                                                    .catch(error => {
                                                        Swal.fire(
                                                            'Gagal!',
                                                            'Terjadi kesalahan, silakan coba lagi',
                                                            'error'
                                                        );
                                                    });
                                                }
                                            })
                                    " class=" cursor-pointer text-red-500 hover:text-red-700 transition bg-sl-septenary/60 px-2 py-1 rounded-md"><i class="fa-light fa-trash"></i></button>
                                    @if (!$user->is_admin)
                                        @if ($user->is_banned)
                                            <button @click="
                                                    Swal.fire({
                                                        title: 'Anda yakin?',
                                                        text: 'User ini akan di-unban',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Ya, saya yakin!',
                                                        cancelButtonText: 'Batalkan'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            axios.post('{{ route('admin.unban-user', $user->id) }}', {
                                                                _method: 'PATCH',
                                                                data: {
                                                                    _token: '{{ csrf_token() }}'
                                                                }
                                                            })
                                                            .then(response => {
                                                                    Swal.fire(
                                                                        'Berhasil!',
                                                                        'User ini sudah di-unbanned',
                                                                        'success'
                                                                    ).then(() => {
                                                                        location.reload();
                                                                    });
                                                            })
                                                            .catch(error => {
                                                                Swal.fire(
                                                                    'Gagal!',
                                                                    'Terjadi kesalahan, silakan coba lagi',
                                                                    'error'
                                                                );
                                                            });
                                                        }
                                                    })
                                            " class=" cursor-pointer text-rose-600 hover:text-rose-800 transition bg-sl-septenary/60 px-2 py-1 rounded-md">Unban</button>
                                        @else
                                            <button @click="
                                                    Swal.fire({
                                                        title: 'Anda yakin?',
                                                        text: 'User ini akan dibanned',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Ya, saya yakin!',
                                                        cancelButtonText: 'Batalkan'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            axios.post('{{ route('admin.ban-user', $user->id) }}', {
                                                                _method: 'PATCH',
                                                                data: {
                                                                    _token: '{{ csrf_token() }}'
                                                                }
                                                            })
                                                            .then(response => {
                                                                    Swal.fire(
                                                                        'Berhasil!',
                                                                        'User ini sudah dibanned',
                                                                        'success'
                                                                    ).then(() => {
                                                                        location.reload();
                                                                    });
                                                            })
                                                            .catch(error => {
                                                                Swal.fire(
                                                                    'Gagal!',
                                                                    'Terjadi kesalahan, silakan coba lagi',
                                                                    'error'
                                                                );
                                                            });
                                                        }
                                                    })
                                            " class=" cursor-pointer text-rose-600 hover:text-rose-800 transition bg-sl-septenary/60 px-2 py-1 rounded-md">Ban</button>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>

    </section>
</x-adminlayout>
