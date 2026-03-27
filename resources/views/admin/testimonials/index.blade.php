@extends('layouts.admin')

@section('title', 'Testimonials — Wall of Love')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Wall of Love</h2>
        <p class="text-sm text-gray-500 mt-1">Manage student reviews and testimonials displayed on the landing page.</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 rounded-lg shadow-sm transition-colors focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
        <i class="fas fa-plus"></i> Add Testimonial
    </a>
</div>

{{-- Stats Row --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600"><i class="fas fa-comments"></i></div>
        <div><p class="text-xs text-gray-500 font-medium">Total</p><p class="text-xl font-bold text-gray-900">{{ $stats['total'] }}</p></div>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center text-green-600"><i class="fas fa-check-circle"></i></div>
        <div><p class="text-xs text-gray-500 font-medium">Approved</p><p class="text-xl font-bold text-green-700">{{ $stats['approved'] }}</p></div>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600"><i class="fas fa-clock"></i></div>
        <div><p class="text-xs text-gray-500 font-medium">Pending</p><p class="text-xl font-bold text-amber-700">{{ $stats['pending'] }}</p></div>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600"><i class="fas fa-star"></i></div>
        <div><p class="text-xs text-gray-500 font-medium">Avg. Rating</p><p class="text-xl font-bold text-orange-700">{{ $stats['avg_rating'] }}/5</p></div>
    </div>
</div>

{{-- Filters --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4 mb-4">
    <form method="GET" action="{{ route('admin.testimonials.index') }}" class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1 relative">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, role, or content..."
                class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow">
        </div>
        <select name="status" class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow">
            <option value="">All Statuses</option>
            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        </select>
        <select name="rating" class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:border-orange-500 focus:ring focus:ring-orange-200 transition-shadow">
            <option value="">All Ratings</option>
            @for($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
            @endfor
        </select>
        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-gray-800 hover:bg-gray-900 rounded-lg transition-colors">Filter</button>
        @if(request()->anyFilled(['search','status','rating']))
            <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition-colors text-center">Clear</a>
        @endif
    </form>
</div>

{{-- Cards Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @forelse($testimonials as $testimonial)
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden flex flex-col group">
        {{-- Card Header --}}
        <div class="px-5 pt-5 pb-4 flex items-start gap-4">
            <div class="flex-shrink-0">
                @if($testimonial->image)
                    <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->name }}"
                        class="w-12 h-12 rounded-full object-cover ring-2 ring-gray-100">
                @else
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-lg ring-2 ring-orange-100">
                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <p class="font-bold text-gray-900 text-sm truncate">{{ $testimonial->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $testimonial->position }}</p>
                    </div>
                    @if($testimonial->featured)
                        <span class="flex-shrink-0 text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 px-2 py-0.5 rounded-full inline-flex items-center gap-1">
                            <i class="fas fa-star text-[10px]"></i> Featured
                        </span>
                    @endif
                </div>
                {{-- Stars --}}
                <div class="flex items-center gap-0.5 mt-1.5">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star text-xs {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-gray-200' }}"></i>
                    @endfor
                </div>
            </div>
        </div>

        {{-- Quote --}}
        <div class="px-5 pb-4 flex-1">
            <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                "{{ $testimonial->content }}"
            </p>
        </div>

        {{-- Footer --}}
        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
            {{-- Status Toggle --}}
            <button onclick="toggleStatus({{ $testimonial->id }}, this)"
                data-id="{{ $testimonial->id }}"
                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold transition-colors
                    {{ $testimonial->status ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-100 text-gray-500 border border-gray-200' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $testimonial->status ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                {{ $testimonial->status ? 'Approved' : 'Pending' }}
            </button>
            {{-- Actions --}}
            <div class="flex items-center gap-1">
                <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                    class="p-2 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors" title="Edit">
                    <i class="fas fa-edit text-sm"></i>
                </a>
                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                    onsubmit="return confirm('Delete this testimonial permanently?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 bg-white rounded-xl border border-gray-100 shadow-sm py-16 text-center">
        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 ring-1 ring-inset ring-gray-200">
            <i class="fas fa-comments text-gray-400 text-2xl"></i>
        </div>
        <h3 class="text-base font-bold text-gray-900 mb-1">No testimonials yet</h3>
        <p class="text-sm text-gray-500 mb-4">Add the first testimonial to show on the landing page.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 rounded-lg transition-colors">
            <i class="fas fa-plus"></i> Add First Testimonial
        </a>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($testimonials->hasPages())
<div class="mt-6">{{ $testimonials->links() }}</div>
@endif

@push('scripts')
<script>
function toggleStatus(id, btn) {
    fetch(`/admin/testimonials/${id}/toggle-status`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Content-Type': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        const dot = btn.querySelector('span.rounded-full');
        if (data.status) {
            btn.className = btn.className.replace('bg-gray-100 text-gray-500 border-gray-200', 'bg-green-50 text-green-700 border-green-200');
            dot.className = dot.className.replace('bg-gray-400', 'bg-green-500');
            btn.lastChild.textContent = ' Approved';
        } else {
            btn.className = btn.className.replace('bg-green-50 text-green-700 border-green-200', 'bg-gray-100 text-gray-500 border-gray-200');
            dot.className = dot.className.replace('bg-green-500', 'bg-gray-400');
            btn.lastChild.textContent = ' Pending';
        }
    });
}
</script>
@endpush
@endsection