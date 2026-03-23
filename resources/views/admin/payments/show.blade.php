@extends('layouts.admin')

@section('title', 'Transaction Detail — #TRX-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div class="space-y-8">
    {{-- Header & Breadcrumbs --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3 text-sm font-medium text-gray-500">
            <a href="{{ route('admin.payments.index') }}" class="hover:text-orange-600 transition-colors">Finance</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-gray-900">#TRX-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>
        <div class="flex gap-3">
            @if($payment->status === 'pending')
            <form action="{{ route('admin.payments.verify', $payment) }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-green-500 transition-all">
                    <i class="fas fa-check-double mr-2"></i> Verify Payment
                </button>
            </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Transaction Details --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-bl-full -mr-16 -mt-16"></div>
                
                <div class="relative flex items-center justify-between mb-8">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Transaction Status</p>
                        <span class="px-3 py-1 rounded-lg text-xs font-black uppercase tracking-widest 
                            {{ $payment->status === 'verified' ? 'bg-green-100 text-green-700 border border-green-200' : ($payment->status === 'pending' ? 'bg-orange-100 text-orange-700 border border-orange-200' : 'bg-red-100 text-red-700 border border-red-200') }}">
                            {{ $payment->status }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 italic">Student Profile</p>
                        <div class="flex items-center gap-4 border border-gray-50 p-4 rounded-xl bg-gray-50/30">
                            <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm shadow-sm ring-4 ring-white">
                                {{ substr($payment->student->first_name ?? '?', 0, 1) }}{{ substr($payment->student->last_name ?? '?', 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $payment->student->first_name ?? 'Unknown' }} {{ $payment->student->last_name ?? '' }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $payment->student->email ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 italic">Program Context</p>
                        <div class="flex items-center gap-4 border border-gray-50 p-4 rounded-xl bg-gray-50/30">
                            <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center text-lg shadow-sm ring-4 ring-white">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 line-clamp-1">{{ $payment->invoice->course->title ?? 'General Payment' }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase">Linked Invoice #INV-{{ str_pad($payment->invoice_id, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-12 pt-12 border-t border-gray-50 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Amount Transferred</p>
                        <p class="text-2xl font-black text-gray-900 font-mono tracking-tighter italic">₦{{ number_format($payment->amount) }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Payment Method</p>
                        <p class="text-sm font-bold text-gray-700 uppercase tracking-widest">{{ $payment->type ?: 'BANK TRANSFER' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Reference Code</p>
                        <p class="text-[11px] font-black text-blue-600 uppercase tracking-widest truncate" title="{{ $payment->reference }}">{{ $payment->reference ?: 'NO REFERENCE' }}</p>
                    </div>
                </div>
            </div>

            {{-- Invoice Breakdown --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 italic underline decoration-green-500 decoration-2">Reconciliation Ledger</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Linked Invoice #INV-{{ str_pad($payment->invoice_id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100 text-center">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Total Billable</p>
                            <p class="text-xl font-bold text-gray-900">₦{{ number_format($payment->invoice->total_amount) }}</p>
                        </div>
                        <div class="bg-green-50 p-6 rounded-xl border border-green-100 text-center">
                            <p class="text-[10px] font-bold text-green-600/60 uppercase tracking-widest mb-2">Amount Paid</p>
                            <p class="text-xl font-bold text-green-700">₦{{ number_format($payment->invoice->amount_paid) }}</p>
                        </div>
                        <div class="bg-red-50 p-6 rounded-xl border border-red-100 text-center border-l-4 border-l-red-500">
                            <p class="text-[10px] font-bold text-red-600/60 uppercase tracking-widest mb-2">Current Balance</p>
                            <p class="text-xl font-bold text-red-600">₦{{ number_format($payment->invoice->balance) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Verification Status & Logs --}}
        <div class="space-y-8">
            <div class="bg-gray-900 p-8 rounded-2xl shadow-xl text-white relative overflow-hidden">
                <div class="absolute -top-10 -left-10 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl"></div>
                <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-6 italic underline decoration-blue-500 decoration-2 text-center">Audit Trail</h3>
                
                <div class="space-y-6 relative z-10">
                    @if($payment->status === 'verified')
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-green-500/20 text-green-400 flex items-center justify-center shrink-0">
                            <i class="fas fa-check-circle text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-200">Payment Verified</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase mt-0.5">By: {{ $payment->verifiedBy->name ?? 'System' }}</p>
                            <p class="text-[10px] text-blue-400 font-bold uppercase mt-1">{{ $payment->paid_at?->format('F d, Y @ H:i') ?? 'N/A' }}</p>
                        </div>
                    </div>
                    @else
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-orange-500/20 text-orange-400 flex items-center justify-center shrink-0 animate-pulse">
                            <i class="fas fa-clock text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-200">Awaiting Verification</p>
                            <p class="text-[10px] text-gray-500 leading-relaxed mt-2 uppercase italic">A moderator must compare this proof with bank records to confirm receipt of funds.</p>
                        </div>
                    </div>
                    @endif

                    <div class="w-full h-px bg-gray-800 my-6"></div>

                    <div class="bg-gray-800/50 p-4 rounded-xl border border-gray-700">
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Admin Notes</p>
                        <p class="text-xs text-gray-300 italic leading-relaxed">{{ $payment->notes ?: 'No administrative notes recorded for this transaction.' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Quick Guidance</h4>
                <p class="text-xs text-gray-500 leading-relaxed font-semibold">
                    Verification is a one-way action. Once confirmed, the student's balance is automatically reduced, which may unlock access to course materials or certificates.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
