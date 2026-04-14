{{-- ──────────────────────────────────────────────────────────────────────────
     DASHBOARD
     ────────────────────────────────────────────────────────────────────────── --}}
<div class="mb-8">
    <a href="{{ route('admin.dashboard') }}" 
       class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
        <i class="fas fa-home w-6 text-center mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
        Dashboard
    </a>
</div>

{{-- ──────────────────────────────────────────────────────────────────────────
     PROGRAMS
     ────────────────────────────────────────────────────────────────────────── --}}
<div class="mb-8">
    <h3 class="px-5 text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Programs</h3>
    <nav class="space-y-1">
        <a href="{{ route('admin.programs.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.programs.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-layer-group w-6 text-center mr-3 {{ request()->routeIs('admin.programs.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            All Programs
        </a>
        <a href="#" 
           class="group flex items-center rounded-r-lg border-l-4 border-transparent px-4 py-3 text-sm font-medium text-gray-300 cursor-not-allowed">
            <i class="fas fa-tags w-6 text-center mr-3 text-gray-200"></i>
            Categories (Coming)
        </a>
    </nav>
</div>

{{-- ──────────────────────────────────────────────────────────────────────────
     ADMISSIONS
     ────────────────────────────────────────────────────────────────────────── --}}
<div class="mb-8">
    <h3 class="px-5 text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Admissions</h3>
    <nav class="space-y-1">
        <a href="{{ route('admin.applicants.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.applicants.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-users w-6 text-center mr-3 {{ request()->routeIs('admin.applicants.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Applicants
        </a>
        <a href="{{ route('admin.applications.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.applications.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-inbox w-6 text-center mr-3 {{ request()->routeIs('admin.applications.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Applications
            @if(($pendingApplications ?? 0) > 0)
                <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-600">
                    {{ $pendingApplications }}
                </span>
            @endif
        </a>
    </nav>

</div>

{{-- ──────────────────────────────────────────────────────────────────────────
     STUDENTS
     ────────────────────────────────────────────────────────────────────────── --}}
<div class="mb-8">
    <h3 class="px-5 text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Students</h3>
    <nav class="space-y-1">
        <a href="{{ route('admin.students.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.students.index') && !request('status') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-user-graduate w-6 text-center mr-3 {{ request()->routeIs('admin.students.index') && !request('status') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            All Students
        </a>
        <a href="{{ route('admin.enrollments.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.enrollments.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-check-circle w-6 text-center mr-3 {{ request()->routeIs('admin.enrollments.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Enrollments
        </a>
        <a href="{{ route('admin.alumni.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.alumni.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-graduation-cap w-6 text-center mr-3 {{ request()->routeIs('admin.alumni.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Alumni
        </a>
    </nav>
</div>

{{-- ──────────────────────────────────────────────────────────────────────────
     FINANCE
     ────────────────────────────────────────────────────────────────────────── --}}
@if(auth()->user()->hasAnyRole(['super_admin', 'admin']))
<div class="mb-8">
    <h3 class="px-5 text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Finance</h3>
    <nav class="space-y-1">
        <a href="{{ route('admin.payments.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.payments.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-money-bill-wave w-6 text-center mr-3 {{ request()->routeIs('admin.payments.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Payments
        </a>
    </nav>
</div>
@endif

{{-- ──────────────────────────────────────────────────────────────────────────
     CERTIFICATES
     ────────────────────────────────────────────────────────────────────────── --}}
<div class="mb-8">
    <a href="{{ route('admin.certificates.index') }}" 
       class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.certificates.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
        <i class="fas fa-certificate w-6 text-center mr-3 {{ request()->routeIs('admin.certificates.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
        Certificates
    </a>
</div>

{{-- ──────────────────────────────────────────────────────────────────────────
     CONTENT
     ────────────────────────────────────────────────────────────────────────── --}}
<div class="mb-8">
    <h3 class="px-5 text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Content</h3>
    <nav class="space-y-1">
        <a href="{{ route('admin.blog-posts.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.blog-posts.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-blog w-6 text-center mr-3 {{ request()->routeIs('admin.blog-posts.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Blog
        </a>
        <a href="{{ route('admin.features.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.features.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-layer-group w-6 text-center mr-3 {{ request()->routeIs('admin.features.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Features
        </a>
        <a href="{{ route('admin.testimonials.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.testimonials.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-comment-dots w-6 text-center mr-3 {{ request()->routeIs('admin.testimonials.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Testimonials
        </a>
        @if(Route::has('admin.contact-messages.index'))
        <a href="{{ route('admin.contact-messages.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.contact-messages.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-envelope-open-text w-6 text-center mr-3 {{ request()->routeIs('admin.contact-messages.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Contact Messages
            @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
            @if($unread > 0)
                <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-600">{{ $unread }}</span>
            @endif
        </a>
        @endif
        @if(auth()->user()->hasRole('super_admin'))
        <a href="{{ route('admin.seo-meta.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.seo-meta.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-search w-6 text-center mr-3 {{ request()->routeIs('admin.seo-meta.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            SEO Meta
        </a>
        @endif
    </nav>
</div>

{{-- ──────────────────────────────────────────────────────────────────────────
     SYSTEM
     ────────────────────────────────────────────────────────────────────────── --}}
@if(auth()->user()->hasAnyRole(['super_admin', 'admin']))
<div class="mb-8">
    <h3 class="px-5 text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">System</h3>
    <nav class="space-y-1">
        @if(auth()->user()->hasRole('super_admin'))
        <a href="{{ route('admin.settings.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.settings.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-sliders-h w-6 text-center mr-3 {{ request()->routeIs('admin.settings.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Settings
        </a>
        @endif
        <a href="{{ route('admin.system-users.index') }}" 
           class="group flex items-center rounded-r-lg border-l-4 px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.system-users.*') ? 'border-orange-600 bg-orange-50 text-orange-600' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-user-shield w-6 text-center mr-3 {{ request()->routeIs('admin.system-users.*') ? 'text-orange-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            Admins
        </a>
    </nav>
</div>
@endif
