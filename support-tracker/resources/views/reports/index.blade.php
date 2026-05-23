@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Activity Reports</h1>
    <p class="mt-1 text-sm text-slate-500">Filter and view historical activity logs.</p>
</div>

<!-- Filter Form -->
<div class="bg-white shadow-sm rounded-xl border border-slate-200 p-6 mb-8">
    <form action="{{ route('reports.index') }}" method="GET" class="flex flex-col md:flex-row md:items-end gap-4">
        <div class="flex-1">
            <label for="from" class="block text-sm font-medium text-slate-700">From Date</label>
            <input type="date" id="from" name="from" value="{{ request('from') }}" required
                class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-slate-300 rounded-md px-3 py-2 border">
        </div>
        
        <div class="flex-1">
            <label for="to" class="block text-sm font-medium text-slate-700">To Date</label>
            <input type="date" id="to" name="to" value="{{ request('to') }}" required
                class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-slate-300 rounded-md px-3 py-2 border">
        </div>
        
        <div>
            <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition duration-150 shadow-sm">
                Generate Report
            </button>
        </div>
    </form>
</div>

<!-- Results -->
@if(isset($logs))
    <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200">
            <h2 class="text-lg font-medium text-slate-900">
                Results for {{ \Carbon\Carbon::parse(request('from'))->format('M d, Y') }} to {{ \Carbon\Carbon::parse(request('to'))->format('M d, Y') }}
                <span class="ml-2 text-sm text-slate-500 font-normal">({{ $logs->count() }} records found)</span>
            </h2>
        </div>
        
        @if($logs->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Date & Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Activity</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Remark</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Updated By</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($logs as $log)
                        <tr class="hover:bg-slate-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ $log->logged_at->format('M d, Y g:i A') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-900 max-w-xs truncate">
                                {{ $log->activity->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $log->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($log->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                                {{ $log->remark ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $log->user->name }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-slate-900">No results found</h3>
                <p class="mt-1 text-sm text-slate-500">Try adjusting your date range to find more records.</p>
            </div>
        @endif
    </div>
@endif
@endsection
