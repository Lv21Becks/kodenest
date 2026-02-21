@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard')

@section('content')
    <!-- Dashboard Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Students Card --}}
        <a href="{{ route('admin.students.index') }}" class="block group">
            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group-hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-purple-50 text-brand-purple rounded-xl flex items-center justify-center text-xl group-hover:bg-brand-purple group-hover:text-white transition-colors">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">+12%</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Total Students</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ \App\Models\Student::count() }}</p>
            </div>
        </a>

        {{-- Programs Card --}}
        <a href="{{ route('admin.programs.index') }}" class="block group">
            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group-hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <span class="text-xs font-bold text-blue-500 bg-blue-50 px-2 py-1 rounded-full">Active</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Total Programs</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ \App\Models\Program::count() }}</p>
            </div>
        </a>

        {{-- Enrollments Card --}}
        <a href="{{ route('admin.enrollments.index') }}" class="block group">
            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group-hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center text-xl group-hover:bg-orange-500 group-hover:text-white transition-colors">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <span class="text-xs font-bold text-orange-500 bg-orange-50 px-2 py-1 rounded-full">New</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">New Enrollments</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">
                    {{ \App\Models\Student::where('status', 'pending')->count() }}</p>
            </div>
        </a>

        {{-- Testimonials --}}
        <a href="{{ route('admin.testimonials.index') }}" class="block group">
            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group-hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-pink-50 text-pink-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-pink-600 group-hover:text-white transition-colors">
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="text-xs font-bold text-pink-500 bg-pink-50 px-2 py-1 rounded-full">Rated</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Testimonials</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ \App\Models\Testimonial::count() }}</p>
            </div>
        </a>
    </div>

    <div class="grid lg:grid-cols-2 gap-8 mb-8">
        {{-- Recent Applications --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Recent Enrollments</h3>
                <a href="{{ route('admin.enrollments.index') }}"
                    class="text-brand-purple text-sm font-semibold hover:underline">View All</a>
            </div>

            <div class="space-y-4">
                @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                    <div
                        class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-brand-purple/10 text-brand-purple flex items-center justify-center font-bold">
                                {{ substr($student->first_name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">{{ $student->first_name }} {{ $student->last_name }}
                                </h4>
                                <p class="text-xs text-gray-500">{{ $student->program }}</p>
                            </div>
                        </div>
                        <span
                            class="text-xs font-medium px-2 py-1 rounded-lg {{ $student->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm text-center py-4">No recent enrollments</p>
                @endforelse
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('admin.programs.create') }}"
                    class="flex flex-col items-center justify-center p-6 rounded-xl bg-purple-50 text-brand-purple hover:bg-brand-purple hover:text-white transition-all group">
                    <i class="fas fa-plus-circle text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="font-bold text-sm">Add Program</span>
                </a>
                <a href="{{ route('admin.blog-posts.create') }}"
                    class="flex flex-col items-center justify-center p-6 rounded-xl bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white transition-all group">
                    <i class="fas fa-pen-fancy text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="font-bold text-sm">Write Post</span>
                </a>
                <a href="{{ route('admin.students.index') }}"
                    class="flex flex-col items-center justify-center p-6 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all group">
                    <i class="fas fa-user-check text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="font-bold text-sm">Review Students</span>
                </a>
                <a href="{{ route('admin.settings.index') }}"
                    class="flex flex-col items-center justify-center p-6 rounded-xl bg-gray-50 text-gray-600 hover:bg-gray-800 hover:text-white transition-all group">
                    <i class="fas fa-sliders-h text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="font-bold text-sm">Settings</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid lg:grid-cols-3 gap-8 mb-8">
        <!-- LEFT COLUMN (2/3) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Urgent Actions -->
            <!-- Urgent Actions -->
            @if(count($actionItems) > 0)
                <div class="bg-red-50 border-2 border-red-200 rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                        <h3 class="text-lg font-bold text-red-800">REQUIRES ATTENTION ({{ count($actionItems) }})</h3>
                    </div>
                    <div class="space-y-3">
                        @foreach($actionItems as $item)
                            <div class="flex items-center justify-between p-4 bg-white rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 {{ $item['dot_color'] }} rounded-full animate-pulse"></div>
                                    <span class="font-semibold text-gray-800">{{ $item['text'] }}</span>
                                </div>
                                <a href="{{ $item['btn_url'] }}"
                                    class="px-4 py-2 {{ $item['btn_class'] }} rounded-lg transition-colors text-sm font-bold">
                                    {{ $item['btn_text'] }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Recent Enrollments -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-800">📝 Latest Activity (Last 7 Days)</h3>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">Export
                            CSV</button>
                        <button
                            class="px-4 py-2 text-sm bg-brand-purple text-white hover:bg-brand-pink rounded-lg transition-colors">View
                            All</button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Type</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentActivity as $activity)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-800">
                                        <div class="flex items-center gap-2">
                                            <i class="{{ $activity->icon }} text-gray-400"></i>
                                            {{ $activity->title }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-600">{{ Str::limit($activity->description, 30) }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-600">{{ $activity->time->format('M d, Y') }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ $activity->action_url }}" class="text-blue-600 hover:text-blue-800"><i
                                                    class="fas fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">No recent activity.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Course Performance (Static for now) -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6">📚 Program Performance</h3>
                <div class="space-y-4">
                    @forelse($programs as $program)
                        <div
                            class="flex items-center justify-between p-4 bg-gradient-to-r {{ $loop->iteration % 2 == 0 ? 'from-blue-50 to-cyan-50' : 'from-purple-50 to-pink-50' }} rounded-xl">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br {{ $loop->iteration % 2 == 0 ? 'from-blue-500 to-cyan-500' : 'from-brand-purple to-brand-pink' }} rounded-xl flex items-center justify-center text-white text-xl">
                                    <i class="fas fa-laptop-code"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-800">{{ $program->title }}</div>
                                    <div class="text-sm text-gray-600">{{ $program->student_count }} students</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-green-600">₦{{ number_format($program->revenue) }}</div>
                                <div class="text-sm text-gray-600">{{ number_format($program->price, 2) }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500 text-center py-4">No programs found.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN (1/3) -->
        <div class="space-y-8">
            <!-- Live Activity -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <h3 class="text-lg font-bold text-gray-800">Live Activity</h3>
                </div>
                <div class="space-y-4">
                    @foreach($recentActivity->take(4) as $activity)
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                            <i class="{{ $activity->icon }} text-brand-purple mt-1"></i>
                            <div class="flex-1">
                                <div class="text-sm font-semibold text-gray-800">{{ $activity->title }}:
                                    {{ Str::limit($activity->description, 20) }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $activity->time->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">📅 Upcoming</h3>
                <div class="space-y-4">
                    <div>
                        <div class="text-sm font-semibold text-gray-600 mb-2">Tomorrow</div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-sm text-gray-800">
                                <i class="fas fa-circle text-xs text-red-500"></i>
                                <span>Feb Cohort starts</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-600 mb-2">This Week</div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-sm text-gray-800">
                                <i class="fas fa-circle text-xs text-yellow-500"></i>
                                <span>Course materials due</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">🔧 System Status</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">Website</span>
                        </div>
                        <span class="text-xs font-semibold text-green-600">Online</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">Database</span>
                        </div>
                        <span class="text-xs font-semibold text-green-600">Healthy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for interaction -->
    <script>
        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                location.reload();
            }
        });
    </script>
@endsection