<?php $__env->startSection('content'); ?>

<body>
    <form action="" method='post'>
        <h1>Domain</h1>
        <div >
        <input id="domain" nmame="domain" class="form-control" placeholder="Enter Domain name" ></input>
        <button class= "btn btn-primary" >Submit</button>
        </div>
    </form>
</body>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/career/domain.blade.php ENDPATH**/ ?>