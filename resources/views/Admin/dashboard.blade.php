<x-adminlayout>
    <x-slot:title>SudutLain - Dashboard Admin</x-slot:title>


    @php
        $links = [
            ['url' => '/', 'label' => 'Home', 'icon' => 'fa-house'],
            ['url' => '/admin', 'label' => 'Dashboard', 'icon' => 'fa-gauge'],
            ['url' => '/profile', 'label' => 'Profile', 'icon' => 'fa-user'],
            ['url' => '/admin/reportedpost', 'label' => 'Reported Post', 'icon' => 'fa-flag'],
            ['url' => '/admin/reportedcomment', 'label' => 'Reported Comment', 'icon' => 'fa-comment'],
            ['url' => '/admin/user', 'label' => 'User', 'icon' => 'fa-users'],
        ];
    @endphp

    <main
    x-data="{navOpen: false  , inputValue: '', scrolled: false, lastScrollTop: 0, hideHeader: false}"
    x-init="
        scrolled = window.scrollY > 15;
        lastScrollTop = window.scrollY;
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 15;
            let currentScroll = window.scrollY;
            hideHeader=currentScroll > lastScrollTop && currentScroll > 50;
                lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // prevent negative
            })
            "
        class="min-w-full max-w-full min-h-screen w-full h-full bg-sl-base text-sl-text relative pb-10"
        >
        <nav @click.outside="navOpen = false">
            <header 
                :class="[
                    navOpen ? 'border-b border-b-white' : 'border-b border-b-transparent',
                    hideHeader ? '-top-20' : 'top-0'
                ]"
                class="flex fixed justify-between items-center transition-all w-full duration-300 left-0 z-20 bg-sl-septenary h-16 md:h-18 px-4  sm:px-10 lg:px-20 xl:px-32 2xl:px-40"
                style="transition-property: top, border-bottom;"
            >
                <a href="/admin" class="flex items-center">
                    <img src="{{ asset('img/logo/sudutlain_icon.png') }}" alt="Logo" class="h-8 mr-2">
                    <h1 class="text-lg font-bold text-white">Dashboard Admin</h1>
                </a>
                <div class="flex items-center">
                    <nav class="hidden gap-x-4 md:flex items-center">
                        <a href="/" class="text-white hover:text-gray-300 hover:underline">Home</a>
                        <a href="/profile" class="text-white hover:text-gray-300 hover:underline">Profile</a>
                    </nav>
                    <div class="flex items-center h-full">
                        <a href="/" class="ml-4 text-white md:hidden text-2xl hover:text-gray-300 max-h-fit flex items-center focus:outline-none">
                            <i class="fa-light fa-home"></i>
                        </a>
                        <button @click="navOpen = !navOpen" class="ml-4 text-white text-2xl max-h-fit flex items-center hover:text-gray-300 focus:outline-none">
                            <i class="fa-light" :class="!navOpen ? 'fa-bars' : 'fa-xmark'"></i>
                        </button>
                    </div>
                </div>
            </header>
            <aside
                x-cloak
                :class="(navOpen ? 'left-0' : '-left-65') + (hideHeader ? ' top-0' : ' top-16 md:top-18')"
                class="min-h-screen min-w-65 max-w-65 bg-sl-septenary fixed z-40 h-full w-19 shadow-xs shadow-neutral-500 transition-all duration-300 pt-5"
            >
                <div class="flex flex-col gap-4 text-lg md:text-base font-medium items-start justify-start h-full pl-4 pr-6 py-2 w-full">
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}" class="text-sl-text hover:text-gray-300 px-2 w-full h-9 rounded-sm flex whitespace-pre-wrap items-center  relative"><i class="fa-light {{ $link['icon'] }}"> </i> {{ $link['label'] }} <i class="absolute right-0 text-sm md:text-xs fa-light fa-angle-right"></i></a>
                    @endforeach
        </nav>

        <article class="flex flex-col min-w-full max-w-full min-h-screen h-auto px-5 pt-20 md:pt-24 transition-all xs:px-7 sm:px-10 lg:px-20 xl:px-32 2xl:px-45 gap-y-15">
            <section class="flex w-full max-w-full min-w-full items-center justify-around gap-2 md:gap-5 flex-wrap bg-sl-quinary/30 p-2 md:px-5 rounded-lg">

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

            <section class="flex w-full max-w-full min-w-full items-center justify-center gap-2 md:gap-5 bg-sl-quinary/30 p-2 md:px-5 rounded-lg">
                <div class="w-full min-h-20 mt-1">
                    <h1 class="ml-1 mb-1 font-semibold text-xl flex items-center justify-center w-fit whitespace-pre"><i class="fa-light fa-rectangle-history text-lg"></i> Reported Post:</h1>
                    <div class="overflow-x-auto bg-sl-quinary rounded-md border border-sl-text/25 max-h-50 no-scrollbar">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
                            <thead class="ltr:text-left rtl:text-right bg-sl-septenary">
                            <tr class="*:font-medium *:text-gray-900 dark:*:text-white">
                                <th class="px-3 py-2 whitespace-nowrap max-w-10">Post</th>
                                <th class="px-3 py-2 whitespace-nowrap">User</th>
                                {{-- <th class="px-3 py-2 whitespace-nowrap">Email</th> --}}
                                <th class="px-3 py-2 whitespace-nowrap flex items-center justify-center">Hapus Post</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-sl-septenary/40">
                                @forelse ($reportedPosts as $post)
                                    <tr class="*:text-gray-900 *:first:font-normal text-sm dark:*:text-white">
                                        <td class="px-3 py-2 whitespace-nowrap max- truncate"><a href="/post/{{ $post->id }}">{{ $post->id }}</a></td>
                                        <td class="px-3 py-2 whitespace-nowrap"><a href="/profile/{{ $post->user->username }}">{{ $post->user->username }}</a></td>
                                        {{-- <td class="px-3 py-2 whitespace-nowrap">{{ $post->email }}</td> --}}
                                        <td class="px-3 py-2 whitespace-nowrap flex items-center justify-center">
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

                <div class="w-full min-h-20 mt-1">
                    <h1 class="ml-1 mb-1 font-semibold text-xl flex items-center justify-center w-fit whitespace-pre"><i class="fa-light fa-comment text-lg"></i> Reported Comment:</h1>
                    <div class="overflow-x-auto bg-sl-quinary rounded-md border border-sl-text/25 max-h-50 no-scrollbar">
                        <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
                            <thead class="ltr:text-left rtl:text-right bg-sl-septenary">
                            <tr class="*:font-medium *:text-gray-900 dark:*:text-white">
                                <th class="px-3 py-2 whitespace-nowrap max-w-15">Comment</th>
                                <th class="px-3 py-2 whitespace-nowrap">User</th>
                                <th class="px-3 py-2 whitespace-nowrap flex items-center justify-center">Hapus Comment</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-sl-septenary/40">
                                @forelse ($reportedComments as $post)
                                    <tr class="*:text-gray-900 *:first:font-normal text-sm dark:*:text-white">
                                        <td class="px-3 py-2 whitespace-nowrap max- truncate"><a href="/post/{{ $post->post_id }}#comment-{{ $post->id }}">{{ $post->id }}</a></td>
                                        <td class="px-3 py-2 whitespace-nowrap"><a href="/profile/{{ $post->user->username }}">{{ $post->user->username }}</a></td>
                                        {{-- <td class="px-3 py-2 whitespace-nowrap">{{ $post->email }}</td> --}}
                                        <td class="px-3 py-2 whitespace-nowrap flex items-center justify-center">
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
                                                        axios.post('/comment/{{ $post->id }}', {
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
            
        </article>
    </main>
</x-adminlayout>
