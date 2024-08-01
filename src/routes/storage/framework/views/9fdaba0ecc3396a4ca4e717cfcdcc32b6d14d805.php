<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Bonus Point</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Settings</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Bonus Point</h5>
                    </div>
                    <div class="ibox-content">
                        <h3>
                            <span class="font-bold">User Type:
                            </span> <?php if($walletTransactionType->user_type == \App\Models\User::class): ?>
                                User
                            <?php elseif($walletTransactionType->user_type == \App\Models\Merchant\Merchant::class): ?>
                                Merchant
                            <?php endif; ?>

                            | <span class="font-bold">Vendor: </span> <?php echo e($walletTransactionType->vendor); ?>

                            | <span
                                class="font-bold">Transaction Category: </span> <?php echo e($walletTransactionType->transaction_category); ?>

                            | <span class="font-bold">Service Type: </span> <?php echo e($walletTransactionType->service_type); ?>

                            <?php if(isset($walletTransactionType->service)): ?>
                                | <span class="font-bold">Service: </span> <?php echo e($walletTransactionType->service); ?></h3>
                        <?php endif; ?>

                        <div class="hr-line-dashed"></div>

                        <div class="alert alert-warning">
                            <i class="fa fa-info-circle"></i>
                            If a cash back for transaction having same <b>User Type</b>, <b>User Type Name</b>, <b>Slab
                                From</b> and
                            <b>Slab To</b> is created then the existing cashback will be updated using these new values
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add new bonus point</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="POST"
                              action="<?php echo e(route('walletBonus.store', $walletTransactionType->id)); ?>"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if(count($titleArray) > 0): ?>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <select data-placeholder="Choose Title..." class="chosen-select" tabindex="2"
                                                name="title" required>
                                            <option value="" selected disabled>-- Select Title --</option>
                                            <?php $__currentLoopData = $titleArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($title); ?>"><?php echo e($title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="title" type="text" class="form-control" required>
                                        <small>Cashback is sent to frontend using this title</small>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">User Type</label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="ChooseUser Type..."
                                            class="chosen-select" tabindex="2" name="user_type" required>
                                        <option value="" selected disabled>-- Select User Type --</option>
                                        <?php $__currentLoopData = $userTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $userType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($userType); ?>"><?php echo e($key); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">User Type Name</label>
                                <div class="col-sm-10">
                                    <select id="selectUserTypeName" data-placeholder="ChooseUser Type..."
                                            class="chosen-select" tabindex="2" name="user_type_id" required>
                                        <option value="" selected disabled>-- Select User Type Name--</option>
                                        
                                    </select>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Slab From</label>
                                <div class="col-sm-10">
                                    <input name="slab_from" type="number" min="0" step='0.1' class="form-control">
                                    <small>Amount in paisa</small>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Slab To</label>
                                <div class="col-sm-10">
                                    <input name="slab_to" type="number" min="0" step='0.1' class="form-control">
                                    <small>Amount in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Bonus Point Service (description)</label>
                                <div class="col-sm-10">
                                    <input name="description" type="text" class="form-control">
                                    <small>Empty for default</small>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Bonus Point Type</label>
                                <div class="col-sm-10">
                                    <select id="selectCashbackType" data-placeholder="Choose Bonus Point Type..."
                                            class="chosen-select" tabindex="2" name="bonus_point_type" required>
                                        <option value="" selected disabled>-- Select Bonus Point Type --</option>
                                        <option value="FLAT">FLAT</option>
                                        <option value="PERCENTAGE">PERCENTAGE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Bonus Point Value</label>
                                <div class="col-sm-10">
                                    <input name="bonus_point_value" type="number" min="0" step='0.1' class="form-control"
                                           required>
                                    <small>Flat amount in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.summernote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.summernote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $('#selectUserType').on('change', function (e) {
            let userType = $(this).val();

            let url = `<?php echo e(route('architecture.userType.list')); ?>`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {user_type: userType},
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#selectUserTypeName');
                    select.find('option').remove().end();

                    $.each(resp, function (key, value) {
                        let o = new Option(value.name, value.id, false, false);
                        select.append(o);
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    alert('error');
                    console.log(resp);
                    alert(resp);

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Architecture/resources/views/bonus/create.blade.php ENDPATH**/ ?>