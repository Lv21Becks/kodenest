@extends('layouts.admin')

@section('title', 'Admissions - Applicants')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Applicants</h1>
            <p class="text-sm text-gray-500">A complete database of people who have registered or applied.</p>
        </div>
    </div>

    {{-- Filters & Search --}}
    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
        <form id="searchForm" action="{{ route('admin.applicants.index') }}" method="GET" class="w-full md:w-96">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" 
                    oninput="debounceSubmit()"
                    placeholder="Search by name, email or phone..." 
                    class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50">
                <i class="fas fa-search absolute left-3.5 top-3 text-gray-400"></i>
            </div>
            @if(request()->anyFilled(['search']))
                <a href="{{ route('admin.applicants.index') }}" class="text-xs text-gray-500 hover:text-orange-600 underline mt-2 inline-block">Clear Filter</a>
            @endif
        </form>
    </div>

    {{-- Applicants Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Registrations</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-50">
                    @forelse($applicants as $applicant)
                    <tr class="even:bg-gray-50/50 hover:bg-orange-50/30 transition-colors">
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-sm">
                                    {{ substr($applicant->first_name, 0, 1) }}{{ substr($applicant->last_name, 0, 1) }}
                                </div>
                                <div>
                                    <a href="{{ route('admin.applicants.show', $applicant) }}" class="text-sm font-bold text-gray-900 hover:text-orange-600">
                                        {{ $applicant->first_name }} {{ $applicant->last_name }}
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-xs text-gray-900">{{ $applicant->email }}</div>
                            <div class="text-[10px] text-gray-400">{{ $applicant->phone }}</div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700">
                                {{ $applicant->applications_count }}
                            </span>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-xs text-gray-500">
                            {{ $applicant->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $applicant->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $applicant->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-right text-sm">
                            <a href="{{ route('admin.applicants.show', $applicant) }}" class="text-gray-400 hover:text-orange-600 transition-colors px-2" title="View Profile">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-users-slash text-4xl mb-3 text-gray-200"></i>
                            <p>No applicants found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($applicants->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $applicants->links() }}
        </div>
        @endif
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
