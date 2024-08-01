<div role="tabpanel" id="agent" class="tab-pane <?php if($activeTab == 'agent'): ?> active <?php endif; ?>">
    <div class="panel-body">

        <div class="row">
            <div class="col-md-7">
                <dl class="row m-t-md">

                    <?php if(!empty($user->agent)): ?>

                        <dt class="col-md-3 text-right">Agent OR Sub Agent</dt>
                        <dd class="col-md-8"><?php if($user->isAgent()): ?> AGENT <?php elseif($user->isSubAgent()): ?> SUB AGENT <?php endif; ?></dd>

                        <?php if(isset($user->agent->code_used_id)): ?>
                        <dt class="col-md-3 text-right">Parent Agent</dt>
                        <dd class="col-md-8"><?php echo e($user->agent->codeUsed->name . " ({$user->agent->codeUsed->mobile_no})"); ?></dd>
                        <?php endif; ?>
                        <dt class="col-md-3 text-right">Business Name</dt>
                        <dd class="col-md-8"><?php echo e($user->agent->business_name); ?></dd>

                        <dt class="col-md-3 text-right">Business Pan</dt>
                        <dd class="col-md-8"><?php echo e($user->agent->business_pan); ?></dd>

                        <dt class="col-md-3 text-right">Agent Type</dt>
                        <dd class="col-md-8">
                            <?php if(isset($user->agent->agentType)): ?>
                            <?php echo e($user->agent->agentType->name); ?>

                            <?php else: ?>
                                NOT SET
                            <?php endif; ?>
                        </dd>

                        <dt class="col-md-3 text-right">Reference Code</dt>
                        <dd class="col-md-8"><?php echo e($user->agent->reference_code); ?></dd>

                        <dt class="col-md-3 text-right">Company Address</dt>
                        <dd class="col-md-8"><?php echo e($user->agent->company_address); ?></dd>

                    <?php else: ?>
                        <dt class="col-md-3 text-right" style="font-size: 16px;">Agent form not filled</dt>
                    <?php endif; ?>
                </dl>
            </div>
            <?php if(!empty($user->agent)): ?>
                <div class="col-md-5">
                    <h3>Documents</h3>
                    <div id="agentCarouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php if(isset($user->agent['business_document'])): ?>
                                <li data-target="#agentCarouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <?php endif; ?>

                            <?php if(isset($user->agent['business_owner_citizenship_front'])): ?>
                                <li data-target="#agentCarouselExampleIndicators" data-slide-to="1" class="<?php if(empty($user->agent['business_document'])): ?> active <?php endif; ?>"></li>
                            <?php endif; ?>

                            <?php if(isset($user->agent['business_owner_citizenship_back'])): ?>
                                <li data-target="#agentCarouselExampleIndicators" data-slide-to="2" class=""></li>
                            <?php endif; ?>

                                <?php if(isset($user->agent['pp_photo'])): ?>
                                    <li data-target="#agentCarouselExampleIndicators" data-slide-to="3" class=""></li>
                                <?php endif; ?>

                                <?php if(isset($user->agent['pan_vat_document'])): ?>
                                    <li data-target="#agentCarouselExampleIndicators" data-slide-to="3" class=""></li>
                                <?php endif; ?>

                            <?php if(isset($user->agent['tax_clearance_certificate'])): ?>
                                <li data-target="#agentCarouselExampleIndicators" data-slide-to="3" class=""></li>
                            <?php endif; ?>
                        </ol>
                        <div class="carousel-inner">

                            <?php if(isset($user->agent['business_document'])): ?>
                            <div class="carousel-item active">
                                <a href="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['business_document']); ?>" target="_blank">
                                    <img class="d-block w-100" src="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['business_document']); ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            BUSINESS DOCUMENT
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if(isset($user->agent['business_owner_citizenship_front'])): ?>
                            <div class="carousel-item <?php if(empty($user->agent['business_document'])): ?> active <?php endif; ?>">
                                <a href="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['business_owner_citizenship_front']); ?>" target="_blank">
                                    <img class="d-block w-100" src="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['business_owner_citizenship_front']); ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                           BUSINESS OWNER CITIZENSHIP FRONT
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if(isset($user->agent['business_owner_citizenship_back'])): ?>
                            <div class="carousel-item">
                                <a href="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['business_owner_citizenship_back']); ?>" target="_blank">
                                    <img class="d-block w-100" src="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['business_owner_citizenship_back']); ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            BUSINESS OWNER CITIZENSHIP BACK
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if(isset($user->agent['pp_photo'])): ?>
                            <div class="carousel-item">
                                <a href="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['pp_photo']); ?>" target="_blank">
                                    <img class="d-block w-100" src="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['pp_photo']); ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            PP PHOTO
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if(isset($user->agent['pan_vat_document'])): ?>
                                    <div class="carousel-item">
                                        <a href="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['pan_vat_document']); ?>" target="_blank">
                                            <img class="d-block w-100" src="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['pan_vat_document']); ?>" alt="First slide">
                                            <div class="carousel-caption d-none d-md-block">
                                                <p style="color: black; font-weight: bold;">
                                                    PAN/VAT DOCUMENT
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            <?php if(isset($user->agent['tax_clearance_certificate'])): ?>
                            <div class="carousel-item">
                                <a href="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['tax_clearance_certificate']); ?>" target="_blank">
                                    <img class="d-block w-100" src="<?php echo e(config('dpaisa-api-url.admin_documentation_url') . $user->agent['tax_clearance_certificate']); ?>" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            TAX CLEARANCE CERTIFICATE
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>

                        <a class="carousel-control-prev" href="#agentCarouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#agentCarouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/agent.blade.php ENDPATH**/ ?>