<a data-toggle="modal" href="#modal-form-json-response{{$requestInfo->id}}">
    <button class="btn btn-warning btn-icon" type="button" title="Json Response"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-json-response{{$requestInfo->id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 750px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Json Response</h3>
                        <hr>
                        @php
                            $response = json_decode($requestInfo->json_response,true);
                        @endphp
                        @if(!empty($response))
                        <dl class="row m-t-md">
                            @if (is_array($response) || is_object($response))

                                @foreach ($response as $key=>$value)
                                    @if(!is_array($value))
                                        <dt class="col-md-5 text-left" >{{ $key }} :</dt>
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
                        <dl class="text-left">No Data</dl>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>