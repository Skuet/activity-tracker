<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-slate-900">Activities</h1>
    <a href="<?php echo e(route('activities.create')); ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 shadow-sm">
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
                <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-slate-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                        <?php echo e($activity->title); ?>

                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">
                        <?php echo e($activity->description ?? '-'); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        <?php echo e($activity->creator->name ?? 'Unknown'); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        <?php echo e($activity->created_at->format('M d, Y')); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?php echo e(route('activities.show', $activity)); ?>" class="text-indigo-600 hover:text-indigo-900">View & Update</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-500">
                        No activities defined yet.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($activities->hasPages()): ?>
    <div class="px-6 py-4 border-t border-slate-200">
        <?php echo e($activities->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\activity tracker\resources\views/activities/index.blade.php ENDPATH**/ ?>