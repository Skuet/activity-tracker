<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('creator')->paginate(15);
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(StoreActivityRequest $request)
    {
        Activity::create([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    public function show($id)
    {
        $activity = Activity::with(['logs.user'])->findOrFail($id);
        return view('activities.show', compact('activity'));
    }
}
