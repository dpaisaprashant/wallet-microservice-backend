<a data-toggle="modal" href="#modal-form-json-request{{$npsAccountLinkLoad->id}}">
    <button class="btn btn-warning btn-icon" type="button" title="Json Request"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-json-request{{$npsAccountLinkLoad->id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 750px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Json Request</h3>
                        <hr>
                        @if(!empty($npsAccountLinkLoad->json_request))
                                {{$npsAccountLinkLoad->json_request}}
                        @else
                            <dl class="text-left">No Data</dl>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
