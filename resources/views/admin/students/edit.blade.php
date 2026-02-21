@extends('layouts.admin')

@section('title', 'Edit Student')
@section('header_title', 'Edit Student')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Student Details</h2>

            <form action="{{ route('admin.students.update', $student) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- First Name -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $student->email) }}" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                    </div>

                    <!-- Program -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Program</label>
                        <select name="program" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                            @foreach($programs as $program)
                                <option value="{{ $program->slug }}" {{ old('program', $student->program) == $program->slug ? 'selected' : '' }}>
                                    {{ $program->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Learning Mode -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Learning Mode</label>
                        <select name="learning_mode" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                            <option value="online" {{ old('learning_mode', $student->learning_mode) == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="physical" {{ old('learning_mode', $student->learning_mode) == 'physical' ? 'selected' : '' }}>Physical</option>
                            <option value="hybrid" {{ old('learning_mode', $student->learning_mode) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    <!-- Payment Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Status</label>
                        <select name="payment_status" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                            <option value="paid" {{ old('payment_status', $student->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="partial" {{ old('payment_status', $student->payment_status) == 'partial' ? 'selected' : '' }}>Partial</option>
                            <option value="pending" {{ old('payment_status', $student->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="due" {{ old('payment_status', $student->payment_status) == 'due' ? 'selected' : '' }}>Due</option>
                        </select>
                    </div>

                    <!-- Amount Paid -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Amount Paid (₦)</label>
                        <input type="number" name="amount_paid" value="{{ old('amount_paid', $student->amount_paid) }}"
                            min="0" step="0.01" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">
                            <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="pending" {{ old('status', $student->status) == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="graduated" {{ old('status', $student->status) == 'graduated' ? 'selected' : '' }}>
                                Graduated</option>
                            <option value="dropped" {{ old('status', $student->status) == 'dropped' ? 'selected' : '' }}>
                                Dropped</option>
                            <option value="at_risk" {{ old('status', $student->status) == 'at_risk' ? 'selected' : '' }}>At
                                Risk</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                        <textarea name="address" rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">{{ old('address', $student->address) }}</textarea>
                    </div>

                    <!-- Notes -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                        <textarea name="notes" rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-brand-purple focus:outline-none transition-colors">{{ old('notes', $student->notes) }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.students.index') }}"
                        class="px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-brand-purple text-white font-bold rounded-lg hover:bg-brand-pink transition-colors">
                        Update Student
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection