<a data-toggle="modal" href="#modal-form-fund-transfer-request-to-wallet{{$id}}">
    <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-fund-transfer-request-to-wallet{{$id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 630px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Request to wallet</h3>
                        <hr>
                        @php

                            $decoded_request_to_wallet = json_decode($request_to_wallet,true);
                        @endphp
                        @if(!empty($decoded_request_to_wallet))
                        <dl class="row m-t-md">
                            @foreach($decoded_request_to_wallet as $key=>$value)
                                <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                <?php print_r($value) ?>
                            @endforeach
                        </dl>
                        @else

                            <dt class="text-left">No request to wallet</dt>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
