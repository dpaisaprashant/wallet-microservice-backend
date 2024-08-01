<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Agents</h5>
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
                                <form role="form" method="get">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter Agent Name"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['name']) ? $_GET['name'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="agent_number_email" placeholder="Enter Agent Number or Email"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['agent_number_email']) ? $_GET['agent_number_email'] : ''); ?>">
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <input type="text" name="parent_agent" placeholder="Enter Parent Agent Name"
                                                   class="form-control"
                                                   value="<?php echo e(!empty($_GET['parent_agent']) ? $_GET['parent_agent'] : ''); ?>">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="parent_agent_number_email" placeholder="Enter Parent-Agent Number or Email"
                                                   class="form-control"
                                                   value="<?php echo e(!empty($_GET['parent_agent_number_email']) ? $_GET['parent_agent_number_email'] : ''); ?>">
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from_agent_created_at" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-4" style="padding-bottom: 15px; padding-top: 15px; ">
                                            <select name="agent_status" class="form-control">
                                                <option value="" disabled selected>--- Filter by Agent Status ---</option>
                                                <?php $__currentLoopData = $agentStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!empty($_GET['agent_status'])): ?>
                                                        <?php if($_GET['agent_status'] == $agent_status->status): ?>
                                                            <option value="<?php echo e($agent_status->status); ?>" selected><?php echo e($agent_status->status); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($agent_status->status); ?>"><?php echo e($agent_status->status); ?></option>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <option value="<?php echo e($agent_status->status); ?>"><?php echo e($agent_status->status); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4" style="padding-bottom: 15px; padding-top: 15px; ">
                                            <select name="agent_balance" class="form-control">
                                                <option value="" disabled selected>--- Filter by Wallet Balance---</option>

                                                    <?php if(!empty($_GET['agent_balance'])): ?>
                                                        <?php if($_GET['agent_balance'] == "descending"): ?>
                                                            <option value="descending" selected>High-To-Low</option>
                                                            <option value="ascending">Low-To-High</option>
                                                        <?php else: ?>
                                                            <option value="ascending" selected>Low-To-High</option>
                                                            <option value="descending">High-To-Low</option>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <option value="descending">High-To-Low</option>
                                                        <option value="ascending">Low-To-High</option>
                                                    <?php endif; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <br>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="<?php echo e(route('agent.view')); ?>"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="<?php echo e(route('agent-page.excel')); ?>"><strong>Excel</strong></button>
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
                        <h5>List of registered users</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Wallet user's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Agent</th>
                                    <th>Agent Type</th>
                                    <th>Parent Agent</th>
                                    <th>Contact Number</th>
                                    <th>Institution Type</th>
                                    <th>Business Name</th>
                                    <th>Business PAN</th>
                                    
                                    
                                    
                                    <th>Agent status</th>
                                    <th>Reference Code</th>
                                    
                                    <th>Use parent agent balance</th>
                                    <th>Agent Created At</th>
                                    
                                    
                                  
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + ($users->perPage() * ($users->currentPage() - 1)) + 1); ?></td>
                                        <td>
                                            
                                            <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $user->id)); ?>" <?php endif; ?>><?php echo e($user->name); ?>

                                                <br>
                                                <?php echo e($user->email); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <?php echo e(ucwords(strtolower(optional(optional($user->agent)->agentType)->name))); ?>

                                        </td>
                                        <td>
                                            <b>Name: </b> <?php echo e(optional(optional($user->agent)->codeUsed)->name ?? ""); ?>

                                            <br>
                                            <b>Email: </b> <?php echo e(optional(optional($user->agent)->codeUsed)->email ?? ""); ?>

                                            <br>
                                            <b>Number: </b> <?php echo e(optional(optional($user->agent)->codeUsed)->mobile_no ?? ""); ?>


                                        </td>
                                        <td>
                                            <?php if(!empty($user->phone_verified_at)): ?>
                                                <i class="fa fa-check-circle" style="color: green;"></i>
                                                &nbsp;<?php echo e($user->mobile_no); ?>

                                            <?php else: ?>
                                                <i class="fa fa-times-circle" style="color: red;"></i>
                                                &nbsp;<?php echo e($user->mobile_no); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($user->agent->institution_type ?? ""); ?></td>
                                        <td>
                                            <?php echo e($user->agent->business_name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($user->agent->business_pan); ?>

                                        </td>
                                        
                                        
                                        <td>
                                            <?php echo $__env->make('admin.agent.status', ['agent' => $user->agent], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                        <td>
                                            <?php echo e($user->agent->reference_code); ?>

                                        </td>
                                        
                                        <td>
                                            <?php if($user->agent->use_parent_balance == 1): ?>
                                                <span class="badge badge-danger">Use parent <br>agent's balance</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Use own balance</span>
                                            <?php endif; ?>
                                        </td>



                                        

                                        
                                        <td><?php echo e(\Carbon\Carbon::parse($user->agent->created_at)->format('F d Y')); ?></td>

                                        <td class="center">
                                            <?php if(auth()->user()->hasAnyPermission(['User profile','View agent profile'])): ?>
                                                    <a style="margin-top: 5px;"
                                                       href="<?php echo e(route('user.profile', $user->id)); ?>"
                                                       class="btn btn-sm btn-icon btn-primary m-t-n-xs"
                                                       title="user profile"><i class="fa fa-eye"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User transactions')): ?>
                                                <a style="margin-top: 5px;"
                                                   href="<?php echo e(route('user.transaction', $user->id)); ?>"
                                                   class="btn btn-sm btn-icon btn-info m-t-n-xs"
                                                   title="user transactions"><i class="fa fa-credit-card"></i></a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Agent edit')): ?>
                                                <a style="margin-top: 5px;" href="<?php echo e(route('agent.edit', $user->agent->id)); ?>"
                                                   class="btn btn-sm btn-icon btn-success m-t-n-xs" title="Edit Agent"><i
                                                        class="fa fa-edit"></i></a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Agent delete')): ?>
                                                <form action="<?php echo e(route('agent.delete', $user->id)); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <button style="margin-top: 5px;"
                                                            class="reset btn btn-sm btn-icon btn-danger m-t-n-xs"
                                                            rel="<?php echo e($user->id); ?>"><i class="fa fa-trash"></i></button>
                                                    <button id="resetBtn-<?php echo e($user->id); ?>" style="display: none"
                                                            type="submit"><strong>Reset Password</strong></button>
                                                </form>
                                            <?php endif; ?>

                                                <a style="margin-top: 5px;" target="_blank"
                                                   href="<?php echo e(route('user.download.qr',$user->id)); ?>"
                                                   class="btn btn-sm btn-icon btn-secondary m-t-n-xs"
                                                   title="download qr"><i class="fa fa-qrcode"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($users->appends(request()->query())->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>


    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function (e) {

            let a = "Showing <?php echo e($users->firstItem()); ?> to <?php echo e($users->lastItem()); ?> of <?php echo e($users->total()); ?> entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        let walletAmount = <?php if(!empty($_GET['wallet_balance'])): ?> `<?php echo e($_GET['wallet_balance']); ?>`;
        <?php else: ?> '0;100000'; <?php endif; ?>
        let split = walletAmount.split(';');


        $(".ionrange_wallet_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = <?php if(!empty($_GET['transaction_payment'])): ?> `<?php echo e($_GET['transaction_payment']); ?>`;
        <?php else: ?> '0;100000';
        <?php endif; ?>
            split = walletAmount.split(';');

        $(".ionrange_payment_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = <?php if(!empty($_GET['transaction_loaded'])): ?> `<?php echo e($_GET['transaction_loaded']); ?>`;
        <?php else: ?> '0;100000';
        <?php endif; ?>
            split = walletAmount.split(';');

        $(".ionrange_loaded_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });


        walletAmount = <?php if(!empty($_GET['transaction_number'])): ?> `<?php echo e($_GET['transaction_number']); ?>`;
        <?php else: ?> '0;1000';
        <?php endif; ?>
            split = walletAmount.split(';');

        $(".ionrange_number").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: split[0],
            to: split[1],
        });


    </script>

    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "This user will be removed from agent",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, remove",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/agent/view.blade.php ENDPATH**/ ?>