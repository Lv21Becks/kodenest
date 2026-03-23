@extends('layouts.admin')

@section('title', 'Applications')

@section('content')
<div class="space-y-6">
    {{-- Tabs Strategy --}}
    <div class="flex items-center justify-between border-b border-gray-100">
        <div class="flex gap-8">
            <a href="{{ route('admin.applications.index', ['status' => 'pending']) }}" 
               class="pb-4 text-sm font-bold transition-all border-b-2 {{ request('status', 'pending') === 'pending' ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-600' }}">
                Pending <span class="ml-2 px-2 py-0.5 rounded-full bg-orange-50 text-orange-600 text-[10px]">{{ $stats['pending'] }}</span>
            </a>
            <a href="{{ route('admin.applications.index', ['status' => 'approved']) }}" 
               class="pb-4 text-sm font-bold transition-all border-b-2 {{ request('status') === 'approved' ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-600' }}">
                Approved <span class="ml-2 px-2 py-0.5 rounded-full bg-green-50 text-green-600 text-[10px]">{{ $stats['approved'] }}</span>
            </a>
            <a href="{{ route('admin.applications.index', ['status' => 'rejected']) }}" 
               class="pb-4 text-sm font-bold transition-all border-b-2 {{ request('status') === 'rejected' ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-600' }}">
                Rejected <span class="ml-2 px-2 py-0.5 rounded-full bg-red-50 text-red-600 text-[10px]">{{ $stats['rejected'] }}</span>
            </a>
        </div>
    </div>

    {{-- Search & Bulk Actions --}}
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <form id="searchForm" action="{{ route('admin.applications.index') }}" method="GET" class="w-full md:w-96">
            <input type="hidden" name="status" value="{{ request('status', 'pending') }}">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" 
                    oninput="debounceSubmit()"
                    placeholder="Search applicants..." 
                    class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50">
                <i class="fas fa-search absolute left-3.5 top-3 text-gray-400"></i>
            </div>
        </form>

        @if(request('status', 'pending') === 'pending')
        <div class="flex gap-2">
            <button type="button" onclick="submitBulk('{{ route('admin.applications.bulk-approve') }}')" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-500 shadow-sm transition-all">
                <i class="fas fa-check-double mr-2"></i> Approve Selected
            </button>
        </div>
        @endif
    </div>

    {{-- Applications Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <form id="bulkForm" method="POST">
            @csrf
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-left w-10">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                        </th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Applicant</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Submitted</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($applications as $app)
                    <tr class="even:bg-gray-50/50 hover:bg-orange-50/30 transition-colors group">
                        <td class="px-6 py-5">
                            <input type="checkbox" name="ids[]" value="{{ $app->id }}" class="row-checkbox rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-700 text-xs font-bold">
                                    {{ substr($app->applicant->first_name, 0, 1) }}{{ substr($app->applicant->last_name, 0, 1) }}
                                </div>
                                <div>
                                    <a href="{{ route('admin.applicants.show', $app->applicant) }}" class="text-sm font-bold text-gray-900 hover:text-orange-600">
                                        {{ $app->applicant->first_name }} {{ $app->applicant->last_name }}
                                    </a>
                                    <p class="text-[10px] text-gray-400 tracking-tight">{{ $app->applicant->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-0.5 rounded bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wide">
                                {{ $programs->firstWhere('slug', $app->program_id)?->title ?? $app->program_id }}
                            </span>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-xs text-gray-500">
                            {{ $app->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'approved' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700'
                                ];
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $statusColors[$app->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $app->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-right">
                            <div class="flex items-center justify-end gap-3 text-gray-400">
                                @if($app->status === 'pending')
                                    <button type="button" onclick="confirmApprove('{{ route('admin.applications.approve', $app) }}')" class="hover:text-green-600 transition-colors" title="Approve">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    <button type="button" onclick="openRejectModal({{ $app->id }})" class="hover:text-red-500 transition-colors" title="Reject">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                @endif
                                <button type="button" 
                                        onclick="openDetailModal({{ json_encode(['id' => $app->id, 'name' => $app->applicant->first_name . ' ' . $app->applicant->last_name, 'program' => $programs->firstWhere('slug', $app->program_id)?->title ?? $app->program_id, 'date' => $app->created_at->format('M d, Y'), 'status' => $app->status, 'reason' => $app->rejection_reason, 'notes' => $app->notes]) }})" 
                                        class="hover:text-orange-600 transition-colors" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-gray-400 italic">
                            No applications found in this category.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </form>
    </div>

    @if($applications->hasPages())
    <div class="mt-4">
        {{ $applications->links() }}
    </div>
    @endif
</div>

{{-- Reject Reason Modal --}}
<div id="rejectModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Reject Application</h3>
            <p class="text-sm text-gray-500 mb-6">A mandatory rejection reason is required for tracking.</p>
            
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Rejection Reason</label>
                    <textarea name="rejection_reason" required rows="4" 
                        class="w-full rounded-xl border border-gray-200 p-4 text-sm focus:ring-2 focus:ring-orange-500 outline-none" 
                        placeholder="e.g. Incomplete documentation, prerequisite not met..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-red-600 text-white font-bold py-3 rounded-xl hover:bg-red-500 transition-all">Submit Rejection</button>
                    <button type="button" onclick="closeRejectModal()" class="px-6 py-2 text-sm font-bold text-gray-400 hover:text-gray-600">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Detail View Modal --}}
<div id="detailModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm">
    <div class="flex min-h-full items-center justify-center p-4 text-center">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl p-0 overflow-hidden text-left border border-gray-100">
            <div class="bg-gray-50 p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Application #<span id="det-id"></span></h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div class="p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Applicant Name</label>
                    <p class="text-base font-bold text-gray-900" id="det-name"></p>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Requested Program</label>
                        <p class="text-sm font-medium text-gray-800" id="det-program"></p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Submission Date</label>
                        <p class="text-sm font-medium text-gray-800" id="det-date"></p>
                    </div>
                </div>
                
                <div id="rejection-box" class="hidden animate-in fade-in zoom-in bg-red-50 p-4 rounded-xl border border-red-100">
                    <label class="block text-[10px] font-bold text-red-500 uppercase tracking-widest mb-1">Rejection Reason</label>
                    <p class="text-sm text-red-700 italic" id="det-reason"></p>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Application Notes</label>
                    <p class="text-sm text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-xl" id="det-notes"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmApprove(url) {
        if (!confirm('Are you sure you want to APPROVE this applicant?\n\nThis will automatically:\n1. CREATE a Student record.\n2. CREATE an Enrollment for this program.')) return;
        const f = document.createElement('form');
        f.method = 'POST'; f.action = url;
        const csrf = document.createElement('input');
        csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}';
        f.appendChild(csrf); document.body.appendChild(f); f.submit();
    }

    function openRejectModal(id) {
        const form = document.getElementById('rejectForm');
        form.action = `{{ url('admin/applications') }}/${id}/reject`;
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }

    function openDetailModal(data) {
        document.getElementById('det-id').textContent = data.id;
        document.getElementById('det-name').textContent = data.name;
        document.getElementById('det-program').textContent = data.program;
        document.getElementById('det-date').textContent = data.date;
        document.getElementById('det-notes').textContent = data.notes || 'No additional notes provided.';

        if (data.status === 'rejected' && data.reason) {
            document.getElementById('det-reason').textContent = data.reason;
            document.getElementById('rejection-box').classList.remove('hidden');
        } else {
            document.getElementById('rejection-box').classList.add('hidden');
        }

        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    // Select All functionality
    const selectAll = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');

    selectAll.addEventListener('change', () => {
        rowCheckboxes.forEach(cb => cb.checked = selectAll.checked);
        selectAll.indeterminate = false;
    });

    rowCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
            if (checkedCount === 0) {
                selectAll.checked = false;
                selectAll.indeterminate = false;
            } else if (checkedCount === rowCheckboxes.length) {
                selectAll.checked = true;
                selectAll.indeterminate = false;
            } else {
                selectAll.checked = false;
                selectAll.indeterminate = true;
            }
        });
    });

    function submitBulk(url) {
        const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
        if (checkedCount === 0) {
            alert('Please select at least one application.');
            return;
        }
        if (!confirm(`Are you sure you want to perform this action on ${checkedCount} applications?`)) return;
        const form = document.getElementById('bulkForm');
        form.action = url;
        form.submit();
    }
    
    let timeout = null;
    function debounceSubmit() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500);
    }
</script>
@endsection