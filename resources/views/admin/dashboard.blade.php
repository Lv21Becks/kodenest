@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
         ZONE 1 — KEY METRICS
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

        {{-- Pending Applications --}}
        <a href="{{ route('admin.applications.index', ['status' => 'pending']) }}"
            class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-orange-200 transition-all">
            <dt>
                <div class="absolute rounded-xl bg-orange-50 p-3 group-hover:bg-orange-100 transition-colors">
                    <i class="fas fa-inbox text-xl text-orange-600"></i>
                </div>
                <p class="ml-16 truncate text-sm font-medium text-gray-500">Pending Applications</p>
            </dt>
            <dd class="ml-16 flex items-baseline mt-2">
                <p class="text-4xl font-black text-gray-900 leading-tight">{{ $pendingApplications }}</p>
                @if($pendingApplications > 0)
                    <span class="ml-2 inline-flex items-center rounded-full bg-orange-100 px-2 py-0.5 text-xs font-semibold text-orange-700">Needs action</span>
                @endif
            </dd>
            <div class="mt-3 text-xs font-medium text-orange-600 group-hover:underline">Review now →</div>
        </a>

        {{-- Active Students --}}
        <a href="{{ route('admin.students.index') }}"
            class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-green-200 transition-all">
            <dt>
                <div class="absolute rounded-xl bg-green-50 p-3 group-hover:bg-green-100 transition-colors">
                    <i class="fas fa-user-check text-xl text-green-600"></i>
                </div>
                <p class="ml-16 truncate text-sm font-medium text-gray-500">Active Students</p>
            </dt>
            <dd class="ml-16 flex items-baseline mt-2">
                <p class="text-4xl font-black text-gray-900 leading-tight">{{ $activeStudents }}</p>
                <span class="ml-2 text-xs text-gray-400 font-medium">Currently enrolled</span>
            </dd>
            <div class="mt-3 text-xs font-medium text-green-600 group-hover:underline">View students →</div>
        </a>

        {{-- Payments Pending --}}
        <a href="{{ route('admin.payments.index') }}"
            class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-yellow-200 transition-all">
            <dt>
                <div class="absolute rounded-xl bg-yellow-50 p-3 group-hover:bg-yellow-100 transition-colors">
                    <i class="fas fa-money-bill-wave text-xl text-yellow-600"></i>
                </div>
                <p class="ml-16 truncate text-sm font-medium text-gray-500">Payments Pending</p>
            </dt>
            <dd class="ml-16 flex items-baseline mt-2">
                <p class="text-4xl font-black text-gray-900 leading-tight">{{ $pendingPayments }}</p>
                @if($pendingPayments > 0)
                    <span class="ml-2 inline-flex items-center rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-semibold text-yellow-700">Unpaid</span>
                @endif
            </dd>
            <div class="mt-3 text-xs font-medium text-yellow-600 group-hover:underline">View payments →</div>
        </a>

        {{-- Certificates Ready --}}
        <a href="#"
            class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-purple-200 transition-all">
            <dt>
                <div class="absolute rounded-xl bg-purple-50 p-3 group-hover:bg-purple-100 transition-colors">
                    <i class="fas fa-certificate text-xl text-purple-600"></i>
                </div>
                <p class="ml-16 truncate text-sm font-medium text-gray-500">Certificates Ready</p>
            </dt>
            <dd class="ml-16 flex items-baseline mt-2">
                <p class="text-4xl font-black text-gray-900 leading-tight">{{ $certificatesReady }}</p>
                <span class="ml-2 text-xs text-gray-400 font-medium">Unclaimed</span>
            </dd>
            <div class="mt-3 text-xs font-medium text-purple-600 group-hover:underline">View all →</div>
        </a>

        {{-- Total Programs --}}
        <a href="{{ route('admin.programs.index') }}"
            class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition-all">
            <dt>
                <div class="absolute rounded-xl bg-blue-50 p-3 group-hover:bg-blue-100 transition-colors">
                    <i class="fas fa-laptop-code text-xl text-blue-600"></i>
                </div>
                <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Programs</p>
            </dt>
            <dd class="ml-16 flex items-baseline mt-2">
                <p class="text-4xl font-black text-gray-900 leading-tight">{{ $totalPrograms }}</p>
                <span class="ml-2 text-xs text-gray-400 font-medium">Active</span>
            </dd>
            <div class="mt-3 text-xs font-medium text-blue-600 group-hover:underline">Manage →</div>
        </a>
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
         ZONE 2 — ACTION PANELS
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Needs Attention --}}
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 flex flex-col">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">⚠️ Needs Attention</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Items requiring your action right now</p>
                </div>
            </div>

            <div class="divide-y divide-gray-50 flex-1">
                {{-- Pending Applications --}}
                @forelse($pendingApplicationsList as $app)
                    <a href="{{ route('admin.applications.index', ['status' => 'pending']) }}"
                        class="flex items-center gap-4 px-6 py-4 hover:bg-orange-50/50 transition-colors group">
                        <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center shrink-0 text-orange-600 font-bold text-xs">
                            {{ substr($app->applicant->first_name ?? '?', 0, 1) }}{{ substr($app->applicant->last_name ?? '?', 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $app->applicant->first_name ?? 'Unknown' }} {{ $app->applicant->last_name ?? 'Applicant' }}</p>
                            <p class="text-xs text-gray-400 truncate">Application pending · {{ $app->program_id }}</p>
                        </div>
                        <div class="shrink-0 text-right">
                            <span class="inline-flex items-center rounded-full bg-orange-100 px-2 py-0.5 text-xs font-semibold text-orange-700">Pending</span>
                            <p class="text-xs text-gray-400 mt-1">{{ $app->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                @empty
                @endforelse

                {{-- Pending Invoices --}}
                @forelse($pendingInvoicesList as $invoice)
                    <a href="{{ route('admin.payments.index') }}"
                        class="flex items-center gap-4 px-6 py-4 hover:bg-yellow-50/50 transition-colors group">
                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center shrink-0">
                            <i class="fas fa-file-invoice-dollar text-yellow-600 text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Invoice #{{ $invoice->id }}</p>
                            <p class="text-xs text-gray-400">Payment {{ $invoice->status }} · NGN {{ number_format($invoice->balance ?? 0) }}</p>
                        </div>
                        <div class="shrink-0">
                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-semibold text-yellow-700">{{ ucfirst($invoice->status) }}</span>
                        </div>
                    </a>
                @empty
                @endforelse

                @if($pendingApplicationsList->isEmpty() && $pendingInvoicesList->isEmpty())
                    <div class="px-6 py-12 text-center">
                        <i class="fas fa-check-circle text-4xl text-green-300 mb-3"></i>
                        <p class="text-sm font-medium text-gray-500">All clear — nothing needs attention!</p>
                    </div>
                @endif
            </div>

            @if($pendingApplicationsList->isNotEmpty() || $pendingInvoicesList->isNotEmpty())
                <div class="px-6 py-3 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                    <a href="{{ route('admin.applications.index', ['status' => 'pending']) }}" class="text-xs font-semibold text-orange-600 hover:underline">View all pending applications →</a>
                </div>
            @endif
        </div>

        {{-- Recent Activity --}}
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 flex flex-col">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">🕒 Recent Activity</h3>
                <p class="text-xs text-gray-400 mt-0.5">What's been happening across the platform</p>
            </div>

            <div class="p-6 flow-root flex-1 overflow-y-auto max-h-80">
                <ul role="list" class="-mb-8">
                    @forelse($recentActivity as $activity)
                    <li>
                        <div class="relative pb-7">
                            @if(!$loop->last)
                                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-100" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex items-start gap-3">
                                <div class="shrink-0">
                                    <span class="h-8 w-8 rounded-full {{ $activity->color }} flex items-center justify-center ring-4 ring-white">
                                        <i class="{{ $activity->icon }} text-xs"></i>
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0 pt-1">
                                    <a href="{{ $activity->url }}" class="text-sm font-medium text-gray-900 hover:text-orange-600 transition-colors">
                                        {{ $activity->title }}
                                    </a>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $activity->description }}</p>
                                </div>
                                <div class="shrink-0 text-xs text-gray-400 pt-1 whitespace-nowrap">
                                    {{ $activity->time->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="py-8 text-center">
                        <i class="fas fa-stream text-2xl text-gray-200 mb-2"></i>
                        <p class="text-sm text-gray-400">No recent activity yet.</p>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
         ZONE 3 — TRENDS (last 7 days)
    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Applications Trend --}}
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Applications — Last 7 Days</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Daily new applications received</p>
                </div>
                <span class="text-xs font-semibold text-gray-500">
                    Total: {{ $appTrend->sum('count') }}
                </span>
            </div>
            <div class="flex items-end gap-2 h-32">
                @foreach($appTrend as $day)
                    @php $pct = $appTrendMax > 0 ? round(($day['count'] / $appTrendMax) * 100) : 0; @endphp
                    <div class="flex-1 flex flex-col items-center gap-1">
                        <span class="text-xs font-semibold text-gray-700">{{ $day['count'] ?: '' }}</span>
                        <div class="w-full rounded-t-md transition-all"
                            style="height: {{ max($pct, 4) }}%; background-color: {{ $day['count'] > 0 ? '#f97316' : '#fed7aa' }}; min-height: 4px; max-height: 100px;">
                        </div>
                        <span class="text-xs text-gray-400">{{ $day['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Payments Trend --}}
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Payments — Last 7 Days</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Daily invoices created</p>
                </div>
                <span class="text-xs font-semibold text-gray-500">
                    Total: {{ $paymentTrend->sum('count') }}
                </span>
            </div>
            <div class="flex items-end gap-2 h-32">
                @foreach($paymentTrend as $day)
                    @php $pct = $paymentTrendMax > 0 ? round(($day['count'] / $paymentTrendMax) * 100) : 0; @endphp
                    <div class="flex-1 flex flex-col items-center gap-1">
                        <span class="text-xs font-semibold text-gray-700">{{ $day['count'] ?: '' }}</span>
                        <div class="w-full rounded-t-md transition-all"
                            style="height: {{ max($pct, 4) }}%; background-color: {{ $day['count'] > 0 ? '#22c55e' : '#bbf7d0' }}; min-height: 4px; max-height: 100px;">
                        </div>
                        <span class="text-xs text-gray-400">{{ $day['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection