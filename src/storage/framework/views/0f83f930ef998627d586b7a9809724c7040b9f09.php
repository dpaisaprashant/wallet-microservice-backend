<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Pre Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Pre-Transactions</strong>
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
                                <form role="form" method="get">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="user_number">User Number</label>
                                            <input type="number" name="user_number" placeholder="Enter User Number"
                                                   class="form-control"
                                                   value="<?php echo e(!empty($_GET['user_number']) ? $_GET['user_number'] : ''); ?>">
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pre_transaction_id">Enter Pre-Transaction ID</label>
                                                <input type="text" name="pre_transaction_id"
                                                       placeholder="Enter Pre Transaction ID"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : ''); ?>">
                                            </div>
                                        </div>


                                        
                                        
                                        
                                        
                                        


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="service_type">Service Type</label>
                                                <select data-placeholder="Select Service Type" class="chosen-select"
                                                        tabindex="2" name="service_type">
                                                    <option value="" selected disabled>Select Service Type...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['service_type'])): ?>

                                                        <?php $__currentLoopData = $service_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($service_type); ?>"
                                                                    <?php if($_GET['service_type']  == $service_type): ?> selected <?php endif; ?> ><?php echo e($service_type); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $service_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($service_type); ?>"><?php echo e($service_type); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="microservice_type">Micro Service Type</label>
                                                <select data-placeholder="Select MicroService Type"
                                                        class="chosen-select"
                                                        tabindex="2" name="microservice_type">
                                                    <option value="" selected disabled>Select Micro-Service Type...
                                                    </option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['microservice_type'])): ?>

                                                        <?php $__currentLoopData = $microservice_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $microservice_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($microservice_type); ?>"
                                                                    <?php if($_GET['microservice_type']  == $microservice_type): ?> selected <?php endif; ?> ><?php echo e($microservice_type); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $microservice_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $microservice_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($microservice_type); ?>"><?php echo e($microservice_type); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="transaction_type">Transaction Type</label>
                                                <select data-placeholder="Select Transaction Type" class="chosen-select"
                                                        tabindex="2" name="transaction_type">
                                                    <option value="" selected disabled>Select Transaction Type...
                                                    </option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['transaction_type'])): ?>

                                                        <?php $__currentLoopData = $transaction_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($transaction_type); ?>"
                                                                    <?php if($_GET['transaction_type']  == $transaction_type): ?> selected <?php endif; ?> ><?php echo e($transaction_type); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $transaction_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($transaction_type); ?>"><?php echo e($transaction_type); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="vendor">Vendor</label>
                                                <select data-placeholder="Select Vendor...." class="chosen-select"
                                                        tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['vendor'])): ?>

                                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($vendor); ?>"
                                                                    <?php if($_GET['vendor']  == $vendor): ?> selected <?php endif; ?> ><?php echo e($vendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($vendor); ?>"><?php echo e($vendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-4" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-bottom: 15px;">
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
                                                <select data-placeholder="Select Pre-Transaction status..."
                                                        class="chosen-select" tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status:</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['status'])): ?>
                                                        <option value="SUCCESS"
                                                                <?php if($_GET['status']  == 'SUCCESS'): ?> selected <?php endif; ?> >
                                                            SUCCESS
                                                        </option>
                                                        <option value="FAILED"
                                                                <?php if($_GET['status'] == 'FAILED'): ?> selected <?php endif; ?>>
                                                            FAILED
                                                        </option>
                                                        <option value=""
                                                                <?php if($_GET['status'] == "NULL"): ?> selected <?php endif; ?>>
                                                            NULL
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="SUCCESS">SUCCESS</option>
                                                        <option value="FAILED">FAILED</option>
                                                        <option value="NULL">NULL</option>

                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="transaction_number">Pre Transaction Amount</label>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Pre-Transaction Amount"
                                                               name="from_preTransaction_amount" autocomplete="off"
                                                               value="<?php echo e(!empty($_GET['from_preTransaction_amount']) ? $_GET['from_preTransaction_amount'] : ''); ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Pre-Transaction Amount"
                                                               name="to_preTransaction_amount" autocomplete="off"
                                                               value="<?php echo e(!empty($_GET['to_preTransaction_amount']) ? $_GET['to_preTransaction_amount'] : ''); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>


                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="<?php echo e(route('preTransaction.view')); ?>"><strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="<?php echo e(route('preTransaction.excel')); ?>"><strong>Excel</strong>
                                        </button>
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
                    <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Pre Transaction list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User Number</th>
                                    <th>Pre Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Vendor</th>
                                    <th>Service type</th>
                                    <th>Micro Service Type</th>
                                    <th>Transaction Type</th>
                                    <th>URL</th>
                                    <th>Before Balance</th>
                                    <th>After Balance</th>
                                    <th>Before Bonus Balance</th>
                                    <th>After Balance Bonus</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                    <th>Device Info</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $preTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preTransaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeC">
                                        <td><?php echo e($loop->index + ($preTransactions->perPage() * ($preTransactions->currentPage() - 1)) + 1); ?></td>
                                        <td>
                                            <?php if(empty($preTransaction->user)): ?>
                                                <?php echo e(optional($preTransaction->user)->mobile_no); ?>

                                            <?php else: ?>
                                                <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $preTransaction->user->id)); ?>" <?php endif; ?>><?php echo e($preTransaction->user->mobile_no); ?></a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($preTransaction->pre_transaction_id); ?></td>
                                        <td>Rs. <?php echo e($preTransaction->amount); ?></td>
                                        <td><?php echo e($preTransaction->description); ?></td>
                                        <td>
                                            <?php echo e($preTransaction->vendor); ?>

                                        </td>
                                        <td>
                                            <?php echo e($preTransaction->service_type); ?>

                                        </td>
                                        <td><?php echo e($preTransaction->microservice_type); ?></td>
                                        <td><?php echo e($preTransaction->transaction_type); ?></td>
                                        <td><?php echo e($preTransaction->url); ?></td>
                                        <td><?php echo e($preTransaction->before_balance); ?></td>
                                        <td><?php echo e($preTransaction->after_balance); ?></td>
                                        <td><?php echo e($preTransaction->before_bonus_balance); ?></td>
                                        <td><?php echo e($preTransaction->after_bonus_balance); ?></td>
                                        <td><?php echo e($preTransaction->created_at); ?></td>

                                        <td>
                                            <?php if($preTransaction->status=="FAILED"): ?>
                                                <span class="badge badge-danger"><?php echo e($preTransaction->status); ?></span>
                                            <?php elseif($preTransaction->status=="SUCCESS"): ?>
                                                <span class="badge badge-primary"><?php echo e($preTransaction->status); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">Null</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $__env->make('Microservice::preTransactions.preTransactionJsonRequest', ['preTransaction' => $preTransaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('Microservice::preTransactions.preTransactionJsonResponse', ['preTransaction' => $preTransaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('Microservice::preTransactions.preTransactionRequestParameter', ['preTransaction' => $preTransaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('Microservice::preTransactions.preTransactionSpecials', ['preTransaction' => $preTransaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                        </td>
                                        <td>
                                            <?php echo $__env->make('Microservice::preTransactions.preTransactionDeviceInfo', ['preTransaction' => $preTransaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($preTransactions->appends(request()->query())->links()); ?>

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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <script>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($preTransactions->firstItem()); ?> to <?php echo e($preTransactions->lastItem()); ?> of <?php echo e($preTransactions->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
    </script>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Microservice/resources/views/preTransactions/preTransactionView.blade.php ENDPATH**/ ?>