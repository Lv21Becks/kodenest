<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard - ' . config('app.name', 'KodeNest'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans font-medium text-gray-900 bg-gray-50 overflow-hidden" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        <!-- Desktop Sidebar -->
        <aside
            class="hidden w-[260px] overflow-y-auto border-r border-gray-200 bg-white md:block flex-shrink-0 relative">
            <div class="flex h-full flex-col">
                <!-- Logo -->
                <div class="flex h-16 items-center px-4 shrink-0 border-b border-gray-100 bg-white sticky top-0 z-10">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 w-full">
                        <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest" class="h-8 w-auto">
                        <span class="text-lg font-bold text-gray-900 tracking-tight">Admin Panel</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 space-y-8 px-4 py-8">

                    @include('admin.partials.sidebar-nav')
                </nav>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex flex-1 flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                    <!-- Mobile Menu Button -->
                    <button @click="sidebarOpen = true"
                        class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500 md:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Page Header Title -->
                    <div class="flex-1 px-2 lg:px-6 min-w-0">
                        <h1 class="text-base sm:text-xl lg:text-2xl font-black text-gray-900 tracking-tight truncate">@yield('title', 'Admin Dashboard')</h1>
                    </div>

                    <!-- Header Right Section -->
                    <div class="flex items-center gap-2">
                        <!-- View Website -->
                        <a href="{{ url('/') }}" target="_blank"
                            class="p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-50 rounded-full transition-colors hidden sm:block"
                            title="View Website">
                            <i class="fas fa-globe text-lg"></i>
                        </a>

                        <!-- Notifications Dropdown -->
                        <div class="relative" x-data="{ notifOpen: false }">
                            <button @click="notifOpen = !notifOpen" @click.away="notifOpen = false"
                                class="relative p-2 text-gray-400 hover:text-orange-500 hover:bg-orange-50 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                                <span class="sr-only">View notifications</span>
                                <i class="fas fa-bell text-lg"></i>
                                @if(($totalNotificationsCount ?? 0) > 0)
                                    <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 ring-2 ring-white"></span>
                                    </span>
                                @endif
                            </button>

                            <!-- Dropdown Panel -->
                            <div x-show="notifOpen" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-50 mt-2 w-80 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none overflow-hidden"
                                style="display: none;">
                                
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                                    <span class="text-sm font-bold text-gray-900">Notifications</span>
                                    @if(($totalNotificationsCount ?? 0) > 0)
                                        <span class="px-2 py-0.5 rounded-full bg-red-100 text-red-700 text-xs font-bold">{{ $totalNotificationsCount }} New</span>
                                    @endif
                                </div>

                                <div class="max-h-96 overflow-y-auto">
                                    @if(($totalNotificationsCount ?? 0) === 0)
                                        <div class="px-4 py-6 text-center text-sm text-gray-500">
                                            <i class="fas fa-check-circle text-green-400 text-2xl mb-2"></i>
                                            <p>You're all caught up!</p>
                                        </div>
                                    @else
                                        <!-- Pending Applications -->
                                        @foreach($pendingApplicationsList ?? [] as $app)
                                            <a href="{{ route('admin.applications.index') }}" class="block px-4 py-3 border-b border-gray-50 hover:bg-orange-50 transition-colors">
                                                <div class="flex items-start gap-3">
                                                    <div class="mt-0.5 flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                                        <i class="fas fa-file-signature text-xs"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-semibold text-gray-900">New Application</p>
                                                        <p class="text-xs text-gray-500 mt-0.5 truncate">{{ $app->first_name }} {{ $app->last_name }} applied for {{ optional($app->program)->title ?? 'a program' }}</p>
                                                        <p class="text-[10px] text-gray-400 mt-1"><i class="far fa-clock"></i> {{ optional($app->created_at)->diffForHumans() ?? 'recently' }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach

                                        <!-- Pending Payments -->
                                        @foreach($pendingPaymentsList ?? [] as $payment)
                                            <a href="{{ route('admin.payments.index') }}" class="block px-4 py-3 border-b border-gray-50 hover:bg-orange-50 transition-colors">
                                                <div class="flex items-start gap-3">
                                                    <div class="mt-0.5 flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                                        <i class="fas fa-file-invoice-dollar text-xs"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-semibold text-gray-900">Payment Verification</p>
                                                        <p class="text-xs text-gray-500 mt-0.5 truncate">₦{{ number_format($payment->amount ?? 0) }} received from {{ optional(optional($payment->student)->user)->name ?? 'Student' }}</p>
                                                        <p class="text-[10px] text-gray-400 mt-1"><i class="far fa-clock"></i> {{ optional($payment->created_at)->diffForHumans() ?? 'recently' }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="h-6 w-px bg-gray-200 mx-2 hidden sm:block"></div>

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ userMenuOpen: false }">
                            <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false"
                                class="flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 rounded-full p-1 border border-transparent hover:border-gray-200 transition-colors">
                                <span class="sr-only">Open user menu</span>
                                <div
                                    class="h-8 w-8 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex justify-center items-center text-white font-bold shadow-sm text-sm">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                </div>
                                <span
                                    class="hidden text-sm font-semibold text-gray-700 md:block">{{ Auth::user()->name ?? 'Admin' }}</span>
                                <i class="fas fa-chevron-down text-xs text-gray-400 hidden md:block"></i>
                            </button>

                            <!-- User Dropdown Menu -->
                            <div x-show="userMenuOpen" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-xl bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                style="display: none;">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ Auth::user()->name ?? 'Admin User' }}</p>
                                    <p class="text-xs font-medium text-gray-500 truncate">{{ Auth::user()->email ?? 'admin@kodenest.com' }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 font-medium transition-colors">Your
                                    Profile</a>
                                <a href="{{ route('admin.settings.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 font-medium transition-colors">Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 font-bold transition-colors">Sign
                                        out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50/50">
                <!-- Mobile Sidebar Overlay  -->
                <div x-show="sidebarOpen" class="fixed inset-0 z-40 flex md:hidden" style="display: none;"
                    aria-modal="true" role="dialog">
                    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-linear duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm" @click="sidebarOpen = false"
                        aria-hidden="true"></div>

                    <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in-out duration-300 transform"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                        class="relative flex w-full max-w-xs flex-1 flex-col bg-white overflow-y-auto pb-4">

                        <div class="absolute right-0 top-0 -mr-12 pt-4">
                            <button @click="sidebarOpen = false" type="button"
                                class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                                <span class="sr-only">Close sidebar</span>
                                <i class="fas fa-times text-white text-xl"></i>
                            </button>
                        </div>

                        <div
                            class="flex h-16 shrink-0 items-center px-4 border-b border-gray-100 bg-white sticky top-0 z-10">
                            <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest" class="h-8 w-auto">
                            <span class="ml-3 text-lg font-bold text-gray-900 tracking-tight">Admin Panel</span>
                        </div>

                        <!-- Mobile Navigation -->
                        <nav class="flex-1 space-y-8 px-4 py-6">
                            @include('admin.partials.sidebar-nav')
                        </nav>
                    </div>
                </div>

                <!-- Flash Messages Area -->
                <div class="px-4 sm:px-6 lg:px-8 xl:px-10 mt-6 lg:mt-8">
                    @if (session('success'))
                        <div class="mb-4 rounded-xl bg-green-50 p-4 border border-green-100 shadow-sm flex items-start">
                            <i class="fas fa-check-circle text-green-500 text-lg mr-3 mt-0.5"></i>
                            <div class="flex-1 text-sm font-medium text-green-800">{{ session('success') }}</div>
                            <button @click="$event.target.closest('div').remove()"
                                class="text-green-600 hover:text-green-800 focus:outline-none">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 rounded-xl bg-red-50 p-4 border border-red-100 shadow-sm flex items-start">
                            <i class="fas fa-exclamation-circle text-red-500 text-lg mr-3 mt-0.5"></i>
                            <div class="flex-1 text-sm font-medium text-red-800">{{ session('error') }}</div>
                            <button @click="$event.target.closest('div').remove()"
                                class="text-red-600 hover:text-red-800 focus:outline-none">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif
                </div>

                <div class="py-6 lg:py-8">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 xl:px-10">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInputs = document.querySelectorAll('input[name="search"]');
            searchInputs.forEach(input => {
                let timeout = null;
                const form = input.closest('form');
                if (!form) return;

                input.addEventListener('input', (e) => {
                    clearTimeout(timeout);
                    const container = document.querySelector('table')?.closest('div.overflow-x-auto') || document.querySelector('table');
                    if (!container) return;

                    // Add loading indicator
                    container.classList.add('opacity-40', 'transition-opacity', 'duration-200');

                    timeout = setTimeout(() => {
                        const url = new URL(form.action || window.location.href);
                        const formData = new FormData(form);

                        // Sync current search value to URL
                        url.searchParams.set('search', e.target.value);

                        // Sync other form fields (e.g. status tabs, program filters)
                        for (const [key, value] of formData.entries()) {
                            if (key !== '_token' && value) url.searchParams.set(key, value);
                        }

                        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                            .then(res => res.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const newContent = doc.querySelector('table');
                                const oldContent = document.querySelector('table');

                                if (newContent && oldContent) {
                                    oldContent.innerHTML = newContent.innerHTML;

                                    // Update pagination if it exists
                                    const newPagination = doc.querySelector('.mt-4, .px-6.py-4.border-t');
                                    const oldPagination = document.querySelector('.mt-4, .px-6.py-4.border-t');
                                    if (newPagination && oldPagination) {
                                        oldPagination.innerHTML = newPagination.innerHTML;
                                    } else if (newPagination) {
                                        oldContent.insertAdjacentHTML('afterend', newPagination.outerHTML);
                                    }
                                }
                                container.classList.remove('opacity-40');
                            })
                            .catch(err => {
                                console.error('Live search error:', err);
                                container.classList.remove('opacity-40');
                            });
                    }, 400); // 400ms debounce
                });
            });
        });
    </script>
</body>

</html>