<x-adminlayout>
    <x-slot:title></x-slot:title>SudutLain - Tags</x-slot:title>


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
            <h1 class="text-white text-base xl:text-lg font-semibold">Tags di database</h1>
        </div>
        <div class="w-10"></div>
    </div>

        <div class="container flex flex-col gap-4 mt-5">
            <div class="flex flex-col gap-2">
                <h1 class="text-white text-lg font-semibold">Daftar Tags</h1>
                <p class="text-sm text-gray-400">Berikut adalah daftar tag yang terdaftar di database SudutLain</p>
            </div>

            <div class="min-w-full max-w-full min-h-2 rounded-md">
                <form method="GET" action="{{ route('admin.tags') }}" class="flex items-center gap-2">
                    <input type="search" name="cari" id="cari" placeholder="Cari tag berdasarkan nama atau id" class="w-full h-10 px-4 bg-sl-tertiary ring-sl-septenary ring-1 text-sl-text rounded-md focus:outline-none focus:ring-2 focus:ring-sl-secondary/80 focus:border-transparent" autocomplete="cariuser">
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
                            <th class="px-4 py-2">Digunakan</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sl-septenary">
                        @foreach ($tags as $tag)
                            <tr class="text-sm text-sl-text">
                                <td class="px-4 py-2">{{ $tag->id }}</td>
                                <td class="px-4 py-2 max-w-20 truncate">{{ $tag->name }}</td>
                                <td class="px-4 py-2 max-w-20 truncate">{{ $tag->tagged_post_count }} kali</td>
                                <td class="px-4 py-2 flex gap-2 *:shadow-md">
                                    <a href="/tagar/{{ $tag->name }}" class="text-cyan-600 hover:text-cyan-800 transition bg-sl-septenary/60 px-2 py-1 rounded-md"><i class="fa-light fa-eye"></i></a>
                                    <button @click="
                                        Swal.fire({
                                            title: 'Hapus Tag',
                                            text: 'Apakah Anda yakin ingin menghapus tag ini?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Ya, hapus!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                axios.post('{{ route('admin.delete-tag', $tag->id) }}', {
                                                    _method: 'DELETE',
                                                    data: {
                                                        _token: '{{ csrf_token() }}',
                                                    }
                                                })
                                                .then(response => {
                                                        Swal.fire(
                                                            'Deleted!',
                                                            'Tag berhasil dihapus.',
                                                            'success'
                                                        ).then(() => {
                                                            location.reload();
                                                        });
                                                })
                                                .catch(error => {
                                                    Swal.fire(
                                                        'Error!',
                                                        'Tag could not be deleted.',
                                                        'error'
                                                    );
                                                });
                                            }
                                        });
                                    " class="text-red-500 hover:text-red-700 transition cursor-pointer bg-sl-septenary/60 px-2 py-1 rounded-md"><i class="fa-light fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tags->links() }}
        </div>
        
    </section>
</x-adminlayout>