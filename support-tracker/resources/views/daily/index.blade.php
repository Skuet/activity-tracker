@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daily Handover</h1>
    <p class="mt-2 text-lg text-slate-600">Today's updates &mdash; <span class="font-medium">{{ now()->format('l, F j, Y') }}</span></p>
</div>

@if($logs->isEmpty())
<div class="bg-white shadow-sm rounded-xl border border-slate-200 p-12 text-center">
    <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <h3 class="mt-2 text-sm font-medium text-slate-900">No updates today</h3>
    <p class="mt-1 text-sm text-slate-500">There have been no activity logs recorded for today yet.</p>
</div>
@else
<div class="space-y-8">
    @foreach($logs as $activityId => $activityLogs)
        @php
            $activity = $activityLogs->first()->activity;
        @endphp
        
        <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-slate-900">{{ $activity->title }}</h3>
                <a href="{{ route('activities.show', $activity) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">View Activity</a>
            </div>
            
            <div class="divide-y divide-slate-100">
                @foreach($activityLogs as $log)
                <div class="px-6 py-5 hover:bg-slate-50 transition duration-150">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $log->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($log->status) }}
                            </span>
                            <div>
                                <p class="text-sm text-slate-900">
                                    <span class="font-medium">{{ $log->user->name }}</span> updated status
                                </p>
                                @if($log->remark)
                                    <p class="mt-2 text-sm text-slate-600 italic border-l-2 border-slate-200 pl-3">"{{ $log->remark }}"</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-sm text-slate-500 whitespace-nowrap ml-4">
                            {{ $log->logged_at->format('g:i A') }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endif
@endsection
