<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5.0.27/dark.min.css">

    <title>{{ $title }}</title>
</head>

<body class="min-w-full max-w-full min-h-screen bg-sl-base text-sl-text">
    {{ $slot }}
    <script src="/js/swaldef.js" defer></script>
</body>

</html>
