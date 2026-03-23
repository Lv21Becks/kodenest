@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')

    <!-- Header & Stats -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Testimonials</h1>
            <p class="text-gray-500 mt-1">Manage student reviews and "Wall of Love" content.</p>
        </div>
        
        <div class="flex gap-4">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center gap-4 min-w-[160px]">
                <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center text-orange-600">
                    <i class="fas fa-trophy"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-0.5">Avg Rating</p>
                    <p class="text-xl font-bold text-gray-900 leading-none">{{ $stats['avg_rating'] }} / 5</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center gap-4 min-w-[160px]">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                    <i class="fas fa-comment-alt"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-0.5">Total Reviews</p>
                    <p class="text-xl font-bold text-gray-900 leading-none">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Toolbar -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-6 flex flex-wrap gap-4 items-center justify-between">
        <div class="flex gap-3">
            <button onclick="openAddTestimonialModal()"
                class="px-5 py-2.5 bg-orange-600 text-white font-semibold flex items-center gap-2 rounded-lg hover:bg-orange-700 transition-colors shadow-sm text-sm">
                <i class="fas fa-plus"></i>
                Add New Review
            </button>

            <button type="button" onclick="submitBulk('{{ route('admin.testimonials.bulk-delete') }}')"
                class="px-4 py-2.5 bg-white text-gray-900 font-semibold rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors flex items-center gap-2 text-sm ring-1 ring-inset ring-gray-300">
                <i class="fas fa-trash-alt text-red-500"></i>
                Delete Selected
            </button>
        </div>
        
        <form action="{{ route('admin.testimonials.index') }}" method="GET" class="flex gap-2">
            <select name="rating" onchange="this.form.submit()"
                class="px-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 text-gray-700 cursor-pointer min-w-[140px]">
                <option value="">All Ratings</option>
                <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
            </select>
            @if(request('rating'))
                <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center justify-center rounded bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors" title="Clear Filters">
                    <i class="fas fa-times text-red-500"></i>
                </a>
            @endif
        </form>
    </div>



    <form id="bulkForm" method="POST">
        @csrf
        <!-- Testimonials Grid -->
        <!-- Testimonials Grid -->
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
            @forelse($testimonials as $testimonial)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative flex flex-col overflow-hidden">
                    <!-- Bulk Checkbox & Status Block -->
                    <div class="p-4 border-b border-gray-100 flex items-center justify-between bg-gray-50">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="ids[]" value="{{ $testimonial->id }}"
                                class="w-4 h-4 rounded border-gray-300 text-orange-600 focus:ring-orange-600 cursor-pointer">
                            <div class="flex gap-1 text-yellow-400 text-xs shadow-sm bg-white px-2 py-1 rounded-md border border-gray-200">
                                @for($i = 0; $i < $testimonial->rating; $i++) <i class="fas fa-star text-orange-500"></i> @endfor
                                @for($i = $testimonial->rating; $i < 5; $i++) <i class="far fa-star text-gray-300"></i> @endfor
                            </div>
                        </div>

                        <div>
                            @if($testimonial->status)
                                <span class="inline-flex items-center gap-1.5 rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Published
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Hidden
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Testimonial Content -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm overflow-hidden shrink-0">
                                @if($testimonial->image)
                                    <img src="{{ $testimonial->image }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($testimonial->name, 0, 2) }}
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 leading-tight">{{ $testimonial->name }}</h4>
                                <p class="text-xs text-gray-500">{{ Str::limit($testimonial->position, 30) }}</p>
                            </div>
                        </div>

                        <p class="text-sm text-gray-600 italic leading-relaxed flex-1">
                            "{{ Str::limit($testimonial->content, 180) }}"
                        </p>
                    </div>
                    
                    <!-- Footer Actions -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs text-gray-400 font-medium">
                            <i class="far fa-calendar-alt mr-1"></i> {{ $testimonial->created_at->format('M d, Y') }}
                        </span>

                        <div class="flex gap-2">
                            <button type="button" onclick="editTestimonial({{ $testimonial->id }})"
                                class="p-2 text-gray-400 hover:text-blue-600 transition-colors rounded-lg hover:bg-blue-50" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="toggleStatus({{ $testimonial->id }})"
                                class="p-2 text-gray-400 hover:text-orange-600 transition-colors rounded-lg hover:bg-orange-50"
                                title="{{ $testimonial->status ? 'Hide' : 'Publish' }}">
                                <i class="fas {{ $testimonial->status ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-gray-500 w-full flex flex-col items-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 ring-1 ring-inset ring-gray-500/10 shadow-sm">
                        <i class="fas fa-comment-dots text-2xl text-gray-400"></i>
                    </div>
                    <p class="font-medium text-gray-900 mb-1">No testimonials found</p>
                    <p class="text-sm">Start gathering reviews to build your Wall of Love.</p>
                </div>
            @endforelse
        </div>
    </form>

    <div class="mt-8">
        {{ $testimonials->links() }}
    </div>
    </div>

    <!-- Add Testimonial Modal -->
    <div id="addTestimonialModal"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl border border-gray-100 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-star text-orange-500"></i>
                        Add New Testimonial
                    </h2>
                    <button type="button" onclick="closeAddTestimonialModal()"
                        class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1.5">Student Name</label>
                            <input type="text" name="name" required
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1.5">Role / Position</label>
                            <input type="text" name="position" placeholder="e.g. Full-Stack Developer" required
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Image URL (Optional)</label>
                        <input type="url" name="image" placeholder="https://example.com/photo.jpg"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white">
                        <p class="text-xs text-gray-500 mt-1">Leave blank to use an auto-generated avatar.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Rating</label>
                        <select name="rating"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white cursor-pointer">
                            <option value="5">⭐⭐⭐⭐⭐ (5 Stars)</option>
                            <option value="4">⭐⭐⭐⭐ (4 Stars)</option>
                            <option value="3">⭐⭐⭐ (3 Stars)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1.5">Testimonial Content</label>
                        <textarea name="content" rows="4" required placeholder="Write the student's review here..."
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 bg-white"></textarea>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="closeAddTestimonialModal()"
                        class="px-4 py-2 bg-white text-sm font-semibold text-gray-900 rounded-lg border border-gray-300 shadow-sm hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-orange-600 text-sm font-semibold text-white shadow-sm rounded-lg hover:bg-orange-700 transition-colors">
                        Save Testimonial
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal (Simplified: Redirects to edit page if implemented, or we would need JS to populate) 
                                                                 Since user mock had openAdd, we assumed modal. Edit might be separate page or modal.
                                                                 Current controller has 'edit' method returning view 'admin.testimonials.edit'.
                                                                 So I'll just redirect to that page in the JS function.
                                                            -->

    <script>
        function openAddTestimonialModal() {
            document.getElementById('addTestimonialModal').classList.remove('hidden');
        }

        function closeAddTestimonialModal() {
            document.getElementById('addTestimonialModal').classList.add('hidden');
        }

        function editTestimonial(id) {
            window.location.href = '/admin/testimonials/' + id + '/edit';
        }

        function toggleStatus(id) {
            if (!confirm('Change status of this testimonial?')) return;
            fetch('/admin/testimonials/' + id + '/toggle-status', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) location.reload();
                });
        }

        function submitBulk(url) {
            const checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
            if (checkboxes.length === 0) {
                alert('Please select at least one record.');
                return;
            }
            if (!confirm('Apply action to ' + checkboxes.length + ' items?')) return;

            const form = document.getElementById('bulkForm');
            form.action = url;
            form.submit();
        }
    </script>
@endsection