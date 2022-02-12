<a data-toggle="modal" href="#modal-form-fund-transfer-request-from-bfi{{$id}}">
    <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-fund-transfer-request-from-bfi{{$id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 630px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Request from bfi</h3>
                        <hr>
                        @php
                            $decoded_request_from_bfi = json_decode($request_from_bfi);
                        @endphp
                        @if(!empty($decoded_request_from_bfi))
                        <dl class="row m-t-md">
                            @foreach($decoded_request_from_bfi as $key=>$value)
                                <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                <dd class="col-md-7">
                                    <?php print_r($value) ?>
                                </dd>
                            @endforeach
                        </dl>
                        @else

                            <dt class="text-left">No response from bfi</dt>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
