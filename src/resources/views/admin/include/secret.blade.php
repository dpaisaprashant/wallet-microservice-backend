<a data-toggle="modal" href="#modal-form-fund-transfer{{$secret}}" title="Secret Key"><button class="btn btn-warning btn-icon  m-t-n-xs" type="button"><i class="fa fa-info"></i></button></a>
<div id="modal-form-fund-transfer{{ $secret }}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 630px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Secret Key</h3>
                        <hr>
                        <dl class="row m-t-md">
                            <dt class="col-md-3 text-right">{{$secret}}</dt>

                        </dl>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
