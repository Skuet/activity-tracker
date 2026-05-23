<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daily Handover</h1>
    <p class="mt-2 text-lg text-slate-600">Today's updates &mdash; <span class="font-medium"><?php echo e(now()->format('l, F j, Y')); ?></span></p>
</div>

<?php if($logs->isEmpty()): ?>
<div class="bg-white shadow-sm rounded-xl border border-slate-200 p-12 text-center">
    <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <h3 class="mt-2 text-sm font-medium text-slate-900">No updates today</h3>
    <p class="mt-1 text-sm text-slate-500">There have been no activity logs recorded for today yet.</p>
</div>
<?php else: ?>
<div class="space-y-8">
    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activityId => $activityLogs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $activity = $activityLogs->first()->activity;
        ?>
        
        <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-slate-900"><?php echo e($activity->title); ?></h3>
                <a href="<?php echo e(route('activities.show', $activity)); ?>" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">View Activity</a>
            </div>
            
            <div class="divide-y divide-slate-100">
                <?php $__currentLoopData = $activityLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="px-6 py-5 hover:bg-slate-50 transition duration-150">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($log->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                <?php echo e(ucfirst($log->status)); ?>

                            </span>
                            <div>
                                <p class="text-sm text-slate-900">
                                    <span class="font-medium"><?php echo e($log->user->name); ?></span> updated status
                                </p>
                                <?php if($log->remark): ?>
                                    <p class="mt-2 text-sm text-slate-600 italic border-l-2 border-slate-200 pl-3">"<?php echo e($log->remark); ?>"</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="text-sm text-slate-500 whitespace-nowrap ml-4">
                            <?php echo e($log->logged_at->format('g:i A')); ?>

                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\activity tracker\resources\views/daily/index.blade.php ENDPATH**/ ?>