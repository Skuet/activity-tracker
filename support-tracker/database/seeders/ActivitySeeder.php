<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\User;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first(); // Assumes at least one user exists (from UserSeeder)
        $adminId = $admin ? $admin->id : 1;

        $activities = [
            'Daily SMS Count vs Log Count',
            'Failed Transaction Reconciliation',
            'System Uptime Check',
            'Escalation Queue Review',
            'End-of-Day Incident Summary',
        ];

        foreach ($activities as $title) {
            Activity::create([
                'title' => $title,
                'description' => "Standard daily support activity for: {$title}",
                'created_by' => $adminId,
            ]);
        }
    }
}
