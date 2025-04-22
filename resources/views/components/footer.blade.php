<footer class="min-w-full max-w-full min-h-50 sm:min-h-32 w-full px-7 py-7 text-sl-text bg-sl-tertiary flex flex-col sm:flex-row ">
    <section class="max-w-full min-h-2 w-full sm:max-w-[35%] md:max-w-55 flex flex-col items-start text-sl-text/70 gap-1 sm:justify-center">
        <img class="h-auto max-h-7 w-auto object-contain grayscale hover:grayscale-0 transition-all" src="{{ asset('img/logo/sudutlain_kombinasi1.png') }}">
        <span class="text-xs font-bold">Sebarkan setiap sudut ke dunia</span>
    </section>
    <section class="max-w-full min-h-2 w-full sm:max-w-[65%] text-sl-text/70 flex flex-wrap mt-2 capitalize justify-start gap-24 items-center">
        <div class="flex flex-col text-xs font-semibold ">
            <span class="text-sm font-bold">Team</span>
            <a class="font-light text-[.7rem] hover:underline cursor-pointer" target="_blank" href="//instagram.com/panjidepari">Panji Depari</a>
            <a class="font-light text-[.7rem] hover:underline cursor-pointer" target="_blank" href="//instagram.com/feri.gnwn_">Feri Gunawan</a>
            <a class="font-light text-[.7rem] hover:underline cursor-pointer" target="_blank" href="//instagram.com/suttkah">Sutanto</a>
            <a class="font-light text-[.7rem] hover:underline cursor-pointer" target="_blank" href="//instagram.com/delricoo_">Delrico</a>
            <a class="font-light text-[.7rem] hover:underline cursor-pointer" target="_blank" href="//instagram.com/_andreaslim_">Andreas Lim</a>
        </div>
        <div class="flex flex-col text-xs font-semibold ">
            <span class="text-sm font-bold">Navigation</span>
            <a class="font-light text-[.7rem] hover:underline cursor-pointer" href="/about">About</a>
            @auth
                <a class="font-light text-[.7rem] hover:underline cursor-pointer" href="/profile">Profil</a>
            @endauth
            @guest
                <a class="font-light text-[.7rem] hover:underline cursor-pointer" href="/login">Login</a>
            @endguest
            <a class="font-light text-[.7rem] hover:underline cursor-pointer" href="/badge">Badges</a>
            <a class="font-light text-[.7rem] hover:underline cursor-pointer" target="_blank" href="//github.com/BriantPanji/tubespwl">Repository</a>
        </div>
    </section>
</footer>