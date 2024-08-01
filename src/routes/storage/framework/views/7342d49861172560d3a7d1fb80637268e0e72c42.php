<?php $__env->startSection('content'); ?>



    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>KYC List</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Users</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content"
                         <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none" <?php endif; ?>>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="<?php echo e(route('backendUser.kycList')); ?>">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter User Name"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['name']) ? $_GET['name'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <input type="text" name="number" placeholder="Enter Contact Number"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['number']) ? $_GET['number'] : ''); ?>">
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <input type="email" name="email" placeholder="Enter Email"
                                                   class="form-control"
                                                   value="<?php echo e(!empty($_GET['email']) ? $_GET['email'] : ''); ?>">
                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="change_status">
                                                    <option value="" selected disabled>Select Status...</option>

                                                    <?php if(!empty($_GET['change_status'])): ?>
                                                        <option value="all"
                                                                <?php if($_GET['change_status'] == 'all'): ?> selected <?php endif; ?>>
                                                            All
                                                        </option>
                                                        <option value="accepted"
                                                                <?php if($_GET['change_status']  == 'accepted'): ?> selected <?php endif; ?> >
                                                            Accepted
                                                        </option>
                                                        <option value="rejected"
                                                                <?php if($_GET['change_status'] == 'rejected'): ?> selected <?php endif; ?>>
                                                            Rejected
                                                        </option>
                                                        <option value="notverified"
                                                                <?php if($_GET['change_status'] == 'notverified'): ?> selected <?php endif; ?>>
                                                            Not verified
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="all">All</option>
                                                        <option value="accepted">Accepted</option>
                                                        <option value="rejected">Rejected</option>
                                                        <option value="notverified">Not verified</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <div class="input-group date">

                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Choose User Type..." class="chosen-select"  tabindex="2" name="user_type">
                                                    <option value="" selected disabled>Sort By User Type</option>
                                                    <option value="" selected>All</option>
                                                    <?php if(!empty($_GET['user_type'])): ?>
                                                        <?php if($_GET['user_type'] == "normal_user"): ?>
                                                            <option value="normal_user" selected>Normal user</option>
                                                            <option value="agent">Agent</option>
                                                            <option value="merchant">Merchant</option>
                                                        <?php elseif($_GET['user_type'] == "agent"): ?>
                                                            <option value="normal_user">Normal user</option>
                                                            <option value="agent" selected>Agent</option>
                                                            <option value="merchant">Merchant</option>
                                                        <?php elseif($_GET['user_type'] == 'merchant'): ?>
                                                            <option value="normal_user">Normal user</option>
                                                            <option value="agent">Agent</option>
                                                            <option value="merchant" selected>Merchant</option>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <option value="normal_user">Normal user</option>
                                                        <option value="agent">Agent</option>
                                                        <option value="merchant">Merchant</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
                                            <strong>Filter</strong></button>
                                    </div>
                                    <?php echo $__env->make('admin.asset.components.clearFilterButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of users kyc</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Backend user changed KYC list - <?php echo e(auth()->user()->email); ?>">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>KYC status</th>
                                    <th>User type</th>
                                    <th>Status changed on</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kyc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index +  1); ?></td>
                                        <td>
                                            <?php echo e($kyc->first_name . ' '. $kyc->last_name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($kyc->user->mobile_no); ?>

                                        </td>
                                        <td>
                                            <?php echo e($kyc->user->email); ?>

                                        </td>
                                        <td>
                                            
                                            <?php echo $__env->make('admin.user.kyc.status', ['kyc' => $kyc], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                        <td>
                                           <?php echo $__env->make('admin.user.userType.displayUserTypes',['user' => $kyc->user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>

                                        <td>
                                            
                                            <?php echo e($kyc->updated_at); ?>

                                        </td>

                                        <td class="center">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User KYC view')): ?>
                                                <a href="<?php echo e(route('user.kyc', $kyc->user_id)); ?>"
                                                   class="btn btn-sm btn-primary m-t-n-xs"><strong>KYC</strong></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($lists->appends(request()->query())->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/backendUser/kycList.blade.php ENDPATH**/ ?>