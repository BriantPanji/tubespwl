<x-adminlayout>
    <x-slot:title>SudutLain - Dashboard Admin</x-slot:title>

            <section class="flex w-full max-w-full min-w-full items-center justify-around gap-2 md:gap-5 flex-wrap bg-sl-quinary/30 px-2 py-3 md:px-5 rounded-lg">

                <div class="max-w-full min-w-40 md:min-w-60 min-h-10 h-auto py-3 bg-sl-septenary/80 rounded-md flex flex-col items-center justify-center">
                    <span class="w-14 h-14 rounded-full flex items-center justify-center text-4xl font-bold text-white ">
                        <i class="fa-light fa-users"></i>
                    </span>
                    <div class="w-full h-fit flex flex-col items-center justify-centertext-white">
                        <span class="text-2xl font-bold">{{ $userCount }}</span>
                        <span class="text-sm text-sl-text/90">Total user</span>
                    </div>
                </div>
                <div class="max-w-full min-w-40 md:min-w-60 min-h-10 h-auto py-3 bg-sl-septenary/80 rounded-md flex flex-col items-center justify-center">
                    <span class="w-14 h-14 rounded-full flex items-center justify-center text-4xl font-bold text-white ">
                        <i class="fa-light fa-rectangle-history"></i>
                    </span>
                    <div class="w-full h-fit flex flex-col items-center justify-centertext-white">
                        <span class="text-2xl font-bold">{{ $postCount }}</span>
                        <span class="text-sm text-sl-text/90">Total post</span>
                    </div>
                </div>
                <div class="max-w-full min-w-40 md:min-w-60 min-h-10 h-auto py-3 bg-sl-septenary/80 rounded-md flex flex-col items-center justify-center">
                    <span class="w-14 h-14 rounded-full flex items-center justify-center text-4xl font-bold text-white ">
                        <i class="fa-light fa-comments"></i>
                    </span>
                    <div class="w-full h-fit flex flex-col items-center justify-centertext-white">
                        <span class="text-2xl font-bold">{{ $commentCount }}</span>
                        <span class="text-sm text-sl-text/90">Total komen</span>
                    </div>
                </div>
                <div class="max-w-full min-w-40 md:min-w-60 min-h-10 h-auto py-3 bg-sl-septenary/80 rounded-md flex flex-col items-center justify-center">
                    <span class="w-14 h-14 rounded-full flex items-center justify-center text-4xl font-bold text-white relative">
                        <i class="fa-solid fa-diamond-exclamation absolute text-xl top-1 right-0"></i>
                        <i class="fa-light fa-rectangle-history"></i>
                    </span>
                    <div class="w-full h-fit flex flex-col items-center justify-centertext-white">
                        <span class="text-2xl font-bold">{{ $reportedPostsCount }}</span>
                        <span class="text-sm text-sl-text/90">Total post direport</span>
                    </div>
                </div>
                <div class="max-w-full min-w-40 md:min-w-60 min-h-10 h-auto py-3 bg-sl-septenary/80 rounded-md flex flex-col items-center justify-center">
                    <span class="w-14 h-14 rounded-full flex items-center justify-center text-4xl font-bold text-white relative">
                        <i class="fa-solid fa-diamond-exclamation absolute text-xl top-1 right-0"></i>
                        <i class="fa-light fa-comments"></i>
                    </span>
                    <div class="w-full h-fit flex flex-col items-center justify-centertext-white">
                        <span class="text-2xl font-bold">{{ $reportedCommentsCount }}</span>
                        <span class="text-sm text-sl-text/90">Total komen direport</span>
                    </div>
                </div>
                <div class="max-w-full min-w-40 md:min-w-60 min-h-10 h-auto py-3 bg-sl-septenary/80 rounded-md flex flex-col items-center justify-center">
                    <span class="w-14 h-14 rounded-full flex items-center justify-center text-4xl font-bold text-white relative">
                        <i class="fa-light fa-up"></i>
                        <i class="fa-light fa-down"></i>
                    </span>
                    <div class="w-full h-fit flex flex-col items-center justify-centertext-white">
                        <span class="text-2xl font-bold">{{ $votedPostsCount }}</span>
                        <span class="text-sm text-sl-text/90">Total vote postingan</span>
                    </div>
                </div>
                <div class="max-w-full min-w-40 md:min-w-60 min-h-10 h-auto py-3 bg-sl-septenary/80 rounded-md flex flex-col items-center justify-center">
                    <span class="w-14 h-14 rounded-full flex items-center justify-center text-4xl font-bold text-white relative">
                        <i class="fa-light fa-up"></i>
                        <i class="fa-light fa-down"></i>
                    </span>
                    <div class="w-full h-fit flex flex-col items-center justify-centertext-white">
                        <span class="text-2xl font-bold">{{ $votedCommentsCount }}</span>
                        <span class="text-sm text-sl-text/90">Total vote komentar</span>
                    </div>
                </div>
                <div class="max-w-full min-w-40 md:min-w-60 min-h-10 h-auto py-3 bg-sl-septenary/80 rounded-md flex flex-col items-center justify-center">
                    <span class="w-14 h-14 rounded-full flex items-center justify-center text-4xl font-bold text-white relative">
                        <i class="fa-light fa-tags"></i>
                    </span>
                    <div class="w-full h-fit flex flex-col items-center justify-centertext-white">
                        <span class="text-2xl font-bold">{{ $tagsCount }}</span>
                        <span class="text-sm text-sl-text/90">Total tag dibuat</span>
                    </div>
                </div>

            </section>

            {{-- <section class="flex w-full max-w-full min-w-full items-center justify-center gap-2 text-sl-text">
                <div class="w-full h-20 ">
                    <h1 class="ml-1 mb-1 font-semibold text-xl flex items-center justify-center w-fit whitespace-pre"><i class="fa-light fa-user-tie text-lg"></i> List Admin:</h1>
                    <div class="overflow-x-auto bg-sl-quinary rounded-md">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700 ">
                            <thead class="ltr:text-left rtl:text-right bg-sl-septenary">
                            <tr class="*:font-medium *:text-gray-900 dark:*:text-white">
                                <th class="px-3 py-2 whitespace-nowrap">Id</th>
                                <th class="px-3 py-2 whitespace-nowrap">Username</th>
                                <th class="px-3 py-2 whitespace-nowrap">Email</th>
                                <th class="px-3 py-2 whitespace-nowrap">Aksi</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-sl-septenary/40">
                                @foreach ($admins as $admin)
                                    <tr class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                                        <td class="px-3 py-2 whitespace-nowrap">{{ $admin->id }}</td>
                                        <td class="px-3 py-2 whitespace-nowrap">{{ $admin->username }}</td>
                                        <td class="px-3 py-2 whitespace-nowrap">{{ $admin->email }}</td>
                                        <td class="px-3 py-2 whitespace-nowrap">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full h-20 ">
                </div>
            </section> --}}

            <section class="flex flex-wrap md:flex-nowrap w-full max-w-full min-w-full items-start justify-center gap-2 md:gap-5 bg-sl-quinary/30 px-2 py-3 md:px-5 rounded-lg">
                <div class="w-full md:w-1/2 min-h-20 mt-1">
                    <h1 class="ml-1 mb-1 font-semibold text-xl flex items-center justify-center w-fit whitespace-pre"><i class="fa-light fa-rectangle-history text-lg"></i> Reported Post:</h1>
                    <div class="overflow-x-auto bg-sl-quinary rounded-md border border-sl-text/25 max-h-50 no-scrollbar">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
                            <thead class="ltr:text-left rtl:text-right bg-sl-septenary">
                            <tr class="*:font-medium *:text-gray-900 dark:*:text-white">
                                <th class="px-3 py-2 whitespace-nowrap w-1/3">Post</th>
                                <th class="px-3 py-2 whitespace-nowrap w-1/3">User</th>
                                {{-- <th class="px-3 py-2 whitespace-nowrap">Email</th> --}}
                                <th class="px-3 py-2 whitespace-nowrap flex items-center justify-center w-1/3">Hapus Post</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-sl-septenary/40">
                                @forelse ($reportedPosts as $post)
                                    <tr class="*:text-gray-900 *:first:font-normal text-sm dark:*:text-white xl:max-w-full">
                                        <td class="px-3 py-2 whitespace-nowrap w-1/3 truncate"><a href="/post/{{ $post->id }}">{{ $post->id }}</a></td>
                                        <td class="px-3 py-2 whitespace-nowrap w-1/3"><a href="/profile/{{ $post->user->username }}">{{ $post->user->username }}</a></td>
                                        {{-- <td class="px-3 py-2 whitespace-nowrap">{{ $post->email }}</td> --}}
                                        <td class="px-3 py-2 whitespace-nowrap w-1/3 flex items-center justify-center">
                                            <button 
                                                @click="
                                                    Swal.fire({
                                                        title: 'Hapus Postingan',
                                                        text: 'Apakah anda yakin ingin menghapus postingan ini?',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonText: 'Hapus',
                                                        cancelButtonText: 'Batal',
                                                        allowOutsideClick: false
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            axios.post('/post/{{ $post->id }}', {
                                                                _method: 'DELETE',
                                                                data: {
                                                                    _token: '{{ csrf_token() }}'
                                                                }
                                                            })
                                                            .then(() => {
                                                                Swal.fire('Berhasil!', 'Postingan berhasil dihapus!', 'success')
                                                                .then(() => {
                                                                    window.location.reload();
                                                                })
                                                            })
                                                            .catch((error) => {
                                                                console.error(error);
                                                                Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus postingan.', 'error')
                                                            });
                                                        }
                                                    }) "
                                                class="text-lg text-red-600 cursor-pointer">
                                                <i class="fa-light fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="*:text-gray-900 *:first:font-normal text-sm dark:*:text-white">
                                        <td colspan="3" class="px-3 py-2 whitespace-nowrap text-center opacity-75">Tidak ada laporan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full md:w-1/2 min-h-20 mt-1">
                    <h1 class="ml-1 mb-1 font-semibold text-xl flex items-center justify-center w-fit whitespace-pre"><i class="fa-light fa-comment text-lg"></i> Reported Comment:</h1>
                    <div class="overflow-x-auto bg-sl-quinary rounded-md border border-sl-text/25 max-h-50 no-scrollbar">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
                            <thead class="ltr:text-left rtl:text-right bg-sl-septenary">
                            <tr class="*:font-medium *:text-gray-900 dark:*:text-white w-full">
                                <th class="px-3 py-2 whitespace-nowrap w-1/3 ">Comment</th>
                                <th class="px-3 py-2 whitespace-nowrap w-1/3 ">User</th>
                                <th class="px-3 py-2 whitespace-nowrap w-1/3 flex items-center justify-center">Hapus Comment</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-sl-septenary/40">
                                @forelse ($reportedComments as $comment)
                                    <tr class="*:text-gray-900 *:first:font-normal text-sm dark:*:text-white">
                                        <td class="px-3 py-2 whitespace-nowrap w-1/3 truncate"><a href="/post/{{ $comment->post_id }}#comment-{{ $comment->id }}">{{ $comment->id }}</a></td>
                                        <td class="px-3 py-2 whitespace-nowrap w-1/3"><a href="/profile/{{ $comment->user->username }}">{{ $comment->user->username }}</a></td>
                                        {{-- <td class="px-3 py-2 whitespace-nowrap">{{ $comment->email }}</td> --}}
                                        <td class="px-3 py-2 whitespace-nowrap w-1/3 flex items-center justify-center">
                                            <button 
                                                @click="
                                                Swal.fire({
                                                    title: 'Hapus Komentar',
                                                    text: 'Apakah anda yakin ingin menghapus komentar ini?',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Hapus',
                                                    cancelButtonText: 'Batal',
                                                    allowOutsideClick: false
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        axios.post('/comment/{{ $comment->id }}', {
                                                            _method: 'DELETE', 
                                                            data: {
                                                                _token: '{{ csrf_token() }}'
                                                            }
                                                        })
                                                        .then(() => {
                                                            Swal.fire('Berhasil!', 'Komentar berhasil dihapus!', 'success')
                                                            .then(() => {
                                                                window.location.reload();
                                                            })
                                                        })
                                                        .catch((error) => {
                                                            console.error(error);
                                                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus komentar.', 'error')
                                                        });
                                                    }
                                                }) "
                                                class="text-lg text-red-600 cursor-pointer">
                                                <i class="fa-light fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="*:text-gray-900 *:first:font-normal text-sm dark:*:text-white">
                                        <td colspan="3" class="px-3 py-2 whitespace-nowrap text-center opacity-75">Tidak ada laporan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            
</x-adminlayout>
