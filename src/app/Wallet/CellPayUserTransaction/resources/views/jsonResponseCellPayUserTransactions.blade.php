@if(!empty($cellPayUserTransaction))
    <a data-toggle="modal" href="#JsonResponse{{$cellPayUserTransaction->id}}" ><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="JsonResponse{{ $cellPayUserTransaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Json Response Info For <br> Account: {{$cellPayUserTransaction->account}}</h3>
                            <hr>
                            @php
                                $response = json_decode($cellPayUserTransaction->response,true);
                            @endphp
                            @if(!empty($response))
                                <dl class="row m-t-md">
                                    @if (is_array($request) || is_object($response))

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
                                    @else
                                        <dt class="col-md-5 text-left">Request :</dt>
                                        <dd class="col-lg-offset-1"></dd>
                                        <dd class="col-md-5 text-left">{{(string)$response}} </dd>
                                    @endif

                                </dl>
                            @else

{{--                                <dt class="text-left">No Data</dt>--}}
                                <dt class="col-md-5 text-left">Request :</dt>
                                <dd class="col-lg-offset-1"></dd>
                                <dd class="col-md-5 text-left">{{(string)$cellPayUserTransaction->response}} </dd>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
