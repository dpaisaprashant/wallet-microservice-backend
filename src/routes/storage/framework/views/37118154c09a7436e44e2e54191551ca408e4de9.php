<?php $__env->startSection('content'); ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-4" style="margin-top: 20px;">
                <div class="profile-image">
                    <?php if(isset($user->kyc['p_photo'])): ?>
                    <?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['p_photo']); ?>

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
                            <?php echo $__env->make('admin.user.userType.displayUserTypes',['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        <h5>User KYC Details</h5>
                        <?php if($user->kyc): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit user kyc')): ?>
                                <a style="margin-top: -10px; padding: 8px;display: inline; float: right"
                                   href="<?php echo e(route('user.editKyc',$user->id)); ?>"
                                   class="btn btn-sm btn-primary m-t-n-xs"
                                   title="user profile">
                                    <i class="fa fa-pencil"> EDIT</i>
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create user kyc')): ?>
                                    <a style="margin-top: -10px; padding: 8px;display: inline; float: right"
                                       href="<?php echo e(route('user.createUserKyc',$user->id)); ?>"
                                       class="btn btn-sm btn-primary m-t-n-xs"
                                       title="user profile">
                                        <i class="fa fa-pencil"> CREATE</i>
                                    </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="ibox-content">
                        <?php if($user->merchant()->first()): ?>
                            <form id="kycForm" action="<?php echo e(route('merchant.changeKYCStatus')); ?>" method="post">
                            <?php else: ?>
                                    <form id="kycForm" action="<?php echo e(route('user.changeKYCStatus')); ?>" method="post">
                                <?php endif; ?>
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-7">
                                    <dl class="row m-t-md">
                                        <?php if(!empty($user->kyc)): ?>
                                            <?php if($user->kyc->status == 1 && $user->kyc->accept == 1): ?>
                                                <div class="col-12">
                                                    <div class="i-checks">
                                                        <input type="checkbox" class="select-all" id="select-all">&nbsp;&nbsp;
                                                        <label id="selectdata" for="select-all"><b>Select
                                                                All</b></label>
                                                    </div>
                                                </div>
                                                <dt class="col-md-3 text-right">Verification Status</dt>
                                                <dd class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <i style="color: green;" class="fa fa-check"></i> Verified
                                                        </div>
                                                        <?php if($user->kyc->accept === 0 ): ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('KYC accept')): ?>
                                                                <div class="col-md-2"
                                                                     style="padding-right: 0px; margin-left: -45px;">
                                                                    
                                                                    <input type="hidden" value="<?php echo e($user->kyc->id); ?>"
                                                                           name="kyc">
                                                                    <input type="hidden" value="accepted" name="status">
                                                                    <input type="hidden" value="accepted"
                                                                           name="accept_status">
                                                                    <button rel="<?php echo e(route('user.changeKYCStatus')); ?>"
                                                                            id="accept" class="btn btn-primary btn-sm"
                                                                            type="submit">Accept
                                                                    </button>
                                                                    <button id="acceptBtn" type="submit"
                                                                            style="display: none"></button>
                                                                    
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <?php if($user->kyc->accept === 1 ): ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('KYC reject')): ?>
                                                                <div class="col-md-2"
                                                                     style="padding-left: 0px; margin-left: -10px;">
                                                                    
                                                                    <input type="hidden" value="<?php echo e($user->kyc->id); ?>"
                                                                           name="kyc">
                                                                    <input type="hidden" value="rejected" name="status">
                                                                    <a data-toggle="modal" href="#modal-reject-kyc">
                                                                        <button class="btn btn-danger btn-sm"
                                                                                type="button">
                                                                            Reject
                                                                        </button>
                                                                    </a>
                                                                    <button id="rejectBtn" type="submit"
                                                                            style="display: none"></button>
                                                                    <div id="modal-reject-kyc" class="modal fade"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <h3 class="m-t-none m-b">
                                                                                                Reason of rejection</h3>
                                                                                            <hr>
                                                                                            <div
                                                                                                class="form-group  row">
                                                                                                <textarea
                                                                                                    class="form-control"
                                                                                                    name="reason"
                                                                                                    id="reason"
                                                                                                    placeholder="Reason of rejection"
                                                                                                    style="width: 100%">Your KYC form has been rejected</textarea>
                                                                                            </div>

                                                                                            <div
                                                                                                class="hr-line-dashed"></div>

                                                                                            <button style="width: 100%"
                                                                                                    rel="<?php echo e(route('user.changeKYCStatus')); ?>"
                                                                                                    id="reject"
                                                                                                    class="btn btn-danger ">
                                                                                                Reject
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                </dd>
                                            <?php else: ?>
                                                <div class="col-12">
                                                    <div class="i-checks">
                                                        <input type="checkbox" class="select-all" id="select-all">&nbsp;&nbsp;
                                                        <label id="selectdata" for="select-all"><b>Select
                                                                all</b></label>
                                                    </div>

                                                </div>
                                                <dt class="col-md-3 text-right"
                                                    style="margin-top: auto; margin-bottom: auto;">Verification Status
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
                                                        <?php if($user->kyc->accept === 0 || $user->kyc->accept === null): ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('KYC accept')): ?>
                                                                <div class="col-md-2"
                                                                     style="padding-right: 0px; margin-left: -45px;">
                                                                    
                                                                    <input type="hidden" value="<?php echo e($user->kyc->id); ?>"
                                                                           name="kyc">
                                                                    <input type="hidden" value="accepted" name="status"
                                                                           id="acceptInputValue">
                                                                    <input type="hidden" value="" name="accept_status"
                                                                           id="acceptStatusInput">
                                                                    <button rel="<?php echo e(route('user.changeKYCStatus')); ?>"
                                                                            id="accept" class="btn btn-primary btn-sm"
                                                                            type="submit">Accept
                                                                    </button>
                                                                    <button id="acceptBtn" type="submit"
                                                                            style="display: none"></button>
                                                                    
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <?php if($user->kyc->accept == 1 || $user->kyc->accept === null): ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('KYC reject')): ?>
                                                                <div class="col-md-2"
                                                                     style="padding-left: 0px; margin-left: -10px;">
                                                                    
                                                                    <input type="hidden" value="<?php echo e($user->kyc->id); ?>"
                                                                           name="kyc">
                                                                    <input type="hidden" value="rejected" name="status">
                                                                    <a data-toggle="modal" href="#modal-reject-kyc">
                                                                        <button class="btn btn-danger btn-sm"
                                                                                type="button">
                                                                            Reject
                                                                        </button>
                                                                    </a>
                                                                    <button id="rejectBtn" type="submit"
                                                                            style="display: none"></button>
                                                                    <div id="modal-reject-kyc" class="modal fade"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <h3 class="m-t-none m-b">
                                                                                                Reason of rejection</h3>
                                                                                            <hr>
                                                                                            <div
                                                                                                class="form-group  row">
                                                                                                <textarea
                                                                                                    class="form-control"
                                                                                                    name="reason"
                                                                                                    id="reason"
                                                                                                    placeholder="Reason of rejection"
                                                                                                    style="width: 100%">Your KYC form has been rejected</textarea>
                                                                                            </div>

                                                                                            <div
                                                                                                class="hr-line-dashed"></div>

                                                                                            <button style="width: 100%"
                                                                                                    rel="<?php echo e(route('user.changeKYCStatus')); ?>"
                                                                                                    id="reject"
                                                                                                    class="btn btn-danger ">
                                                                                                Reject
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </dd>
                                            <?php endif; ?>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="first_name"
                                                               class="check" <?php echo e(optional($user->kyc->kycValidation)->first_name ? "checked" : ""); ?>>
                                                        <i></i> First Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->first_name == null ? 'Not available' : $user->kyc->first_name); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="middle_name"
                                                               class="check" <?php echo e(optional($user->kyc->kycValidation)->middle_name ? "checked" : ""); ?>>
                                                        <i></i> Middle Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->middle_name == null ? ' ' : $user->kyc->middle_name); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="last_name" <?php echo e(optional($user->kyc->kycValidation)->last_name ? "checked" : ""); ?>>
                                                        <i></i> Last Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->last_name == null ? 'Not available' : $user->kyc->last_name); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="email" <?php echo e(optional($user->kyc->kycValidation)->email ? "checked" : ""); ?>>
                                                        <i></i> Email
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->email == null ? 'Not available' : $user->kyc->email); ?></dd>


                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="date_of_birth" <?php echo e(optional($user->kyc->kycValidation)->date_of_birth ? "checked" : ""); ?>>
                                                        <i></i> Date of Birth
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->date_of_birth); ?> AD
                                                <br>
                                                <?php echo e($user->kyc->date_of_birth_bs); ?> <?php if($user->kyc->date_of_birth_bs): ?>BS <?php endif; ?>
                                            </dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="gender" <?php echo e(optional($user->kyc->kycValidation)->gender ? "checked" : ""); ?>>
                                                        <i></i> Gender
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">
                                                <?php if($user->kyc->gender == 'm'): ?>
                                                    Male
                                                <?php elseif($user->kyc->gender == 'f'): ?>
                                                    Female
                                                <?php elseif($user->kyc->gender == 'o'): ?>
                                                    Other
                                                <?php endif; ?>
                                            </dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="fathers_name" <?php echo e(optional($user->kyc->kycValidation)->fathers_name ? "checked" : ""); ?>>
                                                        <i></i>Father's Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->fathers_name); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="mothers_name" <?php echo e(optional($user->kyc->kycValidation)->mothers_name ? "checked" : ""); ?>>
                                                        <i></i>Mother's Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->mothers_name); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="grand_fathers_name" <?php echo e(optional($user->kyc->kycValidation)->grand_fathers_name ? "checked" : ""); ?>>
                                                        <i></i>Grandfathers's Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->grand_fathers_name); ?></dd>


                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="spouse_name" <?php echo e(optional($user->kyc->kycValidation)->spouse_name ? "checked" : ""); ?>>
                                                        <i></i>Spouse Name
                                                    </label>
                                                </div>
                                            </dt>


                                            <dd class="col-md-8"><?php echo e($user->kyc->spouse_name); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="occupation" <?php echo e(optional($user->kyc->kycValidation)->occupation ? "checked" : ""); ?>>
                                                        <i></i>Occupation
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->occupation); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="document_type" <?php echo e(optional($user->kyc->kycValidation)->document_type ? "checked" : ""); ?>>
                                                        <i></i>Identity Type
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->documentationType()); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="id_no" <?php echo e(optional($user->kyc->kycValidation)->id_no ? "checked" : ""); ?>>
                                                        <i></i>Identity Number
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->id_no); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="c_issued_date" <?php echo e(optional($user->kyc->kycValidation)->c_issued_date ? "checked" : ""); ?>>
                                                        <i></i>Identity Issue Date
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e(($user->kyc->c_issued_date)); ?> AD
                                                <br>
                                                <?php echo e($user->kyc->c_issued_date_bs); ?> <?php if($user->kyc->c_issued_date_bs): ?>BS <?php endif; ?>
                                            </dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="c_issued_from" <?php echo e(optional($user->kyc->kycValidation)->c_issued_from ? "checked" : ""); ?>>
                                                        <i></i>Identity Issue From
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->c_issued_from); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="province" <?php echo e(optional($user->kyc->kycValidation)->province ? "checked" : ""); ?>>
                                                        <i></i>Province
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->province); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="zone" <?php echo e(optional($user->kyc->kycValidation)->zone ? "checked" : ""); ?>>
                                                        <i></i>Zone
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->zone); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="district" <?php echo e(optional($user->kyc->kycValidation)->district ? "checked" : ""); ?>>
                                                        <i></i>District
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->district); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="municipality" <?php echo e(optional($user->kyc->kycValidation)->municipality ? "checked" : ""); ?>>
                                                        <i></i>Municipality
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->municipality); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="ward_no" <?php echo e(optional($user->kyc->kycValidation)->ward_no ? "checked" : ""); ?>>
                                                        <i></i>Ward No.
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->ward_no); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_province" <?php echo e(optional($user->kyc->kycValidation)->tmp_province ? "checked" : ""); ?>>
                                                        <i></i>Tmp Province
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->tmp_province); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_zone" <?php echo e(optional($user->kyc->kycValidation)->tmp_zone ? "checked" : ""); ?>>
                                                        <i></i>Tmp Zone
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->tmp_zone); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_district" <?php echo e(optional($user->kyc->kycValidation)->tmp_district ? "checked" : ""); ?>>
                                                        <i></i>Tmp District
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->tmp_district); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_municipality" <?php echo e(optional($user->kyc->kycValidation)->tmp_municipality ? "checked" : ""); ?>>
                                                        <i></i>Tmp Municipality
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->tmp_municipality); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_ward_no" <?php echo e(optional($user->kyc->kycValidation)->tmp_ward_no ? "checked" : ""); ?>>
                                                        <i></i>Tmp Ward No.
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->tmp_ward_no); ?></dd>



                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="p_photo" <?php echo e(optional($user->kyc->kycValidation)->p_photo ? "checked" : ""); ?>>
                                                        <i></i>Passport size photo
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->p_photo); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="id_photo_front" <?php echo e(optional($user->kyc->kycValidation)->id_photo_front ? "checked" : ""); ?>>
                                                        <i></i>Document Front Photo
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->id_photo_front); ?></dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="id_photo_back" <?php echo e(optional($user->kyc->kycValidation)->id_photo_back ? "checked" : ""); ?>>
                                                        <i></i>Document Back Photo
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8"><?php echo e($user->kyc->id_photo_back); ?></dd>

                                            <?php if($user->merchant()->first()): ?>
                                                <dt class="col-md-3 text-right">
                                                    <div class="i-checks">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="company_name" <?php echo e(optional($user->kyc->kycValidation)->company_name ? "checked" : ""); ?>>
                                                            <i></i>Company name
                                                        </label>
                                                    </div>
                                                </dt>
                                                <dd class="col-md-8"><?php echo e($user->kyc->company_name); ?></dd>

                                                <dt class="col-md-3 text-right">
                                                    <div class="i-checks">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="company_address" <?php echo e(optional($user->kyc->kycValidation)->company_address ? "checked" : ""); ?>>
                                                            <i></i>Company address
                                                        </label>
                                                    </div>
                                                </dt>
                                                <dd class="col-md-8"><?php echo e($user->kyc->company_address); ?></dd>


                                                <dt class="col-md-3 text-right">
                                                    <div class="i-checks">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="company_vat_pin_number" <?php echo e(optional($user->kyc->kycValidation)->company_vat_pin_number ? "checked" : ""); ?>>
                                                            <i></i>Company VAT PIN number
                                                        </label>
                                                    </div>
                                                </dt>
                                                <dd class="col-md-8"><?php echo e($user->kyc->company_vat_pin_number); ?></dd>


                                                <dt class="col-md-3 text-right">
                                                    <div class="i-checks">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="company_logo" <?php echo e(optional($user->kyc->kycValidation)->company_logo ? "checked" : ""); ?>>
                                                            <i></i>Company Logo
                                                        </label>
                                                    </div>
                                                </dt>
                                                <dd class="col-md-8"><?php echo e($user->kyc->company_logo); ?></dd>

                                                <dt class="col-md-3 text-right">
                                                    <div class="i-checks">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="company_document" <?php echo e(optional($user->kyc->kycValidation)->company_document ? "checked" : ""); ?>>
                                                            <i></i>Company Document
                                                        </label>
                                                    </div>
                                                </dt>
                                                <dd class="col-md-8"><?php echo e($user->kyc->company_document); ?></dd>

                                                <dt class="col-md-3 text-right">
                                                    <div class="i-checks">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="company_vat_document" <?php echo e(optional($user->kyc->kycValidation)->company_vat_document ? "checked" : ""); ?>>
                                                            <i></i>Company VAT Document
                                                        </label>
                                                    </div>
                                                </dt>
                                                <dd class="col-md-8"><?php echo e($user->kyc->company_vat_document); ?></dd>

                                                <dt class="col-md-3 text-right">
                                                    <div class="i-checks">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="company_tax_clearance_document" <?php echo e(optional($user->kyc->kycValidation)->company_tax_clearance_document ? "checked" : ""); ?>>
                                                            <i></i>Company Tax Clearance Document
                                                        </label>
                                                    </div>
                                                </dt>
                                                <dd class="col-md-8"><?php echo e($user->kyc->company_tax_clearance_document); ?></dd>

                                            <?php endif; ?>
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
                                                       target="_blank">
                                                    <img
                                                        src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back']); ?>"
                                                        style="max-width: 500px;object-fit: cover"
                                                        alt="">
                                                    <p style="color: black; font-weight: bold;">
                                                        &nbsp;DOCUMENT BACK
                                                    </p>
                                                    </a>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.icheck', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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


        $('#reject').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "KYC for this user will be rejected",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed5565",
                confirmButtonText: "Yes, reject KYC!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#rejectBtn').trigger('click');
                swal.close();

            })
        });


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
<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/user/kyc.blade.php ENDPATH**/ ?>