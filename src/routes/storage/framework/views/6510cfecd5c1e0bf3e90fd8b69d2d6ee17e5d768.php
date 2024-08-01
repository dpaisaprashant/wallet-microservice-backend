<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Agent</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Agent</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
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
                        <form method="post" action="<?php echo e(route('agent.create')); ?>" enctype="multipart/form-data" id="transactionIdForm">
                            <?php echo csrf_field(); ?>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Mobile No. <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <select id="selectTransaction" data-placeholder="Choose Mobile No..." class="chosen-select"  tabindex="2" name="user_id" required>
                                        <option value="" selected disabled>--- Select Mobile No. ---</option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>" ><?php echo e($user->name . ' - ' . $user->mobile_no); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Business PAN <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <input name="business_pan" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Business Name <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <input name="business_name" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Parent Agent</label>
                                <div class="col-sm-10">
                                    <select id="agentStatus" data-placeholder="Choose Agent Type..." class="chosen-select"  tabindex="2" name="code_used_id">
                                        <option value=""  disabled>Select Parent Agent</option>
                                        <option value="" selected>--- No parent Agent ---</option>
                                    <?php $__currentLoopData = $parentAgents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentAgent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($parentAgent->user->id); ?>">
                                                <?php echo e(ucwords(strtolower($parentAgent->user->name))); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Type <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <select id="agentStatus" data-placeholder="Choose Agent Type..." class="chosen-select"  tabindex="2" name="agent_type_id" required>
                                        <option value="" selected disabled>--- Select Agent Type ---</option>
                                        <?php $__currentLoopData = $agentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>">
                                                <?php echo e(ucwords(strtolower($type->name))); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Status <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <select id="agentStatus" data-placeholder="Choose Status..." class="chosen-select"
                                            tabindex="2" name="status" required>
                                        <option value="" selected disabled>--- Select Agent Status ---</option>
                                        <option
                                            value="<?php echo e(\App\Models\Agent::STATUS_ACCEPTED); ?>"
                                        >
                                            <?php echo e(\App\Models\Agent::STATUS_ACCEPTED); ?>

                                        </option>

                                        <option
                                            value="<?php echo e(\App\Models\Agent::STATUS_REJECTED); ?>"
                                        >
                                            <?php echo e(\App\Models\Agent::STATUS_REJECTED); ?>

                                        </option>

                                        <option
                                            value="<?php echo e(\App\Models\Agent::STATUS_PROCESSING); ?>"
                                        >
                                            <?php echo e(\App\Models\Agent::STATUS_PROCESSING); ?>

                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Institution Type <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Choose Mobile No..." class="chosen-select"  tabindex="2" name="institution_type" required>
                                        <option value="" selected disabled>--- Select Institution Type ---</option>
                                            <option value="<?php echo e(\App\Models\Agent::INSTITUTION_TYPE_COMPANY); ?>" ><?php echo e(\App\Models\Agent::INSTITUTION_TYPE_COMPANY); ?></option>
                                            <option value="<?php echo e(\App\Models\Agent::INSTITUTION_TYPE_INDIVIDUAL); ?>" ><?php echo e(\App\Models\Agent::INSTITUTION_TYPE_INDIVIDUAL); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Business Owner Citizenship Front <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <input name="business_owner_citizenship_front"  type="file" class="custom-file-input" required>
                                    <label for="business_owner_citizenship_front" class="custom-file-label">Upload Citizenship Front Image...</label>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Business Owner Citizenship Back <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <input name="business_owner_citizenship_back"  type="file" class="custom-file-input" required>
                                    <label for="business_owner_citizenship_back" class="custom-file-label">Upload Citizenship Back Image...</label>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Business Document Image</label>
                                <div class="col-sm-10">
                                    <input name="business_document"  type="file" class="custom-file-input">
                                    <label for="business_document" class="custom-file-label">Upload Business Document Image Image...</label>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Passport Size Photo <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <input name="pp_photo"  type="file" class="custom-file-input" required>
                                    <label for="pp_photo" class="custom-file-label">Upload Passport Size Image...</label>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tax Clearance Certificate <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <input name="tax_clearance_certificate"  type="file" class="custom-file-input" required>
                                    <label for="tax_clearance_certificate" class="custom-file-label">Upload Tax Clearance Certificate...</label>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Pan/Vat Document <small>(required)</small></label>
                                <div class="col-sm-10">
                                    <input name="pan_vat_document"  type="file" class="custom-file-input" required>
                                    <label for="pan_vat_document" class="custom-file-label">Upload Pan/Vat document</label>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Create Agent</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- Sweet Alert -->
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!-- SUMMERNOTE -->
    <script src="<?php echo e(asset('admin/js/plugins/summernote/summernote-bs4.js')); ?>"></script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

        });
    </script>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>

    <script>
        $('#handle').on('click', function (e) {

            e.preventDefault();

            swal({
                title: "Are you sure?",
                text: "This user will be set as an Agent",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, approve",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#handleBtn').trigger('click');
                swal.close();
            })
        });
    </script>

    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/agent/create.blade.php ENDPATH**/ ?>