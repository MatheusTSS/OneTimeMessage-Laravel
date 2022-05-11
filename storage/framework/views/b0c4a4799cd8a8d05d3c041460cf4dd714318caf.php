<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(config('app.name')); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/bootstrap/app.css')); ?>">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center my-5"><?php echo e(config('app.name')); ?></h1>
                <?php echo $__env->yieldContent('content'); ?>
                <div class="text-center my-5">
                        <small>Created by Matheus Santos &copy; <?php echo e(date('Y')); ?></small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\OneTimeMessage\resources\views/layouts/app_layout.blade.php ENDPATH**/ ?>