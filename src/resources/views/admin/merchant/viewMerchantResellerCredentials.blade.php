<a data-toggle="modal" style="margin-top: 5px" href="#modal-form-fund-transfer{{$id}}"
   class="btn btn-sm btn-icon btn-info m-t-n-xs" title="View Credentials">
    <button class="btn btn-sm btn-icon btn-warning m-t-n-xs" type="button"><i class="fa fa-eye"></i></button>
</a>
<div id="modal-form-fund-transfer{{ $id }}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 630px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Merchant Credentials</h3>
                        <hr>
                        <dl class="row m-t-md">
                            <dt class="col-md-3 ">Secret Key: </dt>
                            <dd class="col-md-9"> @if(optional($merchant->merchantReseller)->secret_key != null)
                                    {{ optional($merchant->merchantReseller)->secret_key }}
                                @else
                                    Not Set
                                @endif
                            </dd>

                            <dt class="col-md-3 ">API Key: </dt>
                            <dd class="col-md-9"> @if(optional($merchant->merchantReseller)->api_key != null)
                                    {{ optional($merchant->merchantReseller)->api_key }}
                                @else
                                    Not Set
                                @endif
                            </dd>

                            <dt class="col-md-3 ">API Username: </dt>
                            <dd class="col-md-9"> @if(optional($merchant->merchantReseller)->api_username != null)
                                    {{ optional($merchant->merchantReseller)->api_username }}
                                @else
                                    Not Set
                                @endif
                            </dd>

                            <dt class="col-md-3 ">API Password: </dt>
                            <dd class="col-md-9"> @if(optional($merchant->merchantReseller)->api_password_not_hashed != null)
                                    {{ optional($merchant->merchantReseller)->api_password_not_hashed }}
                                @else
                                    Not Set
                                @endif
                            </dd>

                            <dt class="col-md-3">Status: </dt>
                            <dd class="col-md-9"> @if(optional($merchant->merchantReseller)->status == "1")
                                    <span class="badge badge-primary">True</span>
                                @elseif(optional($merchant->merchantReseller)->status == "0")
                                    <span class="badge badge-danger">False</span>
                                @else
                                                      Not Set
                                @endif
                            </dd>


                        </dl>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
