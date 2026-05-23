<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class DailyHandoverController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with(['activity', 'user'])
            ->whereDate('logged_at', today())
            ->orderBy('logged_at', 'desc')
            ->get()
            ->groupBy('activity_id');
            
        return view('daily.index', compact('logs'));
    }
}
