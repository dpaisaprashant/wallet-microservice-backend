<a data-toggle="modal" href="#modal-form-fund-transfer-response-to-bfi{{$id}}">
    <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-fund-transfer-response-to-bfi{{$id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 630px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <dl class="col-sm-12">
                        <h3 class="m-t-none m-b">Response to bfi</h3>
                        <hr>
                        @php

                            $decoded_response_to_bfi = json_decode($response_to_bfi,true);

                        @endphp
                        @if(!empty($decoded_response_to_bfi))
                            <dl class="row m-t-md">
                                @if (is_array($decoded_response_to_bfi) || is_object($decoded_response_to_bfi))
                                    @foreach($decoded_response_to_bfi as $key=>$value)

                                        @if(!is_array($value))
                                            <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                            <dd class="col-lg-offset-1"></dd>
                                            <dd class="col-md-5 text-left">{{ $value == null ? 'Null' : $value }} </dd>
                                        @else
                                            <hr>
                                            <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                            <dd class="col-lg-offset-1"></dd>
                                            <dd class="col-md-5 text-left"></dd>
                                            <hr>

                                            @php
                                                $secondLevelResponse = $value;
                                            @endphp
                                            @if (is_array($secondLevelResponse) || is_object($secondLevelResponse))
                                                @foreach($secondLevelResponse as $key=>$value)
                                                    <dt class="col-md-5 text-left">{{ $key }} :</dt>
                                                    <dd class="col-md-7 text-left"><?php print_r($value) ?></dd>
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </dl>
                        @else

                                <dt class="text-left">No response to bfi</dt>

                        @endif
                    </dl>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
