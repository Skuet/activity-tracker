<?php $__env->startSection('content'); ?>
<div class="min-h-[80vh] flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="px-8 py-8 sm:px-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Forgot Password</h2>
                <p class="mt-2 text-sm text-slate-500">Enter your email and we'll send you a reset link</p>
            </div>

            <?php if(session('status')): ?>
                <div class="mb-4 text-sm text-green-600 bg-green-50 p-3 rounded-lg"><?php echo e(session('status')); ?></div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.email')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                    <input id="email" name="email" type="email" required value="<?php echo e(old('email')); ?>"
                        class="mt-1 appearance-none block w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm">
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                    Send reset link
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500">
                <a href="<?php echo e(route('login')); ?>" class="font-medium text-indigo-600 hover:text-indigo-500">Back to sign in</a>
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\activity tracker\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>