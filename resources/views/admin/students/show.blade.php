@extends('layouts.admin')

@section('title', 'Student Profile — ' . $student->first_name . ' ' . $student->last_name)

@section('content')
<div class="space-y-8">
    {{-- Breadcrumbs & Actions --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3 text-sm font-medium text-gray-500">
            <a href="{{ route('admin.enrollments.index') }}" class="hover:text-orange-600 transition-colors">Students</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</span>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.students.edit', $student) }}" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-gray-50 transition-all">
                <i class="fas fa-edit mr-2"></i> Edit Profile
            </a>
            <button class="bg-red-50 text-red-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-100 transition-all">
                Mark as Dropped
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Profile & Performance --}}
        <div class="lg:col-span-1 space-y-8">
            {{-- Profile Card --}}
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm text-center">
                <div class="w-24 h-24 rounded-full bg-orange-600 text-white flex items-center justify-center text-3xl font-black mx-auto mb-4 shadow-xl ring-4 ring-orange-50">
                    {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                </div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</h1>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1 italic underline decoration-orange-500 decoration-2">Student</p>
                
                <div class="mt-8 space-y-4 text-left border-t border-gray-50 pt-8">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-envelope text-gray-400 w-5 text-center"></i>
                        <span class="text-sm font-bold text-gray-600 truncate">{{ $student->email }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-phone text-gray-400 w-5 text-center"></i>
                        <span class="text-sm font-bold text-gray-600">{{ $student->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-map-marker-alt text-gray-400 w-5 text-center"></i>
                        <span class="text-sm font-bold text-gray-600 leading-relaxed">{{ $student->address ?? 'No address provided' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-calendar-alt text-gray-400 w-5 text-center"></i>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Joined {{ $student->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- Performance & Risk --}}
            <div class="bg-gray-900 p-8 rounded-2xl shadow-xl text-white relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-orange-500/10 rounded-full blur-2xl"></div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Performance Matrix</h3>
                
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Risk Level</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-tighter {{ $riskLevel === 'high' ? 'bg-red-500/20 text-red-400' : 'bg-green-500/20 text-green-400' }}">
                                {{ $riskLevel }}
                            </span>
                        </div>
                        <div class="w-full h-1.5 bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full {{ $riskLevel === 'high' ? 'bg-red-500' : 'bg-green-500' }}" style="width: {{ $riskLevel === 'high' ? '85%' : '20%' }}"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-t border-gray-800 pt-6">
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Attendance</p>
                            <p class="text-xl font-black italic">-- <span class="text-xs text-gray-600">%</span></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Completed</p>
                            <p class="text-xl font-black italic">{{ $enrollments->where('status', 'completed')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Program Info & Payments --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Program Info --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-sm font-bold text-gray-900 italic underline decoration-orange-500 decoration-2">Academic Lifecycle</h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Enrollment records and progress</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/30">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Program</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Start Date</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($enrollments as $enrollment)
                            <tr class="group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <i class="fas fa-laptop-code text-orange-500 text-xs"></i>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">{{ $enrollment->program->title ?? 'N/A' }}</p>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $enrollment->progress ?? 0 }}% Progress</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $enrollment->enrollment_date?->format('M d, Y') ?? 'N/A' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase 
                                            {{ $enrollment->status === 'active' ? 'bg-green-100 text-green-700' : ($enrollment->status === 'completed' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                            {{ $enrollment->status }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($enrollment->status === 'active')
                                    <button class="bg-black text-white px-3 py-1 rounded text-[10px] font-black uppercase tracking-widest hover:bg-orange-600 transition-colors">Graduated</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400 italic text-sm">No active enrollments</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Payments --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 italic underline decoration-green-500 decoration-2">Financial Standing</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Invoice history and balances</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-black text-gray-900">₦{{ number_format($outstandingBalance) }}</p>
                        <p class="text-[10px] font-bold text-red-500 uppercase tracking-widest mt-0.5">Outstanding Balance</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/30">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Invoice</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Amount</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($invoices as $invoice)
                            <tr>
                                <td class="px-6 py-4">
                                    <p class="text-xs font-bold text-gray-900">#INV-{{ str_pad($invoice->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p class="text-xs font-bold text-gray-900">₦{{ number_format($invoice->total_amount) }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase 
                                            {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $invoice->status }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $invoice->created_at->format('M d, Y') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400 italic text-sm text-opacity-70">No invoice history found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
