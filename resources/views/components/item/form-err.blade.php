@props(['name'])

@error($name)
    <span class="text-left text-xs font-light text-red-600">{{ $message }}</span>
@enderror