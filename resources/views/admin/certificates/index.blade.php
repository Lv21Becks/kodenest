@extends('layouts.admin')

@section('title', 'Academic Recognition — Certificates')

@section('content')
<div class="space-y-6">
    {{-- Quick Actions --}}
    <div class="flex items-center justify-between">
        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Digital Credentials</h2>
        <div class="flex gap-3">
            <button onclick="openIssueModal()" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-orange-600 shadow-sm transition-all">
                <i class="fas fa-certificate mr-2"></i> Issue Certificate
            </button>
        </div>
    </div>

    {{-- Stats Cards (Minimal) --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight mb-1">Total Issued</p>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($certificates->total()) }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm border-l-4 border-l-blue-500">
            <p class="text-[10px] font-bold text-blue-400 uppercase tracking-tight mb-1">Verified Unique</p>
            <p class="text-2xl font-bold text-blue-600">100%</p>
        </div>
    </div>

    {{-- Search & Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden text-sm">
        <div class="p-6 border-b border-gray-100 bg-gray-50/30 flex flex-col md:flex-row gap-4 items-center justify-between">
            <form id="searchForm" action="{{ route('admin.certificates.index') }}" method="GET" class="w-full md:w-96">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        oninput="debounceSubmit()"
                        placeholder="Search by name or code..." 
                        class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50">
                    <i class="fas fa-search absolute left-3.5 top-3 text-gray-400"></i>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Serial Number</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Student</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Program</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Issued Date</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($certificates as $cert)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-xs font-black text-blue-600 font-mono italic underline decoration-blue-100">{{ $cert->certificate_code }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-50 text-gray-600 flex items-center justify-center font-bold text-[10px]">
                                    {{ substr($cert->student->first_name ?? '?', 0, 1) }}{{ substr($cert->student->last_name ?? '?', 0, 1) }}
                                </div>
                                <p class="text-xs font-bold text-gray-900">{{ $cert->student->first_name ?? 'Unknown' }} {{ $cert->student->last_name ?? '' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-bold uppercase text-[10px] tracking-tight">
                            {{ Str::limit($cert->course->title ?? 'N/A', 30) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-[10px] font-bold text-gray-400 uppercase">{{ $cert->issued_at?->format('M d, Y') ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-3 text-gray-300">
                                <a href="{{ $cert->verification_url }}" target="_blank" class="hover:text-blue-600 transition-colors" title="Verify Link"><i class="fas fa-external-link-alt"></i></a>
                                <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST" onsubmit="return confirm('Revoke this certificate? This action is permanent.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="hover:text-red-500 transition-colors"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-gray-400 italic">No academic credentials have been issued yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-50 bg-gray-50/20">
            {{ $certificates->links() }}
        </div>
    </div>
</div>

{{-- Issue Certificate Modal (Placeholder for now) --}}
<div id="issueModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden p-8 text-center">
            <i class="fas fa-graduation-cap text-orange-500 text-4xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Issue New Academic Credential</h3>
            <p class="text-xs text-gray-500 mb-8 leading-relaxed">Select a student who has successfully completed their program requirements and cleared all financial obligations.</p>
            
            <form action="{{ route('admin.certificates.store') }}" method="POST" class="space-y-4 text-left">
                @csrf
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Student</label>
                    <select name="student_id" required class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                        <option value="">Select Student...</option>
                        {{-- In a real app, you'd pass students who are eligible --}}
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Issuance Date</label>
                    <input type="date" name="issued_at" value="{{ date('Y-m-d') }}" required class="w-full rounded-xl border border-gray-100 bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-orange-500 outline-none">
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="closeIssueModal()" class="flex-1 bg-gray-50 text-gray-600 font-bold py-3 rounded-xl hover:bg-gray-100 transition-all">Cancel</button>
                    <button type="submit" class="flex-1 bg-gray-900 text-white font-bold py-3 rounded-xl hover:bg-orange-600 transition-all shadow-lg">Issue Credential</button>
                </div>
            </form>
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

    function openIssueModal() { document.getElementById('issueModal').classList.remove('hidden'); }
    function closeIssueModal() { document.getElementById('issueModal').classList.add('hidden'); }
</script>
@endsection
