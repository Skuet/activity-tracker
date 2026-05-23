<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('activities.index')); ?>" class="text-sm text-indigo-600 hover:text-indigo-900 flex items-center">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to Activities
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <!-- Activity Details -->
        <div class="bg-white shadow-sm rounded-xl border border-slate-200 p-6">
            <h2 class="text-2xl font-bold text-slate-900"><?php echo e($activity->title); ?></h2>
            <?php if($activity->description): ?>
                <div class="mt-4 prose prose-sm text-slate-600">
                    <?php echo e($activity->description); ?>

                </div>
            <?php endif; ?>
        </div>

        <!-- Log History -->
        <div class="bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200">
                <h3 class="text-lg font-medium text-slate-900">Update History</h3>
            </div>
            <div class="px-6 py-6">
                <?php if($activity->logs->count() > 0): ?>
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            <?php $__currentLoopData = $activity->logs->sortByDesc('logged_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="relative pb-8">
                                    <?php if(!$loop->last): ?>
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-slate-200" aria-hidden="true"></span>
                                    <?php endif; ?>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white <?php echo e($log->status === 'done' ? 'bg-green-100' : 'bg-yellow-100'); ?>">
                                                <?php if($log->status === 'done'): ?>
                                                    <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                <?php else: ?>
                                                    <svg class="h-5 w-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-slate-500">
                                                    Updated to <span class="font-medium text-slate-900 <?php echo e($log->status === 'done' ? 'text-green-700' : 'text-yellow-700'); ?>"><?php echo e(ucfirst($log->status)); ?></span> by 
                                                    <span class="font-medium text-slate-900"><?php echo e($log->user->name); ?></span>
                                                </p>
                                                <?php if($log->remark): ?>
                                                    <p class="mt-2 text-sm text-slate-700 bg-slate-50 p-3 rounded-lg border border-slate-100"><?php echo e($log->remark); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-right text-xs whitespace-nowrap text-slate-500">
                                                <time datetime="<?php echo e($log->logged_at->toIso8601String()); ?>"><?php echo e($log->logged_at->format('M d, g:i A')); ?></time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <p class="text-sm text-slate-500 text-center py-4">No updates recorded for this activity yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Update Form -->
    <div class="lg:col-span-1">
        <div class="bg-white shadow-sm rounded-xl border border-slate-200 sticky top-6">
            <div class="px-6 py-5 border-b border-slate-200">
                <h3 class="text-lg font-medium text-slate-900">Post Update</h3>
            </div>
            <div class="px-6 py-6">
                <form action="<?php echo e(route('activity.logs.store', $activity)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="space-y-5">
                        <div>
                            <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-slate-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md border" required>
                                <option value="" disabled selected>Select status</option>
                                <option value="done" <?php echo e(old('status') == 'done' ? 'selected' : ''); ?>>Done</option>
                                <option value="pending" <?php echo e(old('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            </select>
                        </div>

                        <div>
                            <label for="remark" class="block text-sm font-medium text-slate-700">Remark <span class="text-slate-400 font-normal">(Optional)</span></label>
                            <div class="mt-1">
                                <textarea id="remark" name="remark" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-slate-300 rounded-md px-3 py-2"><?php echo e(old('remark')); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                            Submit Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\activity tracker\resources\views/activities/show.blade.php ENDPATH**/ ?>