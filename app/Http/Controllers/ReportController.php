<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Http\Requests\ReportFilterRequest;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $logs = null;
        
        if ($request->has('from') && $request->has('to')) {
            $request->validate([
                'from' => 'required|date',
                'to'   => 'required|date|after_or_equal:from',
            ]);
            
            // Adjust the 'to' date to cover the entire day
            $from = \Carbon\Carbon::parse($request->from)->startOfDay();
            $to = \Carbon\Carbon::parse($request->to)->endOfDay();
            
            $logs = ActivityLog::with(['activity', 'user'])
                ->whereBetween('logged_at', [$from, $to])
                ->orderBy('logged_at', 'desc')
                ->get();
        }

        return view('reports.index', compact('logs'));
    }
}
