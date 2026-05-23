<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\UpdateActivityStatusRequest;

class ActivityUpdateController extends Controller
{
    public function store(UpdateActivityStatusRequest $request, Activity $activity)
    {
        $activity->logs()->create([
            'user_id' => auth()->id(),
            'status' => $request->status,
            'remark' => $request->remark,
            'logged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Activity status updated successfully.');
    }
}
