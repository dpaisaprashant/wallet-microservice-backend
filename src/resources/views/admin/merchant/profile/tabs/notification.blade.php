<div role="tabpanel" id="notification" class="tab-pane">
    <div class="panel-body">
        <div class="ibox-content">
            <form method="post" enctype="multipart/form-data" id="notificationForm" action="{{ route('notification.merchant', $merchant) }}">
                @csrf
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


                <div class="form-group row">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary btn-sm" type="submit">Send SMS</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
