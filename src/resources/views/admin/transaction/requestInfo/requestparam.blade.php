<a data-toggle="modal" href="#modal-form-request-param{{$requestInfo->id}}">
    <button class="btn btn-warning btn-icon" type="button" title="Request Parameters"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-request-param{{$requestInfo->id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 750px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Request Parameters</h3>
                        <hr>
                        @php
                            $requestParam = json_decode($requestInfo->request_param,true);
                        @endphp
                        @if(!empty($requestParam))
                        <dl class="row m-t-md">
                            @if (is_array($requestParam) || is_object($requestParam))

                                @foreach ($requestParam as $key=>$value)
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
                                            $secondLevelParam = $value;
                                        @endphp
                                        @if (is_array($secondLevelParam) || is_object($secondLevelParam))
                                            @foreach($secondLevelParam as $key=>$value)

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