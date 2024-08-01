<div role="tabpanel" id="kyc" class="tab-pane <?php if($activeTab == 'kyc'): ?> active <?php endif; ?>">
    <div class="panel-body">

        <div class="row">
            <div class="col-md-7">
                <dl class="row m-t-md">

                    <?php if(!empty($user->kyc)): ?>

                        <?php if($admin_details == null): ?>
                            <dt class="col-md-3 text-right">Admin Name</dt>
                            <dd class="col-md-8">Not available</dd>
                            <dt class="col-md-3 text-right">Admin Email</dt>
                            <dd class="col-md-8">Not available</dd>
                            <dt class="col-md-3 text-right">Created at</dt>
                            <dd class="col-md-8">Not available</dd>
                            <br><br>
                        <?php else: ?>
                            <dt class="col-md-3 text-right">Admin Name</dt>
                            <dd class="col-md-8"><?php echo e($admin_details->name); ?></dd>
                            <dt class="col-md-3 text-right">Admin Email</dt>
                            <dd class="col-md-8"><?php echo e($admin_details->email); ?></dd>
                            <dt class="col-md-3 text-right">Created at</dt>
                            <dd class="col-md-8"><?php echo e(\Carbon\Carbon::parse($admin_details->created_at)->format('F d, Y')); ?></dd>
                            <br><br>

                        <?php endif; ?>
                        <br>
                        <dt class="col-md-3 text-right">First Name</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->first_name == null ? 'Not available' : $user->kyc->first_name); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->first_name==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>
                        <dt class="col-md-3 text-right">Middle Name</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->middle_name == null ? ' ' : $user->kyc->middle_name); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->middle_name==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>
                        <dt class="col-md-3 text-right">Last Name</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->last_name == null ? 'Not available' : $user->kyc->last_name); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->last_name==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>


                        <?php if(/*$user->kyc->status == 1 */ true): ?>
                            <dt class="col-md-3 text-right">Verification Status</dt>
                            <dd class="col-md-8">

                                <?php echo $__env->make('admin.user.kyc.status', ['kyc' => $user->kyc], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </dd>
                        <?php else: ?>

                            <dt class="col-md-3 text-right" style="margin-top: auto; margin-bottom: auto;">Verification
                                Status
                            </dt>
                            <dd class="col-md-8" style="margin-top: auto; margin-bottom: auto;">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Verify KYC')): ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php echo $__env->make('admin.user.kyc.status', ['kyc' => $user->kyc], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        <div class="col-md-2" style="padding-right: 0px; margin-left: -45px;">
                                            <form id="kycForm" action="<?php echo e(route('user.changeKYCStatus')); ?>"
                                                  method="post">

                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" value="<?php echo e($user->kyc->id); ?>" name="kyc">
                                                <input type="hidden" value="accepted" name="status">
                                                <button rel="<?php echo e(route('user.changeKYCStatus')); ?>" id="accept"
                                                        class="btn btn-primary btn-sm kyc-btn" type="submit">Accept
                                                </button>
                                                <button id="acceptBtn" class="btn btn-primary" type="submit"
                                                        style="display: none">Verify KYC
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-2" style="padding-left: 0px; margin-left: -10px;">
                                            <form id="kycForm" action="<?php echo e(route('user.changeKYCStatus')); ?>"
                                                  method="post">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" value="<?php echo e($user->kyc->id); ?>" name="kyc">
                                                <input type="hidden" value="rejected" name="status">
                                                <button rel="<?php echo e(route('user.changeKYCStatus')); ?>" id="reject"
                                                        class="btn btn-danger btn-sm kyc-btn" type="submit">Reject
                                                </button>
                                                <button id="rejectBtn" class="btn btn-primary" type="submit"
                                                        style="display: none">Verify KYC
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif; ?>


                            </dd>

                        <?php endif; ?>




                        <dt class="col-md-3 text-right">Date of birth</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->date_of_birth); ?> AD
                            <br>
                            <?php echo e($user->kyc->date_of_birth_bs); ?> <?php if($user->kyc->date_of_birth_bs): ?> BS <?php endif; ?>
                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->date_of_birth==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>



                        <dt class="col-md-3 text-right">Gender</dt>
                        <dd class="col-md-8">
                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->gender == 'm'): ?>
                                    Male
                                <?php elseif($user->kyc->gender == 'f'): ?>
                                    Female
                                <?php elseif($user->kyc->gender == 'o'): ?>
                                    Other
                                <?php endif; ?>
                                <?php if($user->kyc->kycValidation->gender==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Address</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->municipality); ?>, <?php echo e($user->kyc->district); ?>, Nepal
                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->municipality==0 || $user->kyc->kycValidation->district==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Father's Name</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->fathers_name); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->fathers_name==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Mother's Name</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->mothers_name); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->mothers_name==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Grandfathers's Name</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->grand_fathers_name); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->grand_fathers_name==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Occupation</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->occupation); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->occupation ==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Identity Type</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->documentationType()); ?></dd>

                        <dt class="col-md-3 text-right">Identity Number</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->id_no); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->id_no==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Identity Issue Date</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->c_issued_date); ?> AD
                            <br>
                            <?php echo e($user->kyc->c_issued_date_bs); ?> <?php if($user->kyc->c_issued_date_bs): ?> BS <?php endif; ?>
                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->c_issued_date==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Identity Issue From</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->c_issued_from); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->c_issued_from==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Province</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->province); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->province==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Zone</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->zone); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->zone==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">District</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->district); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->district==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Municipality</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->municipality); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->municipality==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Ward No.</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->ward_no); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->ward_no==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>



                        <dt class="col-md-3 text-right">Tmp Province</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->tmp_province); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->tmp_province==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Tmp Zone</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->tmp_zone); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->tmp_zone==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Tmp District</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->tmp_district); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->tmp_district==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Tmp Municipality</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->tmp_municipality); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->tmp_municipality==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Tmp Ward No.</dt>
                        <dd class="col-md-8"><?php echo e($user->kyc->tmp_ward_no); ?>

                            <?php if(isset($user->kyc->kycValidation)): ?>
                                <?php if($user->kyc->kycValidation->tmp_ward_no==0): ?>
                                    <i class="fa fa-exclamation-circle" style="color: #ec4758" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                        </dd>


                    <?php else: ?>
                        <dt class="col-md-3 text-right" style="font-size: 16px;">KYC form not filled</dt>
                    <?php endif; ?>
                </dl>
            </div>
            <?php if(!empty($user->kyc)): ?>
                <div class="col-md-5">
                    <h3>Documents</h3>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front']); ?>"
                                   target="_blank">
                                    <img class="d-block w-100"
                                         src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front']); ?>"
                                         alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            DOCUMENT FRONT
                                        </p>
                                    </div>
                                </a>

                            </div>

                            <div class="carousel-item">
                                <a href="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back']); ?>"
                                   target="_blank">
                                    <img class="d-block w-100"
                                         src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back']); ?>"
                                         alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            DOCUMENT BACK
                                        </p>
                                    </div>
                                </a>

                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>


                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/kyc.blade.php ENDPATH**/ ?>