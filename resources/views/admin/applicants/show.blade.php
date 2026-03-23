@extends('layouts.admin')

@section('title', 'Applicant Profile - ' . $applicant->first_name)

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.applicants.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-orange-600 hover:border-orange-100 transition-all shadow-sm">
                <i class="fas fa-chevron-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $applicant->first_name }} {{ $applicant->last_name }}</h1>
                <p class="text-sm text-gray-500">Applicant ID: #{{ $applicant->id }} · Joined {{ $applicant->created_at->format('M d, Y') }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $applicant->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $applicant->status }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column: Basic Info & Stats --}}
        <div class="space-y-6">
            {{-- Contact Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-900 mb-4 border-b border-gray-50 pb-2">Contact Information</h3>
                <div class="space-y-4 text-sm">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-envelope text-gray-400 w-5 pt-0.5"></i>
                        <div>
                            <p class="font-medium text-gray-900">{{ $applicant->email }}</p>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-tight">Email Address</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-phone text-gray-400 w-5 pt-0.5"></i>
                        <div>
                            <p class="font-medium text-gray-900">{{ $applicant->phone ?? 'Not provided' }}</p>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-tight">Phone Number</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-gray-400 w-5 pt-0.5"></i>
                        <div>
                            <p class="font-medium text-gray-900">{{ $applicant->address ?? 'No address' }}</p>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-tight">Address / Location</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 text-center">
                    <p class="text-2xl font-bold text-gray-900">{{ $applicant->applications->count() }}</p>
                    <p class="text-[10px] text-gray-400 uppercase font-bold">Applications</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 text-center">
                    <p class="text-2xl font-bold text-gray-900">{{ $applicant->applications->where('status', 'approved')->count() }}</p>
                    <p class="text-[10px] text-green-500 uppercase font-bold">Approved</p>
                </div>
            </div>
        </div>

        {{-- Right Column: History & Notes --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Application History --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/30">
                    <h3 class="text-sm font-bold text-gray-900 tracking-tight">📂 Application History</h3>
                    <a href="{{ route('admin.applications.index', ['search' => $applicant->email]) }}" class="text-xs font-bold text-orange-600 hover:underline">View All Decisions</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse($applicant->applications as $app)
                    <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $app->program->title ?? $app->program_id }}</p>
                                <p class="text-xs text-gray-400 uppercase font-semibold">Applied on {{ $app->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                {{ $app->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ($app->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                {{ $app->status }}
                            </span>
                            <a href="{{ route('admin.applications.index', ['status' => $app->status]) }}" class="text-gray-300 hover:text-orange-600">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-12 text-center text-gray-400">
                        <i class="fas fa-archive text-3xl mb-3 text-gray-100"></i>
                        <p class="text-sm">No application history found.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Admin Notes --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-900 mb-4 tracking-tight border-b border-gray-50 pb-2">📝 Admin Notes</h3>
                <p class="text-sm text-gray-600 leading-relaxed italic">
                    {{ $applicant->notes ?? 'No internal notes found for this applicant.' }}
                </p>
                <div class="mt-6">
                    <button class="text-xs font-bold text-orange-600 px-3 py-1.5 rounded-lg border border-orange-100 hover:bg-orange-50 transition-all">
                        <i class="fas fa-edit mr-1"></i> Edit Internal Notes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
