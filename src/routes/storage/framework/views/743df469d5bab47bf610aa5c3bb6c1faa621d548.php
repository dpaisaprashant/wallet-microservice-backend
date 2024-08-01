'
<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Admin Altered Agents List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Admin Altered Agent List</strong>
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
                        <h5>Filter Admin Altered Agents List</h5>
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
                                            <label for="user_number">Admin Name</label>
                                            <input type="text" name="admin_name" placeholder="Enter Admin Name"
                                                   class="form-control"
                                                   value="<?php echo e(!empty($_GET['admin_name']) ? $_GET['admin_name'] : ''); ?>">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="user_number">Agent Number</label>
                                            <input type="number" name="agent_number" placeholder="Enter Agent Number"
                                                   class="form-control"
                                                   value="<?php echo e(!empty($_GET['agent_number']) ? $_GET['agent_number'] : ''); ?>">
                                        </div>

                                        <div class="col-md-4">
                                                <label for="service_type" style="padding-top: 5px">Admin Action</label>
                                                <select data-placeholder="Select Admin Action" class="chosen-select"
                                                        tabindex="2" name="admin_action">
                                                    <option value="" selected disabled>Select Admin Action ...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['admin_action'])): ?>
                                                        <?php if($_GET['admin_action']  == 'Created'): ?>
                                                            <option value="Created" selected >Created</option>
                                                            <option value="Updated">Updated</option>

                                                        <?php else: ?>
                                                            <option value="Updated" selected >Updated</option>
                                                            <option value="Created">Created</option>

                                                        <?php endif; ?>

                                                    <?php else: ?>
                                                        <option value="Created">Created</option>
                                                        <option value="Updated">Updated</option>
                                                    <?php endif; ?>
                                                </select>
                                        </div>


                                        <div class="col-md-4" style="padding-top: 30px">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-top: 30px">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="<?php echo e(route('agent.AdminAlteredAgents')); ?>"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="<?php echo e(route('admin-altered.agent.excel')); ?>"><strong>Excel</strong></button>
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
                    <div class="ibox-title">
                        <h5>List of Admin Updated/Created KYC</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Wallet Service List">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Admin</th>
                                    <th>Agent</th>
                                    <th>Admin Action</th>
                                    <th>Agent Before</th>
                                    <th>Agent After</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $adminAlteredAgents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adminAlteredAgent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + ($adminAlteredAgents->perPage() * ($adminAlteredAgents->currentPage() - 1)) + 1); ?></td>
                                        <td>
                                            &nbsp;<?php echo e($adminAlteredAgent->admin->name); ?>

                                        </td>
                                        <td><?php echo e(optional(optional($adminAlteredAgent->agent)->user)->mobile_no); ?></td>
                                        <td>
                                            <?php
                                            $response = json_decode($adminAlteredAgent->agent_before)
                                            ?>
                                            <?php if($response == null): ?>
                                                Created
                                            <?php else: ?>
                                                Updated
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $__env->make('admin.agent.AdminAlteredAgentJsonDecode', ['adminAlteredAgent' => $adminAlteredAgent,'type'=>"before_change"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                                        <td><?php echo $__env->make('admin.agent.AdminAlteredAgentJsonDecode', ['adminAlteredAgent' => $adminAlteredAgent,'type'=>"after_change"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                                        <td><?php echo e($adminAlteredAgent->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                            <?php echo e($adminAlteredAgents->appends(request()->query())->links()); ?>

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

    <?php echo $__env->make('admin.asset.css.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Wallet service will be deleted'",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete service",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($adminAlteredAgents->firstItem()); ?> to <?php echo e($adminAlteredAgents->lastItem()); ?> of <?php echo e($adminAlteredAgents->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/agent/AdminAlteredAgent.blade.php ENDPATH**/ ?>