@extends('layouts.admin')

@php
    $isAlumni = request()->routeIs('admin.alumni.index');
    $title = $isAlumni ? 'Alumni (Graduated)' : 'Student Enrollments';
@endphp

@section('title', $title)

@section('content')
<div class="space-y-6">
    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <a href="{{ route('admin.enrollments.index', ['status' => 'active']) }}" class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1">Active Students</p>
            <p class="text-2xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors">{{ number_format($stats['active']) }}</p>
        </a>
        <a href="{{ route('admin.alumni.index') }}" class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1">Alumni</p>
            <p class="text-2xl font-bold text-blue-600 group-hover:text-blue-500 transition-colors">{{ number_format($stats['completed']) }}</p>
        </a>
        <a href="{{ route('admin.enrollments.index', ['at_risk' => 1]) }}" class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
            <p class="text-[10px] font-bold text-red-400 uppercase tracking-tight mb-1 flex items-center gap-1">
                <i class="fas fa-exclamation-triangle"></i> At Risk
            </p>
            <p class="text-2xl font-bold text-red-600">{{ number_format($stats['at_risk']) }}</p>
        </a>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1">Total Records</p>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total']) }}</p>
        </div>
    </div>

    {{-- Search & Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/30 flex flex-col md:flex-row gap-4 items-center justify-between">
            <form id="searchForm" action="{{ URL::current() }}" method="GET" class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                {{-- Maintain existing filters --}}
                @if(request('at_risk')) <input type="hidden" name="at_risk" value="1"> @endif
                
                <div class="relative w-full md:w-96">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        oninput="debounceSubmit()"
                        placeholder="Search name or email..." 
                        class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50">
                    <i class="fas fa-search absolute left-3.5 top-3 text-gray-400"></i>
                </div>

                <select name="program" onchange="this.form.submit()" class="px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold text-gray-600 outline-none focus:ring-2 focus:ring-orange-500 cursor-pointer">
                    <option value="">All Programs</option>
                    @foreach($programs as $p)
                        <option value="{{ $p->slug }}" {{ request('program') == $p->slug ? 'selected' : '' }}>{{ $p->title }}</option>
                    @endforeach
                </select>

                @if(!$isAlumni)
                <select name="status" onchange="this.form.submit()" class="px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold text-gray-600 outline-none focus:ring-2 focus:ring-orange-500 cursor-pointer">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="dropped" {{ request('status') == 'dropped' ? 'selected' : '' }}>Dropped</option>
                </select>
                @endif

                @if(request()->anyFilled(['search', 'program', 'status', 'at_risk']))
                <a href="{{ URL::current() }}" class="text-red-500 text-xs font-bold hover:underline flex items-center px-2">Clear Filters</a>
                @endif
            </form>
            
            <div class="flex items-center gap-3">
                <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors"><i class="fas fa-file-export"></i></button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Student</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Program</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Start Date</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Progress</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($enrollments as $enrollment)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-xs">
                                    {{ substr($enrollment->student->first_name ?? '?', 0, 1) }}{{ substr($enrollment->student->last_name ?? '?', 0, 1) }}
                                </div>
                                <div>
                                    <a href="{{ route('admin.students.show', $enrollment->student_id) }}" class="text-sm font-bold text-gray-900 hover:text-orange-600 transition-colors">
                                        {{ $enrollment->student->first_name ?? 'Unknown' }} {{ $enrollment->student->last_name ?? '' }}
                                    </a>
                                    <p class="text-[10px] text-gray-400 font-semibold tracking-tight uppercase">{{ $enrollment->student->email ?? '' }}</p>
                                </div>
                                {{-- At Risk Indicator --}}
                                @if(\App\Models\Invoice::where('student_id', $enrollment->student_id)->whereIn('status', ['unpaid', 'partial'])->exists())
                                    <span class="ml-2 text-red-500" title="At Risk (Payment Overdue)"><i class="fas fa-exclamation-circle text-xs"></i></span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-700">{{ $enrollment->program->title ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-[10px] font-bold text-gray-400 uppercase">{{ $enrollment->enrollment_date?->format('M d, Y') ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase 
                                    {{ $enrollment->status === 'active' ? 'bg-green-100 text-green-700' : ($enrollment->status === 'completed' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                    {{ $enrollment->status }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col items-end">
                                <span class="text-[10px] font-bold text-gray-900 mb-1">{{ $enrollment->progress ?? 0 }}%</span>
                                <div class="w-20 h-1 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-orange-500" style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-gray-400 italic">No student records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-50">
            {{ $enrollments->links() }}
        </div>
    </div>
</div>

<script>
    let timeout = null;
    function debounceSubmit() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500);
    }
</script>
@endsection