@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Average Rating</p>
                <p class="text-3xl font-black text-gray-800">{{ $stats['avg_rating'] }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 text-xl">
                <i class="fas fa-trophy"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Total Reviews</p>
                <p class="text-3xl font-black text-gray-800">{{ $stats['total'] }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl">
                <i class="fas fa-comment-alt"></i>
            </div>
        </div>


    </div>

    <!-- Actions Toolbar -->
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 mb-8">
        <div class="flex flex-wrap gap-4 items-center justify-between">
            <div class="flex gap-3">
                <button onclick="openAddTestimonialModal()"
                    class="px-6 py-2.5 bg-gradient-to-r from-brand-purple to-brand-pink text-white font-bold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all flex items-center gap-2 text-sm">
                    <i class="fas fa-plus"></i>
                    Add New
                </button>

                <button type="button" onclick="submitBulk('{{ route('admin.testimonials.bulk-delete') }}')"
                    class="px-4 py-2.5 bg-red-50 text-red-700 font-bold rounded-xl hover:bg-red-100 transition-colors flex items-center gap-2 text-sm">
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </div>
            <form action="{{ route('admin.testimonials.index') }}" method="GET" class="flex gap-3">


                <div class="relative">
                    <select name="rating" onchange="this.form.submit()"
                        class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-brand-purple focus:outline-none text-sm text-gray-700 appearance-none pr-10 cursor-pointer">
                        <option value="">All Ratings</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <form id="bulkForm" method="POST">
        @csrf
        <!-- Testimonials Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($testimonials as $testimonial)
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all relative group">
                    <!-- Bulk Checkbox -->
                    <div class="absolute top-4 left-4 z-10">
                        <input type="checkbox" name="ids[]" value="{{ $testimonial->id }}"
                            class="w-5 h-5 rounded border-gray-300 bg-white/50 backdrop-blur">
                    </div>

                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4 z-10">
                        @if($testimonial->status)
                            <span
                                class="px-2 py-1 bg-green-100/90 backdrop-blur text-green-700 text-xs font-bold rounded-lg border border-green-200 shadow-sm">
                                <i class="fas fa-eye mr-1"></i> Visible
                            </span>
                        @else
                            <span
                                class="px-2 py-1 bg-gray-100/90 backdrop-blur text-gray-600 text-xs font-bold rounded-lg border border-gray-200 shadow-sm">
                                <i class="fas fa-eye-slash mr-1"></i> Hidden
                            </span>
                        @endif
                    </div>

                    <div class="bg-gradient-to-br from-brand-purple to-brand-pink p-6 text-white pt-12">
                        <!-- Added pt-12 for top elements space -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex gap-1 text-yellow-300">
                                @for($i = 0; $i < $testimonial->rating; $i++) <i class="fas fa-star"></i> @endfor
                                @for($i = $testimonial->rating; $i < 5; $i++) <i class="far fa-star"></i> @endfor
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-2xl font-bold overflow-hidden shrink-0">
                                @if($testimonial->image)
                                    <img src="{{ $testimonial->image }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($testimonial->name, 0, 2) }}
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-lg leading-tight">{{ $testimonial->name }}</h4>
                                <p class="text-sm opacity-90">{{ Str::limit($testimonial->position, 20) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <p class="text-gray-700 italic mb-4 leading-relaxed h-[100px] overflow-y-auto">
                            "{{ Str::limit($testimonial->content, 150) }}"
                        </p>

                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4 pb-4 border-b border-gray-200">
                            <div>
                                <i class="fas fa-calendar-alt mr-2"></i>{{ $testimonial->created_at->format('M d, Y') }}
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="button" onclick="toggleStatus({{ $testimonial->id }})"
                                class="px-4 py-2 {{ $testimonial->status ? 'bg-orange-50 text-orange-600 hover:bg-orange-100' : 'bg-green-50 text-green-600 hover:bg-green-100' }} rounded-lg transition-colors text-sm font-semibold"
                                title="{{ $testimonial->status ? 'Hide' : 'Publish' }}">
                                <i class="fas {{ $testimonial->status ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                            </button>

                            <button type="button" onclick="editTestimonial({{ $testimonial->id }})"
                                class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">
                    <i class="fas fa-star text-4xl mb-4 text-gray-300"></i>
                    <p>No testimonials found.</p>
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
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div
                    class="bg-gradient-to-r from-brand-purple to-brand-pink text-white px-8 py-6 flex items-center justify-between">
                    <h2 class="text-2xl font-black">Add New Testimonial</h2>
                    <button type="button" onclick="closeAddTestimonialModal()"
                        class="text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Student Name</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Role/Position</label>
                            <input type="text" name="position" placeholder="e.g. Data Analyst" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Image URL (Optional)</label>
                        <input type="text" name="image" placeholder="https://example.com/photo.jpg"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Rating</label>
                        <select name="rating"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                            <option value="5">⭐⭐⭐⭐⭐ (5 Stars)</option>
                            <option value="4">⭐⭐⭐⭐ (4 Stars)</option>
                            <option value="3">⭐⭐⭐ (3 Stars)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Testimonial Content</label>
                        <textarea name="content" rows="4" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none"></textarea>
                    </div>


                </div>

                <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="closeAddTestimonialModal()"
                        class="px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition-colors">Cancel</button>
                    <button type="submit"
                        class="px-6 py-3 bg-brand-purple text-white font-bold rounded-lg hover:bg-brand-pink transition-colors">Save
                        Testimonial</button>
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