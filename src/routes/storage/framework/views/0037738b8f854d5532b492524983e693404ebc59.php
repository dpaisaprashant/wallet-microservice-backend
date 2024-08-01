<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit user kyc')): ?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row m-b-lg m-t-lg">
                <div class="col-md-4" style="margin-top: 20px;">
                    <div class="profile-image">
                        <?php if(isset($user->kyc['p_photo'])): ?>
                            <img src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['p_photo']); ?>"
                                 class="rounded-circle circle-border m-b-md" alt="profile">
                        <?php else: ?>
                            <img src="<?php echo e(asset('admin/img/a4.jpg')); ?>" class="rounded-circle circle-border m-b-md"
                                 alt="profile">
                        <?php endif; ?>
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    <?php echo e($user->name); ?>

                                </h2>
                                <h4>Joined: <?php echo e(date('M d, Y', strtotime($user->created_at))); ?></h4>
                                <h4>Number: <?php echo e($user->mobile_no); ?></h4>

                                <?php if(!empty($user->kyc)): ?>
                                    <h4>Address: <?php echo e($user->kyc->district); ?>, Province <?php echo e($user->kyc->province); ?></h4>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5" style="margin-top: 20px;">

                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Edit User KYC Details</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="<?php echo e(route('user.updateKyc',$user->id)); ?>"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-7">
                                        <dl class="row m-t-md">
                                            <?php if(!empty($user->kyc)): ?>
                                                <?php if($user->kyc->status == 1 && $user->kyc->accept == 1): ?>

                                                    <dt class="col-md-3 text-right">Verification Status</dt>
                                                    <dd class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <i style="color: green;" class="fa fa-check"></i>
                                                                Verified
                                                            </div>
                                                        </div>
                                                    </dd>
                                                <?php else: ?>
                                                    <dt class="col-md-3 text-right"
                                                        style="margin-top: auto; margin-bottom: auto;">Verification
                                                        Status
                                                    </dt>
                                                    <dd class="col-md-8" style="margin-top: auto; margin-bottom: auto;">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <?php if($user->kyc->accept === null): ?>
                                                                    <i style="color: red;" class="fa fa-times"></i> Not
                                                                    Verified
                                                                <?php else: ?>
                                                                    <i style="color: red;" class="fa fa-times"></i> KYC
                                                                    Rejected
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </dd>
                                                <?php endif; ?>
                                                <dt class="col-md-3 text-right">
                                                    <label for="first_name">First Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="first_name"
                                                           value="<?php echo e($user->kyc->first_name == null ? 'Not available' : $user->kyc->first_name); ?>"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="middle_name">Middle Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="middle_name"
                                                           value="<?php echo e($user->kyc->middle_name == null ? ' ' : $user->kyc->middle_name); ?>">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="last_name">Last Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="last_name"
                                                           value="<?php echo e($user->kyc->last_name == null ? 'Not available' : $user->kyc->last_name); ?>"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="email">Email:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="email"
                                                           value="<?php echo e($user->kyc->email == null ? 'Not available' : $user->kyc->email); ?>"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="date_of_birth">Date Of Birth:</label>
                                                <dd class="col-md-8">
                                                        <?php echo $__env->make('admin.user.datepicker',['type'=>'dob'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="gender">Gender:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="gender" class="form-control form-control-sm" required>
                                                        <?php if($user->kyc->gender == 'm'): ?>
                                                            <option selected value="m">Male</option>
                                                            <option value="f">Female</option>
                                                            <option value="o">Other</option>
                                                        <?php elseif($user->kyc->gender == 'f'): ?>
                                                            <option value="m">Male</option>
                                                            <option selected value="f">Female</option>
                                                            <option value="o">Other</option>
                                                        <?php elseif($user->kyc->gender == 'o'): ?>
                                                            <option value="m">Male</option>
                                                            <option value="f">Female</option>
                                                            <option selected value="o">Other</option>
                                                        <?php endif; ?>
                                                    </select>

                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="fathers_name">Fathers Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="fathers_name" value="<?php echo e($user->kyc->fathers_name); ?>"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="mothers_name">Mothers Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="mothers_name" value="<?php echo e($user->kyc->mothers_name); ?>"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="grand_fathers_name">Grandfather's Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="grand_fathers_name"
                                                           value="<?php echo e($user->kyc->grand_fathers_name); ?>" required>
                                                </dd>


                                                <dt class="col-md-3 text-right">
                                                    <label for="spouse_name">Spouse Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="spouse_name" value="<?php echo e($user->kyc->spouse_name); ?>">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="occupation">Occupation:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="occupation" value="<?php echo e($user->kyc->occupation); ?>"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="document_type">Identity Type:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="document_type" class="form-control form-control-sm"
                                                            required>
                                                        <?php if($user->kyc->document_type == 'c'): ?>
                                                            <option selected value="c">Citizenship</option>
                                                            <option value="p">Passport</option>
                                                            <option value="l">License</option>
                                                        <?php elseif($user->kyc->gender == 'p'): ?>
                                                            <option value="c">Citizenship</option>
                                                            <option selected value="p">Passport</option>
                                                            <option value="l">License</option>
                                                        <?php elseif($user->kyc->gender == 'l'): ?>
                                                            <option value="c">Citizenship</option>
                                                            <option value="p">Passport</option>
                                                            <option selected value="l">License</option>
                                                        <?php else: ?>
                                                            <option selected value="">Select Document</option>
                                                            <option value="c">Citizenship</option>
                                                            <option value="p">Passport</option>
                                                            <option value="l">License</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="id_no">Identity Number:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="id_no"
                                                           value="<?php echo e($user->kyc->id_no); ?>" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="c_issued_date">Identity Issue Date:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <?php echo $__env->make('admin.user.datepicker',['type'=>'issueDate'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="c_issued_from">Identity Issue From:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="c_issued_from" value="<?php echo e($user->kyc->c_issued_from); ?>"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="province">Province:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="province" id="province" class="form-control form-control-sm" required>
                                                        <?php if($user->kyc->province): ?>
                                                            <option value="" disabled><b>-- Select Province --</b></option>
                                                            <option value="<?php echo e($user->kyc->province); ?>" selected><?php echo e($user->kyc->province); ?></option>
                                                        <?php else: ?>
                                                            <option value="" selected disabled>-- Select Province --</option>
                                                        <?php endif; ?>
                                                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(!($user->kyc->province == $province)): ?>
                                                                <option value="<?php echo e($province); ?>"><?php echo e($province); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </dd>


                                                    <dt class="col-md-3 text-right">
                                                    <label for="district">District:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                    <select name="district" id="district" class="form-control form-control-sm" required>
                                                <?php if($user->kyc->province): ?>
                                                        <option value="" disabled><b>-- Select District --</b></option>
                                            <?php else: ?>
                                                <option value="" selected disabled>-- Select District --</option>
                                                    <?php endif; ?>
                                                </select>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                    <label for="municipality">Municipality:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                    <select name="municipality" id="municipality" class="form-control form-control-sm" required>
                                                <?php if($user->kyc->municipality): ?>
                                                        <option value="" disabled><b>-- Select Municipality --</b></option>
                                            <?php else: ?>
                                                <option value="" selected disabled>-- Select Municipality --</option>
                                                    <?php endif; ?>
                                                </select>
                                                    </dd>
                                                    <dt class="col-md-3 text-right">
                                                        <label for="zone">Zone:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <select name="zone" class="form-control form-control-sm">
                                                            <?php if($user->kyc->zone): ?>
                                                                <option value="" disabled><b>-- Select Zone --</b></option>
                                                                <option value="<?php echo e(strtoupper($user->kyc->zone)); ?>" selected><?php echo e($user->kyc->zone); ?></option>
                                                            <?php else: ?>
                                                                <option value="" selected disabled>-- Select Zone --</option>
                                                            <?php endif; ?>
                                                            <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(!(strtoupper($user->kyc->zone) == $zone)): ?>
                                                                    <option value="<?php echo e($zone); ?>"><?php echo e($zone); ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="ward_no">Ward No:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="ward_no" value="<?php echo e($user->kyc->ward_no); ?>" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="tmp_province">Temporary Province:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="tmp_province" id="tmp_province" class="form-control form-control-sm" required>
                                                        <?php if($user->kyc->tmp_province): ?>
                                                            <option value="" disabled><b>-- Select Temporary Province --</b></option>
                                                            <option value="<?php echo e($user->kyc->tmp_province); ?>" selected><?php echo e($user->kyc->tmp_province); ?></option>
                                                        <?php else: ?>
                                                            <option value="" selected disabled>-- Select Temporary Province --</option>
                                                        <?php endif; ?>
                                                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(!($user->kyc->tmp_province == $province)): ?>
                                                                <option value="<?php echo e($province); ?>"><?php echo e($province); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </dd>


                                                    <dt class="col-md-3 text-right">
                                                    <label for="tmp_district">Temporary District:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                    <select name="tmp_district" id="tmp_district" class="form-control form-control-sm" required>
                                                <?php if($user->kyc->tmp_province): ?>
                                                        <option value="" disabled><b>-- Select Temporary District --</b></option>
                                            <?php else: ?>
                                                <option value="" selected disabled>-- Select Temporary District --</option>
                                                    <?php endif; ?>
                                                </select>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                    <label for="tmp_municipality">Temporary Municipality:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                    <select name="tmp_municipality" id="tmp_municipality" class="form-control form-control-sm" required>
                                                <?php if($user->kyc->tmp_municipality): ?>
                                                        <option value="" disabled><b>-- Select Municipality --</b></option>
                                            <?php else: ?>
                                                <option value="" selected disabled>-- Select Municipality --</option>
                                                    <?php endif; ?>
                                                </select>
                                                    </dd>
                                                    <dt class="col-md-3 text-right">
                                                        <label for="tmp_zone">Temporary Zone:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <select name="tmp_zone" class="form-control form-control-sm">
                                                            <?php if($user->kyc->tmp_zone): ?>
                                                                <option value="" disabled><b>-- Select Temporary Zone --</b></option>
                                                                <option value="<?php echo e(strtoupper($user->kyc->tmp_zone)); ?>" selected><?php echo e($user->kyc->tmp_zone); ?></option>
                                                            <?php else: ?>
                                                                <option value="" selected disabled>-- Select Temporary Zone --</option>
                                                            <?php endif; ?>
                                                            <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if(!(strtoupper($user->kyc->tmp_zone) == $zone)): ?>
                                                                    <option value="<?php echo e($zone); ?>"><?php echo e($zone); ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="tmp_ward_no">Temporary Ward No:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="tmp_ward_no" value="<?php echo e($user->kyc->tmp_ward_no); ?>"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="p_photo">Passport Size Photo: </label>
                                                </dt>
                                                <dd class="col-md-7">
                                                    <div class="custom-file">
                                                        <input name="p_photo" type="file" class="custom-file-input">
                                                        <label for="p_photo" class="custom-file-label">Upload Passport
                                                            size photo...</label>
                                                    </div>
                                                </dd>
                                                <dd class="col-md-1">
                                                    <img
                                                        src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['p_photo']); ?>"
                                                        style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                        alt="">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="id_photo_front">Document Front Photo: </label>
                                                </dt>
                                                <dd class="col-md-7">

                                                    <div class="custom-file">
                                                        <input name="id_photo_front" type="file"
                                                               class="custom-file-input">
                                                        <label for="id_photo_front" class="custom-file-label">Upload
                                                            Document Front Photo...</label>
                                                    </div>
                                                </dd>
                                                <dd class="col-md-1">
                                                    <img
                                                        src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front']); ?>"
                                                        style="max-width: 50px; max-height: 35px; object-fit: cover"
                                                        alt="">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="id_photo_back">Document back Photo: </label>
                                                </dt>
                                                <dd class="col-md-7">
                                                    <div class="custom-file">
                                                        <input name="id_photo_back" type="file"
                                                               class="custom-file-input">
                                                        <label for="id_photo_back" class="custom-file-label">Upload
                                                            Document Back Photo...</label>
                                                    </div>
                                                </dd>
                                                <dd class="col-md-1">
                                                    <img
                                                        src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back']); ?>"
                                                        style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                        alt="">
                                                </dd>

                                                <?php if($user->merchant()->first()): ?>
                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_name">Company name</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="company_name"
                                                               value="<?php echo e($user->kyc->company_name); ?>" required>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_address">Company address</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="company_address"
                                                               value="<?php echo e($user->kyc->company_address); ?>" required>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_vat_pin_number">Company VAT PIN
                                                            number:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="company_vat_pin_number"
                                                               value="<?php echo e($user->kyc->company_vat_pin_number); ?>"
                                                               required>
                                                    </dd>


                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_logo">Company Logo: </label>
                                                    </dt>
                                                    <dd class="col-md-7">
                                                        <div class="custom-file">
                                                            <input name="company_logo" type="file"
                                                                   class="custom-file-input">
                                                            <label for="company_logo" class="custom-file-label">Upload
                                                                Company Logo...</label>
                                                        </div>
                                                    </dd>
                                                    <dd class="col-md-1">
                                                        <img
                                                            src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo']); ?>"
                                                            style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                            alt="">
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_document">Company Document:</label>
                                                    </dt>
                                                    <dd class="col-md-7">
                                                        <div class="custom-file">
                                                            <input name="company_document" type="file"
                                                                   class="custom-file-input">
                                                            <label for="company_document" class="custom-file-label">Upload
                                                                Company Document...</label>
                                                        </div>
                                                    </dd>
                                                    <dd class="col-md-1">
                                                        <img
                                                            src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo']); ?>"
                                                            style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                            alt="">
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_vat_document">Company VAT Document:</label>
                                                    </dt>
                                                    <dd class="col-md-7">
                                                        <div class="custom-file">
                                                            <input name="company_vat_document" type="file"
                                                                   class="custom-file-input">
                                                            <label for="company_vat_document" class="custom-file-label">Upload
                                                                Company VAT Document...</label>
                                                        </div>
                                                    </dd>
                                                    <dd class="col-md-1">
                                                        <img
                                                            src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_vat_document']); ?>"
                                                            style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                            alt="">
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_tax_clearance_document">Company Tax
                                                            Clearance Document:</label>
                                                    </dt>
                                                    <dd class="col-md-7">
                                                        <div class="custom-file">
                                                            <input name="company_tax_clearance_document" type="file"
                                                                   class="custom-file-input">
                                                            <label for="company_tax_clearance_document"
                                                                   class="custom-file-label">Upload Company Tax
                                                                Clearance Document...</label>
                                                        </div>
                                                    </dd>
                                                    <dd class="col-md-1">
                                                        <img
                                                            src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_tax_clearance_document']); ?>"
                                                            style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                            alt="">
                                                    </dd>
                                                <?php endif; ?>

                                                <div class="col-sm-4 col-sm-offset-2" style="float:right">
                                                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                                </div>
                                            <?php else: ?>
                                                <dt class="col-md-3 text-right" style="font-size: 16px;">KYC form not
                                                    filled
                                                </dt>
                                            <?php endif; ?>
                                        </dl>
                                    </div>
                                    <?php if(!empty($user->kyc)): ?>
                                        <div class="col-md-5">
                                            <h3>Documents</h3>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front']); ?>"
                                                           target="_blank">
                                                            <img
                                                                src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front']); ?>"
                                                                style="max-width: 500px;object-fit: cover"
                                                                alt="">
                                                            <p style="color: black; font-weight: bold;">
                                                                &nbsp;DOCUMENT FRONT
                                                            </p>
                                                        </a>
                                                    </div>

                                                    <div class="col-12">
                                                        <a href="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back']); ?>"
                                                           target="_blank"></a>
                                                        <img
                                                            src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back']); ?>"
                                                            style="max-width: 500px;object-fit: cover"
                                                            alt="">
                                                        <p style="color: black; font-weight: bold;">
                                                            &nbsp;DOCUMENT BACK
                                                        </p>
                                                    </div>

                                                    <?php if($user->merchant()->first()): ?>

                                                        <div class="col-12">
                                                            <a href="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_document']); ?>"
                                                               target="_blank"></a>
                                                            <img
                                                                src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_document']); ?>"
                                                                style="max-width: 500px;object-fit: cover"
                                                                alt="">
                                                            <p style="color: black; font-weight: bold;">
                                                                &nbsp;COMPANY DOCUMENT
                                                            </p>
                                                        </div>

                                                        <div class="col-12">
                                                            <a href="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo']); ?>"
                                                               target="_blank">
                                                                <img
                                                                    src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo']); ?>"
                                                                    style="max-width: 500px;object-fit: cover"
                                                                    alt="">
                                                                <p style="color: black; font-weight: bold;">
                                                                    &nbsp;COMPANY LOGO
                                                                </p>
                                                            </a>
                                                        </div>

                                                        <div class="col-12">
                                                            <a href="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_vat_document']); ?>"
                                                               target="_blank">
                                                                <img
                                                                    src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_vat_document']); ?>"
                                                                    style="max-width: 500px;object-fit: cover"
                                                                    alt="">
                                                                <p style="color: black; font-weight: bold;">
                                                                    &nbsp;COMPANY VAT DOCUMENT
                                                                </p>
                                                            </a>
                                                        </div>

                                                        <div class="col-12">
                                                            <a href="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_tax_clearance_document']); ?>"
                                                               target="_blank">
                                                                <img
                                                                    src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_tax_clearance_document']); ?>"
                                                                    style="max-width: 500px;object-fit: cover"
                                                                    alt="">
                                                                <p style="color: black; font-weight: bold;">
                                                                    &nbsp;COMPANY TAX CLEARANCE DOCUMENT
                                                                </p>
                                                            </a>
                                                        </div>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>

    <style>
        .select {
            display: none;
        }

        label {
            margin-right: 20px;
        }
    </style>

    <style>
        .btn-sm {
            padding: 2px;
        }
    </style>

    <style>
        .profile-image img {
            width: 125px;
            height: 125px;
        }

        .profile-image {
            width: 145px;
        }
    </style>

    <!-- Sweet Alert -->
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">
    <?php echo $__env->make('admin.asset.css.icheck', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.icheck', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>

    <script>
        $('#accept').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "KYC for this user will be verified",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, accept KYC!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                document.getElementById("acceptStatusInput").value = "accepted";
                $('#acceptBtn').trigger('click');
                swal.close();
            })
        });

        //
        // $('#reject').on('click', function (e) {
        //
        //     e.preventDefault();
        //     let url = $(this).attr('rel');
        //
        //     swal({
        //         title: "Are you sure?",
        //         text: "KYC for this user will be rejected",
        //         type: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#ed5565",
        //         confirmButtonText: "Yes, reject KYC!",
        //         closeOnConfirm: true,
        //         closeOnClickOutside: true
        //     }, function () {
        //         $('#rejectBtn').trigger('click');
        //         swal.close();
        //
        //     })
        // });


        var checkAll = $('.select-all');
        var checkboxes = $('input[type="checkbox"]');


        checkAll.on('ifChecked ifUnchecked', function (event) {

            if (event.type == "ifChecked") {
                $('input[type="checkbox"]').iCheck('check');
                $('#selectdata').html('<b>Deselect all</b>');
            } else {
                $('input[type="checkbox"]').iCheck('uncheck');
                $('#selectdata').html('<b>Select all</b>');
            }

        });


    </script>
    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>

    <script>
        function showDobBS(){
            document.getElementById('BS').style.display ='block';
            document.getElementById('AD').style.display ='none';
        }
        function showDobAD(){
            document.getElementById('AD').style.display ='block';
            document.getElementById('BS').style.display ='none';
        }
        function showIssueDateBS(){
            document.getElementById('BS_issue').style.display ='block';
            document.getElementById('AD_issue').style.display ='none';
        }
        function showIssueDateAD(){
            document.getElementById('AD_issue').style.display ='block';
            document.getElementById('BS_issue').style.display ='none';
        }
    </script>

    <script>
        $(window).on('load',function() {
            //pre-loading permanent Districts
            if (`<?php echo e($user->kyc->province); ?>`){
                $('select#province').filter(function (e) {
                    let province = `<?php echo e($user->kyc->province); ?>`;

                    let url = `<?php echo e(route('get.district')); ?>`


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: "POST",
                        data: {province: province},
                        dataType: 'JSON',
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            $("#overlay").fadeIn(300);
                        },
                        success: function (resp) {
                            console.log(resp)

                            let select = $('#district');
                            select.find('option').remove().end();

                            $.each(resp, function (key, value) {
                                if (`<?php echo e($user->kyc->district); ?>` == value){
                                    let o = new Option(value, value, false, true);
                                    select.append(o);
                                }else {
                                    let o = new Option(value, value, false, false);
                                    select.append(o);
                                }
                            });
                            select.trigger("chosen:updated");

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);

                        },
                        error: function (resp) {
                            console.log(resp);
                            alert('error');

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);
                        }
                    });
                });
            }
            //pre-loading permanent Districts Ends

            //pre-loading permanent Municipalities
            if (`<?php echo e($user->kyc->district); ?>`){
                $('select#district').filter(function (e) {
                    let district = `<?php echo e($user->kyc->district); ?>`;

                    let url = `<?php echo e(route('get.municipality')); ?>`


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: "POST",
                        data: {district: district},
                        dataType: 'JSON',
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            $("#overlay").fadeIn(300);
                        },
                        success: function (resp) {
                            console.log(resp)

                            let select = $('#municipality');
                            select.find('option').remove().end();

                            $.each(resp, function (key, value) {
                                if (`<?php echo e($user->kyc->municipality); ?>` == value){
                                    let o = new Option(value, value, false, true);
                                    select.append(o);
                                }else {
                                    let o = new Option(value, value, false, false);
                                    select.append(o);
                                }
                            });
                            select.trigger("chosen:updated");

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);

                        },
                        error: function (resp) {
                            console.log(resp);
                            alert('error');

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);
                        }
                    });
                });
            }
            //pre-loading permanent Municipalities Ends

        //    pre-loading temporary Districts
            if (`<?php echo e($user->kyc->tmp_province); ?>`){
                $('select#tmp_province').filter(function (e) {
                    let province = `<?php echo e($user->kyc->tmp_province); ?>`;

                    let url = `<?php echo e(route('get.district')); ?>`


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: "POST",
                        data: {province: province},
                        dataType: 'JSON',
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            $("#overlay").fadeIn(300);
                        },
                        success: function (resp) {
                            console.log(resp)

                            let select = $('#tmp_district');
                            select.find('option').remove().end();

                            $.each(resp, function (key, value) {
                                if (`<?php echo e($user->kyc->tmp_district); ?>` == value){
                                    let o = new Option(value, value, false, true);
                                    select.append(o);
                                }else {
                                    let o = new Option(value, value, false, false);
                                    select.append(o);
                                }
                            });
                            select.trigger("chosen:updated");

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);

                        },
                        error: function (resp) {
                            console.log(resp);
                            alert('error');

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);
                        }
                    });
                });
            }
        //    pre-loadiing Temporary Districts Ends

        //    pre_loading Temporary Municipalities Starts
            if (`<?php echo e($user->kyc->tmp_district); ?>`){
                $('select#tmp_district').filter(function (e) {
                    let district = `<?php echo e($user->kyc->tmp_district); ?>`;

                    let url = `<?php echo e(route('get.municipality')); ?>`


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: "POST",
                        data: {district: district},
                        dataType: 'JSON',
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            $("#overlay").fadeIn(300);
                        },
                        success: function (resp) {
                            console.log(resp)

                            let select = $('#tmp_municipality');
                            select.find('option').remove().end();

                            $.each(resp, function (key, value) {
                                if (`<?php echo e($user->kyc->tmp_municipality); ?>` == value){
                                    let o = new Option(value, value, false, true);
                                    select.append(o);
                                }else {
                                    let o = new Option(value, value, false, false);
                                    select.append(o);
                                }
                            });
                            select.trigger("chosen:updated");

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);

                        },
                        error: function (resp) {
                            console.log(resp);
                            alert('error');

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);
                        }
                    });
                });
            }
        //    pre_loading Temporary Municipalities Ends

        });
    </script>



    <script>
        $('#province').on('change', function (e) {
            let province = $(this).val();
            console.log(province);

            let url = `<?php echo e(route('get.district')); ?>`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {province: province},
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#district');
                    select.find('option').remove().end();

                    let municipality = $('#municipality');
                    municipality.find('option').remove().end();
                    let m = new Option('--Select District First',null,false,);
                    municipality.append(m);
                    municipality.find('option').attr("disabled","disabled");

                    $.each(resp, function (key, value) {
                        if (`<?php echo e($user->kyc->district); ?>` == value){
                            let o = new Option(value, value, false, true);
                            select.append(o);
                        }else {
                            let o = new Option(value, value, false, false);
                            select.append(o);
                        }
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>



    <script>
        $('#district').on('change', function (e) {
            let district = $(this).val();
            console.log(district);

            let url = `<?php echo e(route('get.municipality')); ?>`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {district: district},
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#municipality');
                    select.find('option').remove().end();

                    $.each(resp, function (key, value) {
                        if (`<?php echo e($user->kyc->municipality); ?>` == value){
                            let o = new Option(value, value, false, true);
                            select.append(o);
                        }else {
                            let o = new Option(value, value, false, false);
                            select.append(o);
                        }
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>



    <script>
        $('#tmp_province').on('change', function (e) {
            let province = $(this).val();
            console.log(province);

            let url = `<?php echo e(route('get.district')); ?>`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {province: province},
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#tmp_district');
                    select.find('option').remove().end();

                    let municipality = $('#tmp_municipality');
                    municipality.find('option').remove().end();
                    let m = new Option('--Select Temporary District First',null,false,);
                    municipality.append(m);
                    municipality.find('option').attr("disabled","disabled")

                    $.each(resp, function (key, value) {
                        if (`<?php echo e($user->kyc->tmp_district); ?>` == value){
                            let o = new Option(value, value, false, true);
                            select.append(o);
                        }else {
                            let o = new Option(value, value, false, false);
                            select.append(o);
                        }
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>



    <script>
        $('#tmp_district').on('change', function (e) {
            let district = $(this).val();
            console.log(district);

            let url = `<?php echo e(route('get.municipality')); ?>`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {district: district},
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#tmp_municipality');
                    select.find('option').remove().end();

                    $.each(resp, function (key, value) {
                        if (`<?php echo e($user->kyc->tmp_municipality); ?>` == value){
                            let o = new Option(value, value, false, true);
                            select.append(o);
                        }else {
                            let o = new Option(value, value, false, false);
                            select.append(o);
                        }
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/user/EditKyc.blade.php ENDPATH**/ ?>