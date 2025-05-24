<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Website Học Liệu' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 font-sans">

    {{-- Navbar --}}
    <x-navbar />

    <main class="container mx-auto mt-6 px-4">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer />

</body>
</html>
