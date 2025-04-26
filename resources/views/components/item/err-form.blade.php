@props(['name'])

@error($name)
    <i class="px-1 text-[.7rem] text-red-500 font-semibold">{{ $message }}</i>
@enderror
