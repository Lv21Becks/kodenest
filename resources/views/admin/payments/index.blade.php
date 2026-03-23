@extends('layouts.admin')

@section('title', 'Financial Ledger — Payments')

@section('content')
<div class="space-y-6">
    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full group-hover:scale-110 transition-transform"></div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1 relative z-10">Total Verified Revenue</p>
            <p class="text-3xl font-black text-gray-900 mt-1 relative z-10">₦{{ number_format($stats['total_received']) }}</p>
            <p class="text-[10px] font-bold text-green-500 mt-2 relative z-10"><i class="fas fa-check-circle"></i> Funds in Bank</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-orange-50 rounded-full group-hover:scale-110 transition-transform"></div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1 relative z-10">Pending Verifications</p>
            <p class="text-3xl font-black text-orange-600 mt-1 relative z-10">{{ number_format($stats['pending_approval']) }}</p>
            <p class="text-[10px] font-bold text-orange-400 mt-2 relative z-10"><i class="fas fa-clock"></i> Requires Manual Review</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm relative overflow-hidden group border-l-4 border-l-red-500">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-red-50 rounded-full group-hover:scale-110 transition-transform"></div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1 relative z-10">Total Outstanding Debt</p>
            <p class="text-3xl font-black text-red-600 mt-1 relative z-10">₦{{ number_format($stats['outstanding']) }}</p>
            <p class="text-[10px] font-bold text-red-400 mt-2 relative z-10"><i class="fas fa-exclamation-triangle"></i> Unpaid & Partial Invoices</p>
        </div>
    </div>

    {{-- Search & Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden text-sm">
        <div class="p-6 border-b border-gray-100 bg-gray-50/30 flex flex-col md:flex-row gap-4 items-center justify-between">
            <form id="searchForm" action="{{ route('admin.payments.index') }}" method="GET" class="w-full md:w-96">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        oninput="debounceSubmit()"
                        placeholder="Search ID, Name or Reference..." 
                        class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50">
                    <i class="fas fa-search absolute left-3.5 top-3 text-gray-400"></i>
                </div>
            </form>
            <div class="flex items-center gap-4">
                <select name="status" onchange="window.location.href='{{ route('admin.payments.index') }}?status=' + this.value" class="px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold text-gray-600 outline-none focus:ring-2 focus:ring-orange-500 cursor-pointer">
                    <option value="">All Transactions</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider">ID / Reference</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Amount</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Date</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($payments as $payment)
                    <tr class="even:bg-gray-50/50 hover:bg-orange-50/30 transition-colors group">
                        <td class="px-6 py-5">
                            <p class="text-xs font-bold text-gray-900">#TRX-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase truncate w-24 italic" title="{{ $payment->reference }}">{{ $payment->reference ?: 'NO REFERENCE' }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-[10px]">
                                    {{ substr($payment->student->first_name ?? '?', 0, 1) }}{{ substr($payment->student->last_name ?? '?', 0, 1) }}
                                </div>
                                <p class="text-xs font-bold text-gray-900">{{ $payment->student->first_name ?? 'Unknown' }} {{ $payment->student->last_name ?? '' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <p class="text-sm font-bold text-gray-900 italic underline decoration-blue-500/30">₦{{ number_format($payment->amount) }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-center">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase 
                                    {{ $payment->status === 'verified' ? 'bg-green-100 text-green-700' : ($payment->status === 'pending' ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $payment->status }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <p class="text-[10px] font-bold text-gray-400 uppercase">{{ $payment->created_at->format('M d, Y') }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-3 text-gray-400">
                                @if($payment->status === 'pending')
                                <form action="{{ route('admin.payments.verify', $payment) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="hover:text-green-600 transition-colors" title="Quick Verify"><i class="fas fa-check-double"></i></button>
                                </form>
                                @endif
                                <a href="{{ route('admin.payments.show', $payment) }}" class="hover:text-blue-600 transition-colors" title="View Details"><i class="fas fa-eye"></i></a>
                                @if($payment->status !== 'verified')
                                <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Delete this transaction?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="hover:text-red-500 transition-colors"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-gray-400 italic">No transaction records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-50 bg-gray-50/20">
            {{ $payments->links() }}
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
