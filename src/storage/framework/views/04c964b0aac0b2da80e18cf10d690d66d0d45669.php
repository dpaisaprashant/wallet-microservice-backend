
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DPaisa | Login </title>

    <link href="<?php echo e(asset('admin/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('admin/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/css/style.css')); ?>" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="col-md-6">
            <h2 class="font-bold">Welcome to DPaisa</h2>

            <p>Admin panel of DPaisa </p>

        </div>
        <div class="col-md-6">

            <div class="ibox-content">
                <form class="m-t" role="form" action="<?php echo e(route('admin.login')); ?>" method="post" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required="" value="<?php echo e(old('email')); ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                </form>
                <p class="m-t">
                    <small>DPaisa admin panel all rights reserved &copy; <?php echo e(Date('Y')); ?></small>
                </p>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Copyright Goldmine Pvt. Ltd.
        </div>
        <div class="col-md-6 text-right">
            <small>© <?php echo e(Date('Y')); ?></small>
        </div>
    </div>
</div>


</body>
<script src="<?php echo e(asset('admin/js/jquery-3.1.1.min.js')); ?> " ></script>
<script>
    $('.close').on('click', function (e) {
        $('.alert-danger').hide();
    });
</script>

</html>
<?php /**PATH /var/www/html/resources/views/admin/login.blade.php ENDPATH**/ ?>