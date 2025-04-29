<x-layout>
    <x-slot:title>SudutLain - Edit Profil</x-slot:title>

    <section
        class="w-full min-h-2 h-24 md:h-30 px-3 pb-2 bg-sl-tertiary rounded-md flex flex-col gap-1 justify-center items-center">
        <h1 class="font-bold text-xl md:text-2xl text-purple-700">Edit Profil</h1>
        <p class="text-xs text-center md:text-sm">Perbarui informasi profilmu di sini!</p>
    </section>

    <section
        class="min-w-full max-w-full w-full min-h-2 h-auto bg-sl-tertiary rounded-md px-3 pt-3 pb-3 flex flex-col gap-3 border-2 border-sl-tertiary">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
            class="w-full h-auto flex flex-col gap-3">
            @method('PATCH') <!-- Menggunakan PATCH, karena route menggunakan PATCH -->
            @csrf

            <!-- Display Name -->
            <div class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="display_name" class="px-1 font-semibold">Display Name</label>
                <input type="text" name="display_name" id="display_name"
                    value="{{ old('display_name', auth()->user()->display_name) }}"
                    class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                    placeholder="Masukkan nama tampilan..." required autocomplete="off">
                <x-item.err-form name="display_name" />
            </div>

            <!-- Username -->
            <div class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="username" class="px-1 font-semibold">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', auth()->user()->username) }}"
                    class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                    placeholder="Masukkan username..." required autocomplete="off">
                <x-item.err-form name="username" />
            </div>

            <!-- Password -->
            <div class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="password" class="px-1 font-semibold">Password Baru </label>
                <input type="password" name="password" id="password"
                    class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                    placeholder="Masukkan password baru (opsional)">
                <x-item.err-form name="password" />
            </div>

            <!-- Konfirmasi Password -->
            <div class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="password_confirmation" class="px-1 font-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="group-hover:scale-101 not-placeholder-shown:scale-101 w-full h-10 rounded-md px-2 bg-sl-tertiary focus:outline-none focus:border-sl-secondary/60 not-placeholder-shown:border-sl-primary/70"
                    placeholder="Masukkan ulang password baru">
                <x-item.err-form name="password_confirmation" />
            </div>

            <!-- Avatar -->
            <div class="w-full h-auto flex flex-col gap-2 rounded-md px-2 pt-2 bg-[#28202e] pb-2.5 group">
                <label for="avatar" class="px-1 font-semibold">Avatar</label>
                <input type="file" name="avatar" id="avatar"
                    class="w-full rounded-sm border border-sl-primary bg-sl-tertiary text-sm text-sl-text file:mr-2 file:border-none file:bg-sl-primary/50 file:px-4 file:py-2 file:font-medium file:text-sl-text focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 truncate" />
                <x-item.err-form name="avatar" />
            </div>

            <div class="w-full h-auto px-2 pt-1 pb-2 flex justify-center items-center">
                <button type="submit"
                    class="w-full border-2 border-sl-primary bg-sl-primary font-semibold cursor-pointer rounded-md py-2 hover:bg-sl-primary/50 hover:font-bold hover:scale-102 focus:scale-98">
                    Perbarui Profil
                </button>
            </div>
        </form>
    </section>

    <section
        class="min-w-full max-w-full w-full min-h-2 h-auto bg-sl-tertiary rounded-md px-3 pt-3 pb-3 flex flex-col gap-2 border-2 border-sl-tertiary">
        <h2 class="text-yellow-500 font-bold text-base md:text-lg">Note:</h2>
        <ol class="list-decimal list-inside flex flex-col gap-1 text-xs md:text-sm font-extralight">
            <li>Pastikan semua informasi yang kamu masukkan sudah benar dan sesuai.</li>
            <li>Jika ada kesalahan, kamu bisa mengedit profil lagi nanti.</li>
            <li>Password harus memiliki minimal 8 karakter.</li>
            <li>Password harus huruf dan angka (tanpa simbol).</li>
        </ol>
    </section>
</x-layout>