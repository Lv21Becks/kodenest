@extends('layouts.admin')

@section('title', 'Students')

@section('content')
<div class="space-y-6">
    <!-- Quick Actions -->
    <div class="flex flex-wrap gap-3 mb-6">
        <button onclick="openAddStudentModal()" class="inline-flex items-center gap-2 rounded-lg bg-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600 transition-colors">
            <i class="fas fa-plus"></i>
            Add Student
        </button>
        <button class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors">
            <i class="fas fa-file-import text-orange-600"></i>
            Import CSV
        </button>
        <button class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors">
            <i class="fas fa-download text-orange-600"></i>
            Export
        </button>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Students -->
        <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm border border-gray-100">
            <dt>
                <div class="absolute rounded-lg bg-blue-50 p-3">
                    <i class="fas fa-users text-xl text-blue-600"></i>
                </div>
                <p class="ml-16 truncate text-[10px] font-bold uppercase tracking-tight text-gray-400">Total Students</p>
            </dt>
            <dd class="ml-16 flex items-baseline pb-1 sm:pb-2 mt-1">
                <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_people'] ?? 0) }}</p>
                <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                    <i class="fas fa-arrow-up mr-1 text-xs"></i>
                    {{ $stats['new_this_month'] ?? 0 }} this month
                </div>
            </dd>
        </div>

        <!-- Active Students -->
        <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm border border-gray-100">
            <dt>
                <div class="absolute rounded-lg bg-green-50 p-3">
                    <i class="fas fa-user-check text-xl text-green-600"></i>
                </div>
                <p class="ml-16 truncate text-[10px] font-bold uppercase tracking-tight text-gray-400">Active Students</p>
            </dt>
            <dd class="ml-16 flex items-baseline pb-1 sm:pb-2 mt-1">
                <p class="text-3xl font-black text-gray-900">{{ number_format($stats['active_people'] ?? 0) }}</p>
                <div class="ml-2 flex items-baseline text-sm font-medium text-gray-500">
                    Currently enrolled
                </div>
            </dd>
        </div>

        <!-- At Risk -->
        <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm border border-gray-100">
            <dt>
                <div class="absolute rounded-lg bg-yellow-50 p-3">
                    <i class="fas fa-exclamation-triangle text-xl text-yellow-600"></i>
                </div>
                <p class="ml-16 truncate text-[10px] font-bold uppercase tracking-tight text-gray-400">At Risk</p>
            </dt>
            <dd class="ml-16 flex items-baseline pb-1 sm:pb-2 mt-1">
                <p class="text-3xl font-black text-gray-900">{{ number_format($stats['at_risk'] ?? 0) }}</p>
                <div class="ml-2 flex items-baseline text-sm font-medium text-red-500">
                    Needs attention
                </div>
            </dd>
        </div>

        <!-- Alumni / Graduated -->
        <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm border border-gray-100">
            <dt>
                <div class="absolute rounded-lg bg-purple-50 p-3">
                    <i class="fas fa-graduation-cap text-xl text-purple-600"></i>
                </div>
                <p class="ml-16 truncate text-[10px] font-bold uppercase tracking-tight text-gray-400">Graduated</p>
            </dt>
            <dd class="ml-16 flex items-baseline pb-1 sm:pb-2 mt-1">
                <p class="text-3xl font-black text-gray-900">{{ number_format($stats['graduated'] ?? 0) }}</p>
                <div class="ml-2 flex items-baseline text-sm font-medium text-gray-500">
                    Alumni
                </div>
            </dd>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="rounded-xl bg-white shadow-sm border border-gray-100 p-6 mb-6">
        <form id="searchForm" action="{{ route('admin.students.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            oninput="debounceSubmit()"
                            placeholder="Search by name, email, or student ID..."
                            class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50">
                        <i class="fas fa-search absolute left-3.5 top-3 text-gray-400"></i>
                    </div>
                </div>
                <select name="program" onchange="this.form.submit()"
                    class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 text-gray-700">
                    <option value="">All Programs</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->slug }}" {{ request('program') == $program->slug ? 'selected' : '' }}>
                            {{ $program->title }}
                        </option>
                    @endforeach
                </select>
                <select name="status" onchange="this.form.submit()"
                    class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 transition-colors bg-gray-50 text-gray-700">
                    <option value="">All Statuses</option>
                    @foreach(['active' => 'Active', 'at-risk' => 'At Risk', 'completed' => 'Completed', 'dropped' => 'Dropped Out', 'graduated' => 'Graduated'] as $val => $label)
                        <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-3 mt-4">
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded bg-orange-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-orange-500 transition-colors">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="{{ route('admin.students.index') }}"
                    class="inline-flex items-center gap-2 rounded bg-white px-3 py-1.5 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times text-red-500"></i> Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Students Table -->
    <div class="rounded-xl bg-white shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap text-left text-sm">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-5 text-left w-10">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-orange-600 focus:ring-orange-600">
                        </th>
                        <th scope="col" class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider">Avatar & Name</th>
                        <th scope="col" class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider">Program</th>
                        <th scope="col" class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider">Progress</th>
                        <th scope="col" class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-5 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($students as $student)
                            @php
                                $latestEnrollment = $student->enrollments->sortByDesc('created_at')->first();
                                $progress = $latestEnrollment?->progress ?? 0;
                                $progressColor = $progress < 30 ? 'bg-red-500' : ($progress < 70 ? 'bg-yellow-500' : 'bg-green-500');
                                $enrollStatus = $latestEnrollment?->status ?? 'none';
                            @endphp
                            <tr class="even:bg-gray-50/50 hover:bg-orange-50/30 transition-colors cursor-pointer group">
                                <td class="px-6 py-5">
                                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-orange-600 focus:ring-orange-600">
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                            {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    @if($latestEnrollment?->program)
                                        <span class="text-sm text-gray-700 font-medium">{{ $latestEnrollment->program->title }}</span>
                                        <div class="text-xs text-gray-400 mt-0.5"><i class="fas fa-calendar-alt mr-1"></i>Enrolled {{ $latestEnrollment->enrollment_date?->format('M Y') ?? $student->created_at->format('M Y') }}</div>
                                    @else
                                        <span class="text-xs text-gray-400">No enrollment</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    <div class="w-32">
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="font-medium text-gray-700">Progress</span>
                                            <span class="text-gray-500">{{ $progress }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5 flex overflow-hidden">
                                            <div class="{{ $progressColor }} h-1.5 rounded-full" style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    @if($enrollStatus === 'active')
                                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Active</span>
                                    @elseif($enrollStatus === 'completed')
                                        <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">Completed</span>
                                    @elseif($enrollStatus === 'dropped')
                                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Dropped</span>
                                    @elseif($enrollStatus === 'suspended')
                                        <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">Suspended</span>
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">No Enrollment</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.students.edit', $student->id) }}"
                                            class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                            title="Edit Student">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Delete this student record permanently?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-user-slash text-2xl text-gray-300"></i>
                                        </div>
                                        <p class="font-medium">No students found</p>
                                        <p class="text-sm text-gray-400 mt-1">Try adjusting your search filters</p>
                                    </div>
                                </td>
                            </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="border-t border-gray-200 px-6 py-4">
            {{ $students->links() }}
        </div>
    </div>
</div>


    <!-- Add Student Modal -->
    <div id="addStudentModal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div
                class="sticky top-0 bg-gradient-to-r from-brand-purple to-brand-pink text-white px-8 py-6 flex items-center justify-between">
                <h2 class="text-2xl font-black">Add New Student</h2>
                <button onclick="closeAddStudentModal()"
                    class="text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form action="{{ route('admin.students.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">First Name *</label>
                        <input type="text" name="first_name" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                            placeholder="Enter first name">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Last Name *</label>
                        <input type="text" name="last_name" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                            placeholder="Enter last name">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Address *</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                        placeholder="student@email.com">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number *</label>
                    <input type="tel" name="phone" required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                        placeholder="+234 XXX XXX XXXX">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Program *</label>
                        <select name="program" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                            <option value="">Select Program</option>
                            <option value="data-analytics">Data Analytics</option>
                            <option value="software-dev">Software Development</option>
                            <option value="cybersecurity">Cybersecurity</option>
                            <option value="uiux">UI/UX Design</option>
                            <option value="office">Office Productivity</option>
                            <option value="kids">Coding for Kids</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Learning Mode *</label>
                        <select name="learning_mode" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                            <option value="">Select Mode</option>
                            <option value="online">Online</option>
                            <option value="physical">Physical</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Payment Status</label>
                    <select name="payment_status"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="partial">Partial Payment</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Address</label>
                    <textarea name="address" rows="3"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                        placeholder="Enter student address"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" rows="3"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors"
                        placeholder="Additional notes about the student"></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 px-6 py-4 bg-gradient-to-r from-brand-purple to-brand-pink text-white font-bold rounded-lg hover:shadow-xl transition-all">
                        <i class="fas fa-save mr-2"></i>Add Student
                    </button>
                    <button type="button" onclick="closeAddStudentModal()"
                        class="flex-1 px-6 py-4 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- View Student Modal -->
    <div id="viewStudentModal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden transform transition-all scale-95 opacity-0" id="viewModalContent">
            <div class="bg-gradient-to-r from-brand-purple to-brand-pink p-6 text-white flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-black" id="viewStudentName">Student Name</h2>
                    <p class="opacity-90 text-sm" id="viewStudentProgram">Program Name</p>
                </div>
                <button onclick="closeViewModal()" class="text-white/80 hover:text-white hover:bg-white/20 rounded-lg p-1">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Contact Info -->
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500 font-medium mb-1">Email</p>
                        <p class="font-bold text-gray-800 break-words" id="viewStudentEmail">email@example.com</p>
                    </div>
                    <div>
                        <p class="text-gray-500 font-medium mb-1">Phone</p>
                        <p class="font-bold text-gray-800" id="viewStudentPhone">+123456789</p>
                    </div>
                </div>

                <!-- Payment Status Visualization -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-wallet text-brand-purple"></i> Payment Status
                    </h3>
                    
                    <div class="mb-2 flex justify-between text-sm">
                        <span class="text-gray-600">Amount Paid</span>
                        <span class="font-bold text-brand-purple" id="viewPaymentText">₦0 / ₦0</span>
                    </div>
                    
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div id="viewPaymentBar" class="bg-green-500 h-3 rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
                    </div>
                    
                    <div class="mt-2 text-xs text-right text-gray-500" id="viewPaymentStatus">
                        Status: Pending
                    </div>
                </div>

                <!-- Additional Details -->
                <div class="space-y-3 pt-2 border-t border-gray-100">
                     <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Learning Mode</span>
                        <span class="font-bold text-gray-800 capitalize" id="viewLearningMode">Online</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Enrolled Date</span>
                        <span class="font-bold text-gray-800" id="viewDate">Jan 1, 2024</span>
                    </div>
                     <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Address</span>
                        <span class="font-bold text-gray-800 text-right w-1/2 break-words" id="viewAddress">-</span>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 border-t border-gray-100 text-right">
                <button onclick="closeViewModal()" class="px-4 py-2 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Formatting Currency
        const formatCurrency = (amount) => {
            return new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' }).format(amount);
        };

        // Open View Modal
        function openViewModal(student, totalPrice, programTitle, directAmountPaid) {
            // Populate Fields
            document.getElementById('viewStudentName').innerText = student.first_name + ' ' + student.last_name;
            document.getElementById('viewStudentProgram').innerText = programTitle;
            document.getElementById('viewStudentEmail').innerText = student.email;
            document.getElementById('viewStudentPhone').innerText = student.phone;
            document.getElementById('viewLearningMode').innerText = student.learning_mode || 'Online'; // Default if missing
            document.getElementById('viewDate').innerText = new Date(student.created_at).toLocaleDateString();
            document.getElementById('viewAddress').innerText = student.address || 'N/A';

            // Payment Logic
            // Use directAmountPaid if available, otherwise fallback to student object
            const amountPaid = parseFloat(directAmountPaid) || parseFloat(student.amount_paid) || 0;
            const total = parseFloat(totalPrice) || 0;
            const percent = total > 0 ? (amountPaid / total) * 100 : 0;

            document.getElementById('viewPaymentText').innerText = `${formatCurrency(amountPaid)} / ${formatCurrency(total)}`;
            document.getElementById('viewPaymentBar').style.width = `${Math.min(percent, 100)}%`;
            
            // Status Logic (Derived from Payment Status)
            const pStatus = student.payment_status ? (student.payment_status.charAt(0).toUpperCase() + student.payment_status.slice(1)) : 'Unknown';
            document.getElementById('viewPaymentStatus').innerText = `Status: ${pStatus}`;

            // Show Modal with Animation
            const modal = document.getElementById('viewStudentModal');
            const content = document.getElementById('viewModalContent');
            
            modal.classList.remove('hidden');
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeViewModal() {
            const modal = document.getElementById('viewStudentModal');
            const content = document.getElementById('viewModalContent');
            
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Modal Functions (Add Student)
        function openAddStudentModal() {
            document.getElementById('addStudentModal').classList.remove('hidden');
        }

        function closeAddStudentModal() {
            document.getElementById('addStudentModal').classList.add('hidden');
        }

        // Student Actions
        function editStudent(id) {
            alert(`Editing student ID: ${id}`);
        }

        // Close modal on outside click
        document.getElementById('addStudentModal').addEventListener('click', function (e) {
            if (e.target === this) closeAddStudentModal();
        });
        
        document.getElementById('viewStudentModal').addEventListener('click', function (e) {
            if (e.target === this) closeViewModal();
        });

        // Close modal on ESC key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeAddStudentModal();
                closeViewModal();
            }
        });

        // Live Search Debounce
        let timeout = null;
        function debounceSubmit() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                document.getElementById('searchForm').submit();
            }, 600); // 600ms debounce
        }
    </script>
@endsection