@extends('layouts.admin')

@section('title', 'Enrollments')

@section('content')

    <div class="p-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-clock"></i>
                    </div>
                    <span class="text-xs font-bold text-orange-500 bg-orange-50 px-2 py-1 rounded-full">New</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Pending</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['pending'] }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">Active</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Approved</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['approved'] }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <span class="text-xs font-bold text-blue-500 bg-blue-50 px-2 py-1 rounded-full">Due</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Payment Due</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['payment_due'] }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <span class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded-full">Rejected</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Rejected</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['rejected'] }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-list"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-500 bg-gray-50 px-2 py-1 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-500 text-sm font-medium">Total</h3>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total'] }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-wrap gap-4 items-center justify-between">
                <div class="flex gap-3">
                    <button type="button" onclick="submitBulk('{{ route('admin.enrollments.bulk-approve') }}')"
                        class="px-6 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                        <i class="fas fa-check-double"></i>
                        Approve Selected
                    </button>
                    <button type="button" onclick="submitBulk('{{ route('admin.enrollments.bulk-reject') }}')"
                        class="px-6 py-3 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2">
                        <i class="fas fa-times"></i>
                        Reject Selected
                    </button>
                </div>
            </div>
        </div>

        <!-- Urgent Alert -->
        @if($stats['pending'] > 0)
            <div class="bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl p-6 mb-8 shadow-xl animate-pulse">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold mb-1">{{ $stats['pending'] }} Enrollment Requests Awaiting Approval</h3>
                        <p class="text-sm opacity-90">Review and approve these requests to keep the enrollment pipeline flowing.
                        </p>
                    </div>
                    <button onclick="scrollToPending()"
                        class="px-6 py-3 bg-white text-red-600 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                        Review Now
                    </button>
                </div>
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <form action="{{ route('admin.enrollments.index') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name, email, or phone..."
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                </div>
                <select name="program" onchange="this.form.submit()"
                    class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    <option value="">All Programs</option>
                    @foreach($programs as $prog)
                        <option value="{{ $prog->slug }}" {{ request('program') == $prog->slug ? 'selected' : '' }}>
                            {{ $prog->title }}
                        </option>
                    @endforeach
                </select>
                <select name="status" onchange="this.form.submit()"
                    class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Approved (Active)</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="payment_due" {{ request('status') == 'payment_due' ? 'selected' : '' }}>Payment Due
                    </option>
                </select>
            </form>
        </div>

        <!-- Enrollments Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" id="pendingSection">
            <div
                class="px-6 py-4 bg-gradient-to-r from-brand-purple to-brand-pink text-white flex justify-between items-center">
                <h3 class="text-lg font-bold">Enrollments List</h3>
                <span class="bg-white/20 px-2 py-1 rounded text-xs">{{ $enrollments->total() }} total</span>
            </div>

            <div class="overflow-x-auto">
                <form id="bulkForm" method="POST">
                    @csrf
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left">
                                    <input type="checkbox" onchange="toggleAll(this)"
                                        class="w-4 h-4 rounded border-gray-300">
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Applicant</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Program</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Mode</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Applied</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Payment</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($enrollments as $student)
                                <tr
                                    class="hover:bg-gray-50 transition-colors {{ $student->status == 'pending' ? 'bg-yellow-50 border-l-4 border-yellow-400' : '' }}">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" name="ids[]" value="{{ $student->id }}"
                                            class="w-4 h-4 rounded border-gray-300">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <div class="font-semibold text-gray-800">{{ $student->first_name }}
                                                {{ $student->last_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $student->email }}</div>
                                            <div class="text-sm text-gray-500">{{ $student->phone }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">{{ Str::limit($student->program, 15) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($student->learning_mode) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div>{{ $student->created_at->diffForHumans() }}</div>
                                        <div class="text-xs text-gray-400">{{ $student->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($student->status == 'pending')
                                            <span
                                                class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full animate-pulse">Pending</span>
                                        @elseif($student->status == 'active')
                                            <span
                                                class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Approved</span>
                                        @elseif($student->status == 'rejected')
                                            <span
                                                class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Rejected</span>
                                        @else
                                            <span
                                                class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">{{ $student->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($student->payment_status == 'paid')
                                            <span
                                                class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Paid</span>
                                        @elseif($student->payment_status == 'pending')
                                            <span
                                                class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Due</span>
                                        @else
                                            <span
                                                class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            @if($student->status == 'pending' || $student->status == 'rejected')
                                                <form action="{{ route('admin.enrollments.approve', $student) }}" method="POST"
                                                    class="inline" onsubmit="return confirm('Approve this enrollment?');">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold shadow-sm"
                                                        title="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <!-- View Button -->
                                            <button type="button" onclick='openViewModal(@json($student))'
                                                class="px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            @if($student->status == 'pending' || $student->status == 'active')
                                                <form action="{{ route('admin.enrollments.reject', $student) }}" method="POST"
                                                    class="inline" onsubmit="return confirm('Reject this enrollment?');">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm"
                                                        title="Reject">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('admin.enrollments.destroy', $student) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Delete this record permanently?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm"
                                                    title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                        <i class="fas fa-folder-open text-4xl mb-4 block opacity-30"></i>
                                        No enrollments found matching your criteria.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>

            <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $enrollments->links() }}
            </div>
        </div>
    </div>

    <!-- View Enrollment Modal -->
    <div id="viewEnrollmentModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="closeViewModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-xl leading-6 font-bold text-gray-900 mb-6" id="modal-title">
                                <i class="fas fa-file-alt text-brand-purple mr-2"></i> Application Details
                            </h3>
                            
                            <!-- Applicant Details -->
                            <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 mb-4">
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-3">Applicant</h4>
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold" id="viewInitials">
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-gray-800" id="viewName"></p>
                                        <p class="text-sm text-gray-500" id="viewEmail"></p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <span class="block text-xs text-gray-400">Phone</span>
                                        <span class="block text-sm font-medium" id="viewPhone"></span>
                                    </div>
                                    <div>
                                        <span class="block text-xs text-gray-400">Address</span>
                                        <span class="block text-sm font-medium truncate" id="viewAddress"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Program Details -->
                            <div class="mb-4">
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-2">Program Selected</h4>
                                <div class="p-3 border rounded-lg border-gray-200 flex justify-between items-center">
                                    <span class="font-bold text-brand-purple" id="viewProgram"></span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded" id="viewMode"></span>
                                </div>
                            </div>

                             <!-- Payment Details -->
                            <div class="mb-6">
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-2">Payment Status</h4>
                                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                                    <span class="font-bold text-gray-700" id="viewPaymentStatus"></span>
                                    <span class="font-bold text-gray-800" id="viewAmount"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                     <!-- Dynamic Actions -->
                    <form id="modalApproveForm" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" id="modalApproveBtn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:text-sm">
                            <i class="fas fa-check mr-2"></i> Approve Application
                        </button>
                    </form>
                    
                    <form id="modalRejectForm" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" id="modalRejectBtn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-100 text-base font-medium text-red-700 hover:bg-red-200 focus:outline-none sm:text-sm">
                            Reject
                        </button>
                    </form>

                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm"
                        onclick="closeViewModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openViewModal(student) {
            // Populate Fields
            document.getElementById('viewName').textContent = student.first_name + ' ' + student.last_name;
            document.getElementById('viewInitials').textContent = student.first_name.charAt(0) + student.last_name.charAt(0);
            document.getElementById('viewEmail').textContent = student.email;
            document.getElementById('viewPhone').textContent = student.phone || 'N/A';
            document.getElementById('viewAddress').textContent = student.address || 'N/A';
            
            document.getElementById('viewProgram').textContent = student.program;
            document.getElementById('viewMode').textContent = student.learning_mode.charAt(0).toUpperCase() + student.learning_mode.slice(1);
            
            document.getElementById('viewPaymentStatus').textContent = student.payment_status.charAt(0).toUpperCase() + student.payment_status.slice(1);
            document.getElementById('viewAmount').textContent = '₦' + new Intl.NumberFormat().format(student.amount_paid);

             // Set Form Actions
            const approveUrl = "{{ route('admin.enrollments.approve', ':id') }}".replace(':id', student.id);
            const rejectUrl = "{{ route('admin.enrollments.reject', ':id') }}".replace(':id', student.id);
            
            document.getElementById('modalApproveForm').action = approveUrl;
            document.getElementById('modalRejectForm').action = rejectUrl;
            
            // Hide/Show actions based on status? 
            // User requested "Decision Making Centre". Allow changing decisions (e.g. rejecting an approved one).
            // But usually pending -> approved/rejected.
            // Let's keep both visible unless it's already in that state.
            
            document.getElementById('viewEnrollmentModal').classList.remove('hidden');
        }

        function closeViewModal() {
            document.getElementById('viewEnrollmentModal').classList.add('hidden');
        }
    
        function scrollToPending() {
            document.getElementById('pendingSection').scrollIntoView({ behavior: 'smooth' });
        }

        function toggleAll(source) {
            checkboxes = document.getElementsByName('ids[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        function submitBulk(url) {
            const checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
            if (checkboxes.length === 0) {
                alert('Please select at least one record.');
                return;
            }

            if (!confirm('Are you sure you want to perform this action on ' + checkboxes.length + ' records?')) return;

            const form = document.getElementById('bulkForm');
            form.action = url;
            form.submit();
        }
    </script>
@endsection