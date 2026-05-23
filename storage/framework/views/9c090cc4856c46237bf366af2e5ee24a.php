<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('activities.index')); ?>" class="text-sm text-indigo-600 hover:text-indigo-900 flex items-center">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to Activities
    </a>
</div>

<div class="max-w-2xl bg-white shadow-sm rounded-xl border border-slate-200 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-200">
        <h2 class="text-xl font-semibold text-slate-900">Add New Activity</h2>
        <p class="mt-1 text-sm text-slate-500">Define a new activity for the team to track.</p>
    </div>
    
    <div class="px-6 py-6">
        <form action="<?php echo e(route('activities.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700">Activity Title</label>
                    <div class="mt-1">
                        <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-slate-300 rounded-md px-3 py-2 border">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Description <span class="text-slate-400 font-normal">(Optional)</span></label>
                    <div class="mt-1">
                        <textarea id="description" name="description" rows="4"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-slate-300 rounded-md px-3 py-2"><?php echo e(old('description')); ?></textarea>
                    </div>
                    <p class="mt-2 text-sm text-slate-500">Provide details on what this activity involves.</p>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 shadow-sm">
                    Save Activity
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\activity tracker\resources\views/activities/create.blade.php ENDPATH**/ ?>