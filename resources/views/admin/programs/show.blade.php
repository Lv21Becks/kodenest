@extends('layouts.admin')

@section('title', 'Program Detail — ' . $program->title)

@section('content')
<div class="space-y-8">
    {{-- Header / Breadcrumbs --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3 text-sm font-medium text-gray-500">
            <a href="{{ route('admin.programs.index') }}" class="hover:text-orange-600 transition-colors">Programs</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-gray-900">{{ $program->title }}</span>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.programs.edit', $program) }}" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-gray-50 transition-all">
                <i class="fas fa-edit mr-2"></i> Edit Program
            </a>
        </div>
    </div>

    {{-- ZONE A: Basic Info & Stats --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50/50 rounded-bl-full -mr-16 -mt-16"></div>
                
                <div class="relative flex items-start gap-6">
                    @if($program->image_icon)
                        <img src="{{ asset('storage/' . $program->image_icon) }}" class="w-20 h-20 rounded-2xl object-cover shadow-sm ring-4 ring-white">
                    @else
                        <div class="w-20 h-20 rounded-2xl bg-orange-600 text-white flex items-center justify-center text-3xl shadow-sm ring-4 ring-white">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                    @endif
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $program->title }}</h1>
                        <p class="text-gray-500 mt-2 leading-relaxed">{{ $program->description }}</p>
                        
                        <div class="flex flex-wrap gap-4 mt-6">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-50 border border-gray-100 text-sm font-bold text-gray-700">
                                <i class="fas fa-clock text-orange-500 text-xs"></i> {{ $program->duration }}
                            </span>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ZONE B: Applications --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 italic underline decoration-orange-500 decoration-2">Applications</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Pipeline interest for this program</p>
                    </div>
                    <span class="px-2 py-1 rounded bg-orange-100 text-orange-600 text-[10px] font-bold uppercase">{{ $applications->count() }} Submissions</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/30">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Applicant</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Date</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($applications as $app)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-xs uppercase">
                                            {{ substr($app->applicant->first_name ?? '?', 0, 1) }}{{ substr($app->applicant->last_name ?? '?', 0, 1) }}
                                        </div>
                                        <p class="text-xs font-bold text-gray-900">{{ $app->applicant->first_name ?? 'Unknown' }} {{ $app->applicant->last_name ?? 'Applicant' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase 
                                        {{ $app->status === 'approved' ? 'bg-green-100 text-green-700' : ($app->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-orange-100 text-orange-700') }}">
                                        {{ $app->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase">{{ $app->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.applications.index') }}" class="text-orange-600 hover:underline text-[10px] font-bold uppercase tracking-widest">Manage →</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400 italic text-sm text-opacity-70">No applications recorded yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ZONE C: Enrollments & Lifecycle --}}
        <div class="space-y-8">
            <div class="bg-gray-900 p-8 rounded-2xl shadow-xl text-white relative flex flex-col items-center text-center overflow-hidden">
                <div class="absolute -top-10 -left-10 w-32 h-32 bg-orange-500/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl"></div>
                
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-6 italic underline decoration-blue-500 decoration-2">Active Students</h3>
                <p class="text-5xl font-black text-white mb-2">{{ $enrollments->count() }}</p>
                <p class="text-[10px] font-bold text-blue-400 uppercase tracking-[0.2em]">Currently Enrolled</p>
                
                <div class="w-full h-px bg-gray-800 my-8"></div>
                
                <div class="w-full space-y-4">
                    @forelse($enrollments->take(5) as $enrollment)
                    <div class="flex items-center justify-between text-left">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-graduation-cap text-orange-500 text-xs"></i>
                            <p class="text-xs font-bold text-gray-300 truncate w-32">{{ $enrollment->student->first_name ?? 'Student' }} {{ $enrollment->student->last_name ?? '' }}</p>
                        </div>
                        <span class="text-[10px] font-black text-gray-600 uppercase">{{ $enrollment->created_at->format('M y') }}</span>
                    </div>
                    @empty
                    <p class="text-xs text-gray-500 italic">No active enrollments</p>
                    @endforelse
                </div>

                @if($enrollments->count() > 5)
                <button class="mt-8 text-[10px] font-black text-orange-500 uppercase tracking-widest hover:text-orange-400 transition-colors">View All Students →</button>
                @endif
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm border-l-4 border-l-red-500">
                <h4 class="text-xs font-bold text-gray-900 uppercase tracking-widest mb-2 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle text-red-500"></i> Governance
                </h4>
                <p class="text-[10px] text-gray-500 leading-relaxed font-semibold">
                    Programs with active students or pending applications cannot be deleted. You must deactivate them instead to preserve historical records.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
