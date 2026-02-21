<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Dynamic SEO --}}
    @if(isset($seo))
        <title>{{ $seo->title ?? 'KodeNest ICT Academy' }}</title>
        <meta name="description" content="{{ $seo->description ?? 'Building Africa\'s Next Generation of Tech Talent' }}">
        <meta name="keywords" content="{{ $seo->keywords ?? 'tech, coding, academy, africa, nigeria, delta state' }}">

        {{-- Open Graph --}}
        <meta property="og:title" content="{{ $seo->title ?? 'KodeNest ICT Academy' }}">
        <meta property="og:description"
            content="{{ $seo->description ?? 'Building Africa\'s Next Generation of Tech Talent' }}">
        @if($seo->og_image)
            <meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
        @endif
        <meta property="og:type" content="website">
    @else
        <title>@yield('title', 'KodeNest ICT Academy')</title>
        <meta name="description" content="@yield('meta_description', 'Building Africa\'s Next Generation of Tech Talent')">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal-left.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal-right.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-zoom {
            opacity: 0;
            transform: scale(0.9);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal-zoom.active {
            opacity: 1;
            transform: scale(1);
        }
    </style>
</head>

<body class="font-sans font-medium text-gray-900 overflow-x-hidden bg-gray-50 @yield('body_class')">

    {{-- Navbar --}}
    <x-public-navbar />

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-public-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px"
            });

            document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
    @stack('scripts')
</body>

</html>