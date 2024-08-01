<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Merchant pending event List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Merchant event</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Merchant event</h5>
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="mobile_no" placeholder="Mobile Number" class="form-control" value="<?php echo e(!empty($_GET['mobile_no']) ? $_GET['mobile_no'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    <?php if(!empty($_GET['sort'])): ?>
                                                        <option value="date" <?php if($_GET['sort'] == 'date'): ?> selected <?php endif; ?>>Latest Date</option>
                                                        <option value="amount" <?php if($_GET['sort'] == 'rate'): ?> selected <?php endif; ?>>Highest Rate</option>
                                                    <?php else: ?>
                                                        <option value="date">Latest Date</option>
                                                        <option value="rate">Highest Rate</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('sparrow.view')); ?>"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="<?php echo e(route('sparrowSMS.excel')); ?>"><strong>Excel</strong></button>
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
                        <h5>List of Merchant event</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Merchant pending event List">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Merchant</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>End Time</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Logo</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + ($events->perPage() * ($events->currentPage() - 1)) + 1); ?></td>
                                        <td>
                                            <?php echo e($event->merchant->name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($event->title); ?>

                                        </td>
                                        <td>
                                            <?php echo e($event->location); ?>

                                        </td>
                                        <td>
                                            <?php echo e($event->date); ?>

                                        </td>
                                        <td>
                                            <?php echo e($event->time); ?>

                                        </td>
                                        <td>
                                            <?php echo e($event->end_time); ?>

                                        </td>
                                        <td>
                                            <?php echo e($event->category); ?>

                                        </td>
                                        <td>
                                            <?php echo e($event->description); ?>

                                        </td>
                                        <td>
                                            <?php echo $__env->make('Merchant::merchantEvent.status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                        <td>
                                            <?php if(isset($event->image)): ?>
                                                <img style="width: 100%" src="<?php echo e(config('dpaisa-api-url.merchant_event_url') . $event->image); ?>" alt="">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(isset($event->logo)): ?>
                                                <img style="width: 100%" src="<?php echo e(config('dpaisa-api-url.merchant_event_url') . $event->logo); ?>" alt="">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a style="margin-top: 5px;" href="<?php echo e(route('merchant.event.detail', $event)); ?>" class="btn btn-sm btn-icon btn-primary m-t-n-xs" title="Event Details"><i class="fa fa-info"></i></a>
                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($events->appends(request()->query())->links()); ?>

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
    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Merchant/resources/views/merchantEvent/pendingList.blade.php ENDPATH**/ ?>