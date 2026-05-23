@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-slate-900">Activities</h1>
    <a href="{{ route('activities.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 shadow-sm">
        Add Activity
    </a>
</div>

<div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Description</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Created By</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Date Added</th>
                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">View</span></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($activities as $activity)
                <tr class="hover:bg-slate-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                        {{ $activity->title }}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                        {{ $activity->description ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        {{ $activity->creator->name ?? 'Unknown' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        {{ $activity->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('activities.show', $activity) }}" class="text-indigo-600 hover:text-indigo-900">View & Update</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-500">
                        No activities defined yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($activities->hasPages())
    <div class="px-6 py-4 border-t border-slate-200">
        {{ $activities->links() }}
    </div>
    @endif
</div>
@endsection
