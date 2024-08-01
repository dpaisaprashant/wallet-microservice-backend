<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Fund Request</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Fund Request</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Fund Request</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none"  <?php endif; ?>>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="from_user" placeholder="From User Email or Number" class="form-control" value="<?php echo e(!empty($_GET['from_user']) ? $_GET['from_user'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="to_user" placeholder="To User Email or Number" class="form-control" value="<?php echo e(!empty($_GET['to_user']) ? $_GET['to_user'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                        <option value="" selected disabled>Sort By...</option>
                                                        <?php if(!empty($_GET['sort'])): ?>
                                                            <option value="request_date" <?php if($_GET['sort'] == 'request_date'): ?> selected <?php endif; ?>>Request Date</option>
                                                            <option value="response_date" <?php if($_GET['sort'] == 'response_date'): ?> selected <?php endif; ?>>Latest Date</option>
                                                            <option value="amount" <?php if($_GET['sort'] == 'amount'): ?> selected <?php endif; ?>>Highest amount</option>
                                                        <?php else: ?>
                                                            <option value="request_date">Request Date</option>
                                                            <option value="response_date">Response Date</option>
                                                            <option value="amount">Amount</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-md-3" style="padding-top: 15px;">
                                            <label for="request_status">Request Status</label>
                                            <div class="form-group">
                                                <select name="request_status" data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                    <option value="" selected disabled>Select Request Status...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['request_status'])): ?>
                                                        <option value="successful" <?php if($_GET['request_status']  == 'successful'): ?> selected <?php endif; ?>>Successful</option>
                                                        <option value="failed" <?php if($_GET['request_status']  == 'failed'): ?> selected <?php endif; ?>>Failed</option>
                                                    <?php else: ?>
                                                        <option value="successful">Successful</option>
                                                        <option value="failed">Failed</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding-top: 15px;">
                                            <label for="response_status">Response Status</label>
                                            <div class="form-group">
                                                <select name="response_status" data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                    <option value="" selected disabled>Select Response Status...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['response_status'])): ?>
                                                        <option value="accepted" <?php if($_GET['response_status']  == 'accepted'): ?> selected <?php endif; ?>>Accepted</option>
                                                        <option value="rejected" <?php if($_GET['response_status']  == 'rejected'): ?> selected <?php endif; ?>>Rejected</option>
                                                        <option value="pending" <?php if($_GET['response_status']  == 'pending'): ?> selected <?php endif; ?>>Pending</option>
                                                    <?php else: ?>
                                                        <option value="accepted">Accepted</option>
                                                        <option value="rejected">Rejected</option>
                                                        <option value="pending">Pending</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_amount">Amount</label>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control" placeholder="From Amount" name="from_amount" autocomplete="off" value="<?php echo e(!empty($_GET['from_amount']) ? $_GET['from_amount'] : ''); ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control" placeholder="To Amount" name="to_amount" autocomplete="off" value="<?php echo e(!empty($_GET['to_amount']) ? $_GET['to_amount'] : ''); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <label for="request_date_load_from">Request Date From</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                 <i class="fa fa-calendar"></i>
                                             </span>
                                                <input id="request_date_load_from" type="text" class="form-control request_date_from" placeholder="From" name="request_from" autocomplete="off" value="<?php echo e(!empty($_GET['request_from']) ? $_GET['request_from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <label for="request_date_load_to">Request Date To</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                     <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="request_date_load_to" type="text" class="form-control request_date_to" placeholder="To" name="request_to" autocomplete="off" value="<?php echo e(!empty($_GET['request_to']) ? $_GET['request_to'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <label for="response_date_load_from">Response Date From</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="response_date_load_from" type="text" class="form-control response_date_from" placeholder="From" name="response_from" autocomplete="off" value="<?php echo e(!empty($_GET['response_from']) ? $_GET['response_from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <label for="response_date_load_to">Response Date To</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="response_date_load_to" type="text" class="form-control response_date_to" placeholder="To" name="response_to" autocomplete="off" value="<?php echo e(!empty($_GET['response_to']) ? $_GET['response_to'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('fundRequest')); ?>"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="<?php echo e(route('fundRequest.excel')); ?>"><strong>Excel</strong></button>
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
                        <h5>List of fund requests</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Fund Request transaction list">
                                <thead>
                                <tr>
                                    <th>s.No.</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Amount</th>
                                    <th>Commission</th>
                                    <th>Request Status</th>
                                    <th>Respond Status</th>
                                    <th>Request Date</th>
                                    <th>Response Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $fundRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fundRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeC">
                                    <td><?php echo e($loop->index + ($fundRequests->perPage() * ($fundRequests->currentPage() - 1)) + 1); ?></td>
                                    <td>
                                        <a  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $fundRequest->from_user)); ?>" <?php endif; ?>><?php echo e($fundRequest->fromUser['mobile_no']); ?></a>
                                    </td>
                                    <td>
                                        <a  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $fundRequest->to_user)); ?>" <?php endif; ?>><?php echo e($fundRequest->toUser['mobile_no']); ?></a>
                                    </td>
                                    <td class="center">Rs.<?php echo e($fundRequest->amount); ?></td>
                                    <td class="center">Rs.<?php echo e(optional($fundRequest->commission)['before_amount'] - optional($fundRequest->commission)['after_amount']); ?></td>

                                    <td>
                                        <?php echo $__env->make('admin.transaction.fundRequest.requestStatus', ['transaction' => $fundRequest], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </td>

                                    <td>
                                        <?php echo $__env->make('admin.transaction.fundRequest.responseStatus', ['transaction' => $fundRequest], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </td>
                                    <td class="center">
                                        <?php echo e($fundRequest->created_at); ?>

                                    </td>
                                    <td class="center">
                                        <?php if(!is_null($fundRequest->response)): ?>
                                            <?php echo e($fundRequest->updated_at); ?>

                                        <?php endif; ?>
                                    </td>
                                     <td>
                                        <?php echo $__env->make('admin.transaction.fundRequest.detail', ['transaction' => $fundRequest], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fund request detail')): ?>
                                             <a href="<?php echo e(route('fundRequest.detail', $fundRequest->id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
                                         <?php endif; ?>
                                     </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                            <?php echo e($fundRequests->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

   <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Date picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(".request_date_from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });
    </script>

    <script>
        $(".request_date_from").change(function () {
            var start_date = $(this).val();

            $(".request_date_to").val('');
            $(".request_date_to").removeAttr('readonly');
            $(".request_date_to").datepicker('destroy');
            $(".request_date_to").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate:new Date(start_date),
                format: 'dd M, yyyy'
            });
        });

        $(".request_date_to").keyup(function () {
            $(this).val('');
        });
    </script>

    <script>
        $(".response_date_from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });

    </script>

    <script>
        $(".response_date_from").change(function () {
            var start_date = $(this).val();

            $(".response_date_to").val('');
            $(".response_date_to").removeAttr('readonly');
            $(".response_date_to").datepicker('destroy');
            $(".response_date_to").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate:new Date(start_date),
                format: 'dd M, yyyy'
            });
        });

        $(".response_date_to").keyup(function () {
            $(this).val('');
        });
    </script>
   <!-- End Date picker -->

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($fundRequests->firstItem()); ?> to <?php echo e($fundRequests->lastItem()); ?> of <?php echo e($fundRequests->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = <?php if(!empty($_GET['amount'])): ?> `<?php echo e($_GET['amount']); ?>`; <?php else: ?> '0;100000'; <?php endif; ?>
        let split = amount.split(';');
        $(".ionrange_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/transaction/fundRequest.blade.php ENDPATH**/ ?>