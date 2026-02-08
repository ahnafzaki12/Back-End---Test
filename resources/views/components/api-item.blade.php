@props(['method', 'url', 'desc', 'auth' => false])

@php
    $colors = [
        'GET' => 'bg-emerald-100 text-emerald-700',
        'POST' => 'bg-blue-100 text-blue-700',
        'PUT' => 'bg-amber-100 text-amber-700',
        'DELETE' => 'bg-rose-100 text-rose-700',
    ];
@endphp

<div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
    <div class="flex flex-col md:flex-row md:items-center gap-4">
        <span class="px-3 py-1 rounded text-xs font-bold w-fit {{ $colors[$method] ?? 'bg-slate-100 text-slate-700' }}">
            {{ $method }}
        </span>
        <code class="text-indigo-600 font-semibold text-sm flex-1">{{ $url }}</code>
        @if($auth)
            <span class="text-[10px] uppercase tracking-wider font-bold text-slate-400 flex items-center">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                Auth Required
            </span>
        @endif
    </div>
    <p class="mt-2 text-slate-500 text-sm">{{ $desc }}</p>
</div>