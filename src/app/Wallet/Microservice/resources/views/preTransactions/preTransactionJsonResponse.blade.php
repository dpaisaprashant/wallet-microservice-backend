@if(!empty($preTransaction))
<a data-toggle="modal" href="#JsonResponse{{$preTransaction->id}}" ><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
<div id="JsonResponse{{ $preTransaction->id }}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Pre-Transaction Json Response Info For <br> Pre-Transaction Id: {{$preTransaction->pre_transaction_id}}</h3>
                        <hr>
                        @php
                            $response = json_decode($preTransaction->json_response,true);
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
                            @else
                                {{(string)$response}}    
                            @endif

                        </dl>
                        @else

                            <dt class="text-left">No Data</dt>

                        @endif     

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
