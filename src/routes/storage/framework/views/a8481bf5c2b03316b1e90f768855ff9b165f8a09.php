<div role="tabpanel" id="notification" class="tab-pane">
    <div class="panel-body">
        <div class="ibox-content">
            <form method="post" enctype="multipart/form-data" id="notificationForm" action="<?php echo e(route('notification.user', $user)); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>

                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" required></div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="form-group  row"><label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-lg-10 col-sm-10">
                        <div class="ibox ">

                            <div class="ibox-content no-padding">

                                            <textarea name="message" style="height: 100px; width: 100%" required>
                                            </textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="form-group  row">
                    <label class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input name="image" id="logo1" type="file" class="custom-file-input">
                            <label for="logo1" class="custom-file-label">Choose file...</label>
                        </div>

                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary btn-sm" type="submit">Send Notification</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/notification.blade.php ENDPATH**/ ?>