@extends('layouts.admin')

@section('title', 'Students')

@section('content')
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-users"></i>
                </div>
                <span
                    class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">+{{ $stats['new_this_week'] }}
                    week</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium">Total Students</h3>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_people'] }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-user-check"></i>
                </div>
                <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">Active</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium">Active Students</h3>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['active_people'] }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <span class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded-full">Alert</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium">At Risk</h3>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['at_risk'] }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <span class="text-xs font-bold text-purple-500 bg-purple-50 px-2 py-1 rounded-full">Alumni</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium">Graduated</h3>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['graduated'] }}</p>
        </div>
    </div>

    <!-- Actions Bar -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <div class="flex flex-wrap gap-4 items-center justify-between">
            <div class="flex gap-3">
                <button onclick="openAddStudentModal()"
                    class="px-6 py-3 bg-gradient-to-r from-brand-purple to-brand-pink text-white font-bold rounded-lg hover:shadow-xl transition-all flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Add New Student
                </button>
                <button
                    class="px-6 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-file-import"></i>
                    Import CSV
                </button>
                <button
                    class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-download"></i>
                    Export
                </button>
            </div>
            <div class="flex gap-3">
                <button
                    class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors flex items-center gap-2">
                    <i class="fas fa-envelope"></i>
                    Send Email
                </button>
                <button
                    class="px-6 py-3 bg-red-100 text-red-700 font-semibold rounded-lg hover:bg-red-200 transition-colors flex items-center gap-2">
                    <i class="fas fa-trash"></i>
                    Delete Selected
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="text-gray-500 text-sm font-medium mb-1">Total People</div>
            <div class="text-3xl font-bold text-gray-800">{{ $stats['total_people'] }}</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="text-gray-500 text-sm font-medium mb-1">Active Students</div>
            <div class="text-3xl font-bold text-brand-purple">{{ $stats['active_people'] }}</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="text-gray-500 text-sm font-medium mb-1">Total Enrollments</div>
            <div class="text-3xl font-bold text-gray-800">{{ $stats['total_enrollments'] }}</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="text-gray-500 text-sm font-medium mb-1">New This Week</div>
            <div class="text-3xl font-bold text-green-600">+{{ $stats['new_this_week'] }}</div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <form id="searchForm" action="{{ route('admin.students.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            oninput="debounceSubmit()"
                            placeholder="Search by name, email, or student ID..."
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                        <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
                    </div>
                </div>
                <select name="program" onchange="this.form.submit()"
                    class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                    <option value="">All Programs</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->slug }}" {{ request('program') == $program->slug ? 'selected' : '' }}>
                            {{ $program->title }}
                        </option>
                    @endforeach
                </select>
                <select name="status" onchange="this.form.submit()"
                    class="px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                    <option value="">All Status</option>
                    @foreach(['active' => 'Active', 'at-risk' => 'At Risk', 'completed' => 'Completed', 'dropped' => 'Dropped Out', 'graduated' => 'Graduated'] as $val => $label)
                        <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-3 mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-brand-purple text-white rounded-lg hover:bg-brand-pink transition-colors text-sm font-semibold">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
                <a href="{{ route('admin.students.index') }}"
                    class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm font-semibold flex items-center">
                    <i class="fas fa-times mr-2"></i>Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Students Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left w-10">
                            <input type="checkbox"
                                class="w-4 h-4 rounded border-gray-300 text-brand-purple focus:ring-brand-purple">
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($students as $student)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <input type="checkbox"
                                    class="w-4 h-4 rounded border-gray-300 text-brand-purple focus:ring-brand-purple">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-brand-purple to-brand-pink rounded-full flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800">{{ $student->first_name }}
                                            {{ $student->last_name }}</div>
                                        <div class="text-xs text-gray-500">{{ $student->email }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div>{{ $student->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $student->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($student->has_active_enrollment)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold border border-green-100">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                            Enrolled
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-50 text-gray-600 rounded-full text-xs font-medium border border-gray-100">
                                            <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                                            Not Enrolled
                                        </span>
                                    @endif
                                    @if($student->enrollments_count > 1)
                                         <span class="ml-2 text-xs text-gray-400" title="{{ $student->enrollments_count }} total enrollments">
                                            <i class="fas fa-history"></i> {{ $student->enrollments_count }}
                                         </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button onclick='openViewModal(@json($student), @json($student->history))'
                                            class="p-2 text-gray-400 hover:text-brand-purple hover:bg-purple-50 rounded-lg transition-colors"
                                            title="View History">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.students.edit', $student->id) }}"
                                            class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                            title="Edit Profile">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Delete this record permanently?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
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
        <div class="mt-4">
            {{ $students->links() }}
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