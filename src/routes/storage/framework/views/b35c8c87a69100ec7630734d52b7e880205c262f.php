<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Merchant Event</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant Event</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Edit Merchant Event</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form method="post" action="<?php echo e(route('merchant.event.detail', $event)); ?>" enctype="multipart/form-data"
              id="agentForm">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Select User</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="col-md-12">
                                <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Merchant</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($event->merchant->name); ?>" type="text" class="form-control"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($event->title); ?>" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($event->location); ?>" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($event->date); ?>" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Start Time</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($event->time); ?>" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">End Time</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($event->end_time); ?>" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($event->category); ?>" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea style="width: 100%" disabled><?php echo e($event->description); ?></textarea>
                                </div>
                            </div>


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Merchant Event Status</label>
                                <div class="col-sm-10">
                                    <select id="eventStatus" data-placeholder="Choose Status..." class="chosen-select"
                                            tabindex="2" name="status" required>
                                        <option value="" selected disabled>Status.</option>
                                        <option
                                            value="<?php echo e(\App\Models\Merchant\MerchantEvent::STATUS_ACCEPTED); ?>"
                                            <?php echo e(\App\Models\Merchant\MerchantEvent::STATUS_ACCEPTED == $event->status ? "selected" : ""); ?>

                                        >
                                            <?php echo e(\App\Models\Merchant\MerchantEvent::STATUS_ACCEPTED); ?>

                                        </option>

                                        <option
                                            value="<?php echo e(\App\Models\Merchant\MerchantEvent::STATUS_REJECTED); ?>"
                                            <?php echo e(\App\Models\Merchant\MerchantEvent::STATUS_REJECTED == $event->status ? "selected" : ""); ?>

                                        >
                                            <?php echo e(\App\Models\Merchant\MerchantEvent::STATUS_REJECTED); ?>

                                        </option>

                                        <option
                                            value="<?php echo e(\App\Models\Merchant\MerchantEvent::STATUS_PROCESSING); ?>"
                                            <?php echo e(\App\Models\Merchant\MerchantEvent::STATUS_PROCESSING == $event->status ? "selected" : ""); ?>

                                        >
                                            <?php echo e(\App\Models\Merchant\MerchantEvent::STATUS_PROCESSING); ?>

                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Event Image</label>
                                <div class="col-sm-10">
                                    <?php if(!empty($event->image)): ?>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="<?php echo e(config('dpaisa-api-url.merchant_event_url') . $event->image); ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Event Logo</label>
                                <div class="col-sm-10">
                                    <?php if(!empty($event->logo)): ?>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="<?php echo e(config('dpaisa-api-url.merchant_event_url') . $event->logo); ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="table-responsive">
                                <h2>Event Tickets</h2>
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Sparrow SMS List">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $event->merchantEventTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeX">
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td>
                                                <?php echo e($ticket->title); ?>

                                            </td>
                                            <td>
                                                Rs.<?php echo e($ticket->price); ?>

                                            </td>
                                            <td class="center">
                                                <?php echo e($ticket->description); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="hr-line-dashed"></div>


                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Edit Merchant
                                    Event</strong></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Event Discount</h5>
                        </div>
                        <div class="ibox-content">
                            <?php echo csrf_field(); ?>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Discount type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="type">
                                        <?php if(!empty($event->eventCashback)): ?>
                                            <option value="FLAT"
                                                    <?php if($event->eventCashback->cashback_type == 'FLAT'): ?> selected <?php endif; ?>>Flat
                                            </option>
                                            <option value="PERCENTAGE"
                                                    <?php if($event->eventCashback->cashback_type == 'PERCENTAGE'): ?> selected <?php endif; ?>>
                                                Percentage
                                            </option>
                                        <?php else: ?>
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">value</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($event->eventCashback->cashback_value ?? ''); ?>" name="value"
                                           type="number" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update Discount</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(asset('admin/css/plugins/summernote/summernote-bs4.css')); ?>" rel="stylesheet">

    <style>
        .note-editing-area{
            height: 150px;
        }
    </style>

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Merchant/resources/views/merchantEvent/eventDetail.blade.php ENDPATH**/ ?>