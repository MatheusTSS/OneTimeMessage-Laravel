<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <form action="<?php echo e(route('main_init')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label>From:</label>
                    <input type="email" name="text_from" class="form-control" value="<?php echo e(old('text_from')); ?>">
                </div>
                <br>
                <div class="form-group">
                    <label>To:</label>
                    <input type="email" name="text_to" class="form-control" value="<?php echo e(old('text_to')); ?>">
                </div>
                <br>
                <div class="form-group">
                    <label>Message:</label>
                    <textarea name="text_message" rows="5" class="form-control" value="<?php echo e(old('text_message')); ?>"></textarea>
                </div>
                <br>
                <div class="text-center">
                    <input type="submit" value="Send One Time Message" class="btn btn-primary">
                </div>
            </form>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger p-2 my-3">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\OneTimeMessage\resources\views/message_form.blade.php ENDPATH**/ ?>