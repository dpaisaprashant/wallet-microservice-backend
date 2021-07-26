<a data-toggle="modal" href="#modal-form-fund-transfer-response-from-wallet{{$id}}">
    <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-fund-transfer-response-from-wallet{{$id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 630px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Response from wallet</h3>
                        <hr>
                        @php
                            $decoded_response_from_wallet = json_decode($response_from_wallet,true);

                        @endphp
                        @if(!empty($decoded_response_from_wallet))
                        <dl class="row m-t-md">
                            @if (is_array($decoded_response_from_wallet) || is_object($decoded_response_from_wallet))

                                @foreach ($decoded_response_from_wallet as $key=>$value)
                                    @if(!is_array($value))
                                        <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                        <dd class="col-lg-offset-1"></dd>
                                        <dd class="col-md-5 text-left">{{ $value == null ? 'Null' : $value }} </dd>
                                    @else
                                        <hr>
                                        <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                        <dd class="col-lg-offset-1"></dd>
                                        <dd class="col-md-5 text-left"> </dd><hr>

                                        @php
                                            $secondLevelResponse = $value;
                                        @endphp
                                        @if (is_array($secondLevelResponse) || is_object($secondLevelResponse))
                                            @foreach($secondLevelResponse as $key=>$value)

                                            @if(is_string($value))
                                                    <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                                <dd class="col-md-7 text-left">{{ $value == null ? 'Null' : ($value) }} </dd>
                                                @endif

                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            @endif

                        </dl>
                        @else

                            <dt class="text-left">No response from wallet</dt>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
