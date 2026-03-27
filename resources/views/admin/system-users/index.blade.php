@extends('layouts.admin')

@section('title', 'Admin Users')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">System Administrators</h2>
        <p class="text-sm text-gray-500 mt-1">Manage personnel with access to the backend system.</p>
    </div>
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.system-users.create') }}" 
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-700 transition-all focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
            <i class="fas fa-plus"></i> New Admin
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                    <th class="px-6 py-4">Admin Name</th>
                    <th class="px-6 py-4">Email Address</th>
                    <th class="px-6 py-4">Assigned Role</th>
                    <th class="px-6 py-4">Created Date</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($admins as $admin)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center text-orange-700 font-bold text-xs ring-1 ring-orange-500/10">
                                {{ substr($admin->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-gray-900">{{ $admin->name }}</span>
                            @if(auth()->id() === $admin->id)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-600">You</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                        {{ $admin->email }}
                    </td>
                    <td class="px-6 py-4">
                        @if($admin->role === App\Models\User::ROLE_SUPER_ADMIN)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-200">
                                <i class="fas fa-crown text-[10px]"></i> Super Admin
                            </span>
                        @elseif($admin->role === App\Models\User::ROLE_ADMIN)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                <i class="fas fa-user-shield text-[10px]"></i> Admin
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <i class="fas fa-user-check text-[10px]"></i> Moderator
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $admin->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-right text-sm">
                        <div class="flex items-center justify-end gap-3">
                            @if($admin->role !== App\Models\User::ROLE_SUPER_ADMIN || auth()->user()->hasRole(App\Models\User::ROLE_SUPER_ADMIN))
                                <a href="{{ route('admin.system-users.edit', $admin) }}" 
                                   class="text-gray-400 hover:text-orange-600 transition-colors" title="Edit Admin">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if(auth()->id() !== $admin->id)
                                    <form action="{{ route('admin.system-users.destroy', $admin) }}" method="POST" class="inline-block" onsubmit="return confirm('WARNING: Are you sure you want to completely remove this administrator\'s access to the system?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors" title="Revoke Access & Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <span class="text-xs text-gray-400 italic">Locked</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-users-slash text-3xl mb-3 text-gray-300"></i>
                        <p>No backend administrative users found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($admins->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $admins->links() }}
    </div>
    @endif
</div>
@endsection
