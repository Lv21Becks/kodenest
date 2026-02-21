@extends('layouts.admin')

@section('title', 'Programs Management')

@section('content')

    <div class="p-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-book"></i>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">Active</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Total Programs</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_programs'] }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="text-xs font-bold text-blue-500 bg-blue-50 px-2 py-1 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Enrollments</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_enrollments'] }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">All Time</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Total Revenue</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">₦{{ number_format($stats['total_revenue'] / 1000000, 1) }}M
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="text-xs font-bold text-orange-500 bg-orange-50 px-2 py-1 rounded-full">Avg</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Rating</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['avg_rating'] }}</p>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex flex-wrap gap-4 items-center justify-between">
                <button onclick="openAddProgramModal()"
                    class="px-6 py-3 bg-gradient-to-r from-brand-purple to-brand-pink text-white font-bold rounded-lg hover:shadow-xl transition-all flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Add New Program
                </button>
                <div class="flex gap-3">
                    <button
                        class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                        <i class="fas fa-download"></i>
                        Export Report
                    </button>
                    <button
                        class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-2">
                        <i class="fas fa-chart-bar"></i>
                        Analytics
                    </button>
                </div>
            </div>
        </div>

        <!-- Search & Filters -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <form action="{{ route('admin.programs.index') }}" method="GET"
                class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative w-full md:w-1/2">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search programs..."
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-100 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                </div>
                <div class="flex gap-4 w-full md:w-auto">
                    <select name="status" onchange="this.form.submit()"
                        class="px-4 py-3 border-2 border-gray-100 rounded-lg focus:border-brand-purple focus:outline-none transition-colors text-gray-600 font-semibold cursor-pointer">
                        <option value="">All Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active Only</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive Only</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Programs Grid -->
        @php
            $colors = ['blue', 'purple', 'red', 'pink', 'gray', 'yellow'];
            $bgColors = [
                'blue' => 'bg-gradient-to-br from-blue-500 to-cyan-600',
                'purple' => 'bg-gradient-to-br from-purple-600 to-pink-600',
                'red' => 'bg-gradient-to-br from-red-600 to-orange-600',
                'pink' => 'bg-gradient-to-br from-pink-500 to-rose-600',
                'gray' => 'bg-gradient-to-br from-gray-600 to-gray-800',
                'yellow' => 'bg-gradient-to-br from-yellow-500 to-orange-500',
            ];
            $textColors = [
                'blue' => 'text-blue-600',
                'purple' => 'text-purple-600',
                'red' => 'text-red-600',
                'pink' => 'text-pink-600',
                'gray' => 'text-gray-600',
                'yellow' => 'text-yellow-600',
            ];
            $borderColors = [
                'blue' => 'border-blue-500',
                'purple' => 'border-purple-500',
                'red' => 'border-red-500',
                'pink' => 'border-pink-500',
                'gray' => 'border-gray-500',
                'yellow' => 'border-yellow-500',
            ];
        @endphp

        @if($programs->count() > 0)
            <div id="programs-grid" class="grid md:grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                @foreach($programs as $index => $program)
                    @php
                        $colorKey = $colors[$index % count($colors)];
                        $bgClass = $bgColors[$colorKey];
                        $textClass = $textColors[$colorKey];
                        $borderClass = $borderColors[$colorKey];
                        $formattedRevenue = $program->revenue > 1000000
                            ? '₦' . number_format($program->revenue / 1000000, 1) . 'M'
                            : '₦' . number_format($program->revenue / 1000, 0) . 'k';
                    @endphp
                    <div data-id="{{ $program->id }}"
                        class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all border-t-4 {{ $borderClass }}">
                        <div class="{{ $bgClass }} p-8 text-white text-center cursor-move handle">
                            @if($program->image_icon)
                                <img src="{{ asset('storage/' . $program->image_icon) }}" class="w-16 h-16 mx-auto mb-4 object-contain">
                            @else
                                <div class="text-6xl mb-4">🎓</div>
                            @endif
                            <h3 class="text-2xl font-black mb-2">{{ $program->title }}</h3>
                            <p class="text-sm opacity-90">{{ Str::limit($program->description, 150) }}</p>
                        </div>

                        <div class="p-6 space-y-4">
                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-2 text-center pb-4 border-b border-gray-100">
                                <div>
                                    <div class="text-2xl font-black {{ $textClass }}">{{ $program->student_count }}</div>
                                    <div class="text-xs text-gray-600">Students</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-black text-green-600">{{ $formattedRevenue }}</div>
                                    <div class="text-xs text-gray-600">Revenue</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-black text-orange-600">{{ $program->rating }}</div>
                                    <div class="text-xs text-gray-600">Rating</div>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Duration:</span>
                                    <span class="font-semibold text-gray-800">{{ $program->duration }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Price:</span>
                                    <span class="font-semibold text-gray-800">₦{{ number_format($program->price) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Mode:</span>
                                    <span class="font-semibold text-gray-800">Online/Physical</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <button onclick="toggleStatus({{ $program->id }})" id="status-toggle-{{ $program->id }}"
                                        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $program->status ? 'bg-green-500' : 'bg-gray-300' }}">
                                        <span
                                            class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $program->status ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                    </button>
                                    <span id="status-text-{{ $program->id }}"
                                        class="text-xs font-bold {{ $program->status ? 'text-green-600' : 'text-gray-500' }} ml-2">
                                        {{ $program->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2 pt-4">
                                <button onclick="window.location='{{ route('admin.programs.edit', $program) }}'"
                                    class="flex-1 px-4 py-2 {{ str_replace('text-', 'bg-', $textClass) }} text-white rounded-lg hover:opacity-90 transition-colors text-sm font-semibold">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <a href="{{ route('programs.show', $program->slug) }}" target="_blank"
                                    class="flex-1 text-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm font-semibold flex items-center justify-center">
                                    <i class="fas fa-external-link-alt mr-1"></i>Preview
                                </a>

                                <form action="{{ route('admin.programs.duplicate', $program) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Duplicate this program?');">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm"
                                        title="Duplicate">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm"
                                        title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Performance Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Detailed Program Performance</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Program</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Students</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Revenue</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Avg. Rating</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Completion</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Growth</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($programs as $program)
                                @php
                                    $formattedRevenue = $program->revenue > 1000000
                                        ? '₦' . number_format($program->revenue / 1000000, 1) . 'M'
                                        : '₦' . number_format($program->revenue / 1000, 0) . 'k';
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if($program->image_icon)
                                                <img src="{{ asset('storage/' . $program->image_icon) }}"
                                                    class="w-10 h-10 object-contain">
                                            @else
                                                <div class="text-3xl">🎓</div>
                                            @endif
                                            <div>
                                                <div class="font-semibold text-gray-800">{{ $program->title }}</div>
                                                <div class="text-xs text-gray-500">{{ $program->duration }} •
                                                    ₦{{ number_format($program->price / 1000) }}k</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $program->student_count }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-green-600">{{ $formattedRevenue }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1">
                                            <span class="text-sm font-semibold text-gray-800">{{ $program->rating }}</span>
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 bg-gray-200 rounded-full h-2 w-20">
                                                <div class="bg-green-500 h-2 rounded-full"
                                                    style="width: {{ $program->completion_rate }}%"></div>
                                            </div>
                                            <span
                                                class="text-sm font-semibold text-gray-700">{{ $program->completion_rate }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">+{{ $program->growth }}%
                                            ↑</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <button onclick="window.location='{{ route('admin.programs.edit', $program) }}'"
                                                class="text-blue-600 hover:text-blue-800 text-sm font-semibold" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.programs.duplicate', $program) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Duplicate?');">
                                                @csrf
                                                <button type="submit"
                                                    class="text-gray-600 hover:text-gray-800 text-sm font-semibold"
                                                    title="Duplicate">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.programs.destroy', $program) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Delete?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold"
                                                    title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
                <div class="mb-6">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-folder-open text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">No Programs Found</h3>
                    <p class="text-gray-500 max-w-sm mx-auto">
                        {{ request('search') || request('status') ? 'We couldn\'t find any programs matching your filters. Try adjusting your search.' : 'Get started by creating your first educational program.' }}
                    </p>
                </div>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.programs.index') }}"
                        class="px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors inline-block">
                        Clear Filters
                    </a>
                @else
                    <button onclick="openAddProgramModal()"
                        class="px-6 py-3 bg-gradient-to-r from-brand-purple to-brand-pink text-white font-bold rounded-lg hover:shadow-xl transition-all inline-block">
                        <i class="fas fa-plus mr-2"></i>Create New Program
                    </button>
                @endif
            </div>
        @endif
    </div>

    <!-- Add Program Modal -->
    <div id="addProgramModal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
            <div
                class="sticky top-0 bg-gradient-to-r from-brand-purple to-brand-pink text-white px-8 py-6 flex items-center justify-between">
                <h2 class="text-2xl font-black">Add New Program</h2>
                <button onclick="closeAddProgramModal()"
                    class="text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data"
                class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Program Name *</label>
                        <input type="text" name="title" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                            placeholder="e.g., Machine Learning">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Program Icon (Image)</label>
                        <input type="file" name="image_icon"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                        <p class="text-xs text-gray-500 mt-1">Upload a 3D icon or image</p>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Target Audience / Short Description
                            *</label>
                        <textarea name="target_audience" rows="2" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                            placeholder="Who is this course for?"></textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Full Description *</label>
                        <textarea name="description" rows="4" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                            placeholder="Detailed description of what students will learn"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Duration *</label>
                        <input type="text" name="duration" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                            placeholder="e.g., 12 Weeks">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Price (₦) *</label>
                        <input type="number" name="price" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                            placeholder="99000">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status *</label>
                        <select name="status"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Order</label>
                        <input type="number" name="order"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                            placeholder="0">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Skills Covered</label>
                        <textarea name="skills" rows="3" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                            placeholder="Enter skills separated by commas (e.g., Python, SQL, Data Visualization)"></textarea>
                        <p class="text-xs text-gray-500 mt-1">Separate each skill with a comma</p>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 px-6 py-4 bg-gradient-to-r from-brand-purple to-brand-pink text-white font-bold rounded-lg hover:shadow-xl transition-all">
                        <i class="fas fa-save mr-2"></i>Create Program
                    </button>
                    <button type="button" onclick="closeAddProgramModal()"
                        class="flex-1 px-6 py-4 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script>
        // Drag and Drop
        document.addEventListener('DOMContentLoaded', function () {
            var el = document.getElementById('programs-grid');
            var sortable = Sortable.create(el, {
                handle: '.handle', // drag handle class
                animation: 150,
                ghostClass: 'bg-blue-100', // Class name for the drop placeholder
                onEnd: function (evt) {
                    var order = sortable.toArray(); // Get the new order of IDs
                    // data-id is automatically used by toArray() if configured, else we iterate
                    // Sortable default looks for data-id by default!

                    fetch('{{ route('admin.programs.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: order })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Optional toast
                            }
                        });
                }
            });
        });

        // Modal Functions
        function openAddProgramModal() {
            document.getElementById('addProgramModal').classList.remove('hidden');
        }

        function closeAddProgramModal() {
            document.getElementById('addProgramModal').classList.add('hidden');
        }

        // Close modal on outside click
        document.getElementById('addProgramModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeAddProgramModal();
            }
        });

        // Close modal on ESC key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeAddProgramModal();
            }
        });

        // Toggle Status AJAX
        function toggleStatus(id) {
            const btn = document.getElementById(`status-toggle-${id}`);
            const text = document.getElementById(`status-text-${id}`);
            const span = btn.querySelector('span');

            // Optimistic UI Update
            const isNowActive = !btn.classList.contains('bg-green-500'); // currently not green -> will be green

            if (isNowActive) {
                btn.classList.remove('bg-gray-300');
                btn.classList.add('bg-green-500');
                span.classList.remove('translate-x-1');
                span.classList.add('translate-x-6');
                text.textContent = 'Active';
                text.classList.remove('text-gray-500');
                text.classList.add('text-green-600');
            } else {
                btn.classList.remove('bg-green-500');
                btn.classList.add('bg-gray-300');
                span.classList.remove('translate-x-6');
                span.classList.add('translate-x-1');
                text.textContent = 'Inactive';
                text.classList.remove('text-green-600');
                text.classList.add('text-gray-500');
            }

            // API Call
            fetch(`/admin/programs/${id}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        // Revert if failed
                        alert('Failed to update status');
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                    // Revert
                    location.reload();
                });
        }
    </script>
@endsection