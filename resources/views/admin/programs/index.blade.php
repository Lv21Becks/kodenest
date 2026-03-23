@extends('layouts.admin')

@section('title', 'Programs Management')

@section('content')
<div class="space-y-6">
    {{-- Quick Actions --}}
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Master Catalog</h2>
        <div class="flex gap-3">
            <button onclick="openAddProgramModal()" class="bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-orange-500 shadow-sm transition-all">
                <i class="fas fa-plus mr-2"></i> Create Program
            </button>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1">Total Programs</p>
            <p class="text-3xl font-black text-gray-900 mt-1">{{ $stats['total_programs'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1">Active Enrollments</p>
            <p class="text-3xl font-black text-blue-600 mt-1">{{ $stats['total_enrollments'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1">Total Revenue</p>
            <p class="text-3xl font-black text-green-600 mt-1">₦{{ number_format($stats['total_revenue']) }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1">Avg Rating</p>
            <p class="text-3xl font-black text-orange-500 mt-1">{{ $stats['avg_rating'] }} <i class="fas fa-star text-xl"></i></p>
        </div>
    </div>

    {{-- Search & Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/30 flex flex-col md:flex-row gap-4 items-center justify-between">
            <form action="{{ route('admin.programs.index') }}" method="GET" class="w-full md:w-96 relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..." 
                    class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
            </form>
            <div class="flex items-center gap-4 text-xs font-bold text-gray-400">
                <span class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-green-500"></div> Active</span>
                <span class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-gray-300"></div> Draft</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Duration</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Price</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Enrolled</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($programs as $program)
                    <tr class="even:bg-gray-50/50 hover:bg-orange-50/30 transition-colors group">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                @if($program->image_icon)
                                    <img src="{{ asset('storage/' . $program->image_icon) }}" class="w-10 h-10 rounded-lg object-cover shadow-sm">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center text-sm shadow-sm">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-bold text-gray-900 group-hover:text-orange-600 transition-colors">{{ $program->title }}</p>
                                <p class="text-xs text-gray-400 font-semibold uppercase tracking-wide">{{ Str::limit($program->slug, 20) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="px-2 py-1 rounded bg-gray-100 text-gray-600 text-xs font-bold uppercase">{{ $program->duration }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <p class="text-sm font-bold text-gray-900">₦{{ number_format($program->price) }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-bold text-gray-900">{{ $program->student_count }}</span>
                                <div class="w-12 h-1 bg-gray-100 rounded-full mt-1 overflow-hidden">
                                    <div class="h-full bg-orange-500" style="width: {{ min($program->student_count * 10, 100) }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center">
                                <button onclick="toggleStatus({{ $program->id }})" 
                                    class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors {{ $program->status ? 'bg-green-500' : 'bg-gray-200' }}">
                                    <span class="inline-block h-3.5 w-3.5 transform rounded-full bg-white transition-transform {{ $program->status ? 'translate-x-4' : 'translate-x-1' }}"></span>
                                </button>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2 text-gray-400">
                                <a href="{{ route('admin.programs.edit', $program) }}" class="p-2 hover:bg-orange-100 hover:text-orange-600 rounded-lg transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {{-- Navigation to the new Detail Page --}}
                                <a href="{{ route('admin.programs.show', $program) }}" class="p-2 hover:bg-blue-100 hover:text-blue-600 rounded-lg transition-colors" title="Program Details">
                                    <i class="fas fa-chart-line"></i>
                                </a>
                                <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="inline" onsubmit="return confirm('Delete this program?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 hover:bg-red-100 hover:text-red-500 rounded-lg transition-colors"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-gray-400 italic">No programs found matching your filters.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Program Modal (Simplified for now, using existing form structure) --}}
<div id="addProgramModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gray-900 px-6 py-4 flex justify-between items-center">
                <h3 class="text-white font-bold">New Educational Program</h3>
                <button onclick="closeAddProgramModal()" class="text-gray-400 hover:text-white"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="p-8 grid grid-cols-2 gap-6">
                @csrf
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Program Title</label>
                    <input type="text" name="title" required class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Duration (e.g. 6 Months)</label>
                    <input type="text" name="duration" required class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Price (₦)</label>
                    <input type="number" name="price" required class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                </div>
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Description</label>
                    <textarea name="description" rows="3" required class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-orange-500 outline-none"></textarea>
                </div>
                <div class="col-span-2">
                    <button type="submit" class="w-full bg-orange-600 text-white font-bold py-3 rounded-xl hover:bg-orange-500 transition-all">Launch Program</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openAddProgramModal() { document.getElementById('addProgramModal').classList.remove('hidden'); }
    function closeAddProgramModal() { document.getElementById('addProgramModal').classList.add('hidden'); }

    function toggleStatus(id) {
        fetch(`/admin/programs/${id}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(res => res.json()).then(data => {
            if (data.success) location.reload();
        });
    }
</script>
@endsection