<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - KodeNest</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        'brand-purple': '#7B2D8E',
                        'brand-pink': '#C2185B',
                        'brand-action': '#FF5500' // Keeping action color requested
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans text-gray-900 antialiased">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed left-0 top-0 h-screen w-64 bg-gradient-to-b from-brand-purple to-brand-pink text-white shadow-2xl z-50 overflow-y-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="p-6 border-b border-white/20 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest"
                        class="w-16 h-16 object-contain">
                </div>
                <div>
                    <div class="font-black text-lg">KodeNest</div>
                    <div class="text-xs opacity-80">Admin Panel</div>
                </div>
            </div>
            <!-- Close Button for Mobile -->
            <button onclick="toggleSidebar()" class="lg:hidden text-white/80 hover:text-white">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <nav class="p-4 space-y-1">
            <!-- CORE -->
            <div class="text-xs font-bold text-white/50 uppercase tracking-wider mb-2 mt-2 px-4">Core</div>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-chart-line w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.students.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.students.*') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-users w-5"></i>
                <span>Students</span>
            </a>
            <a href="{{ route('admin.enrollments.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.enrollments.*') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-file-alt w-5"></i>
                <span>Enrollments</span>
                @if(isset($pendingEnrollmentsCount) && $pendingEnrollmentsCount > 0)
                    <span
                        class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingEnrollmentsCount }}</span>
                @endif
            </a>

            <!-- PROGRAMS -->
            <div class="text-xs font-bold text-white/50 uppercase tracking-wider mb-2 mt-6 px-4">Programs</div>
            <a href="{{ route('admin.programs.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.programs.*') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-book w-5"></i>
                <span>Programs</span>
            </a>
            <a href="{{ route('admin.features.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.features.*') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-list-ul w-5"></i>
                <span>Features</span>
            </a>

            <!-- CONTENT -->
            <div class="text-xs font-bold text-white/50 uppercase tracking-wider mb-2 mt-6 px-4">Content</div>
            <a href="{{ route('admin.blog-posts.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.blog-posts.*') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-edit w-5"></i>
                <span>Blog Posts</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-star w-5"></i>
                <span>Testimonials</span>
            </a>
            <a href="{{ route('admin.seo-meta.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.seo-meta.*') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-search w-5"></i>
                <span>SEO Meta</span>
            </a>
            <a href="{{ route('admin.newsletter.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.newsletter.*') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-envelope w-5"></i>
                <span>Newsletter</span>
            </a>

            <!-- SYSTEM -->
            <div class="text-xs font-bold text-white/50 uppercase tracking-wider mb-2 mt-6 px-4">System</div>
            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-white/20 text-white font-semibold' : 'text-white/80 hover:bg-white/10' }} transition-all">
                <i class="fas fa-cog w-5"></i>
                <span>System Settings</span>
            </a>
        </nav>
    </aside>

    <!-- Overlay for Mobile -->
    <div id="sidebarOverlay" onclick="toggleSidebar()"
        class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden backdrop-blur-sm transition-opacity"></div>

    <!-- Main Content -->
    <main class="lg:ml-64 min-h-screen flex flex-col">
        <!-- Top Bar -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
            <div class="flex items-center justify-between px-8 py-4">
                <div>
                    <h1 class="text-2xl font-black text-gray-800">@yield('title')</h1>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" target="_blank"
                        class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors" title="View Website">
                        <i class="fas fa-globe text-xl"></i>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="p-2 text-gray-600 hover:bg-red-50 text-red-600 rounded-lg transition-colors"
                            title="Logout">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-8 pt-6">
            @if (session('success'))
                <div class="mb-4 rounded-xl bg-green-50 p-4 border border-green-100 shadow-sm flex items-center">
                    <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-xl bg-red-50 p-4 border border-red-100 shadow-sm flex items-center">
                    <i class="fas fa-times-circle text-red-500 text-xl mr-3"></i>
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            @endif
        </div>

        <!-- Dashboard Content -->
        <div class="p-8 flex-1">
            @yield('content')
        </div>

    </main>

    <!-- Mobile Menu Toggle -->
    <button onclick="toggleSidebar()"
        class="fixed bottom-6 right-6 lg:hidden w-14 h-14 bg-gradient-to-br from-brand-purple to-brand-pink text-white rounded-full shadow-2xl flex items-center justify-center z-50 hover:scale-110 transition-transform">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                // Open
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                // Close
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>

</body>

</html>