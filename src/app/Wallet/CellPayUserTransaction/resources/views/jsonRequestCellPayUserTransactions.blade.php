@if(!empty($cellPayUserTransaction))
    <a data-toggle="modal" href="#JsonRequest{{$cellPayUserTransaction->id}}" ><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="JsonRequest{{ $cellPayUserTransaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">CellPay User-Transactions Json Request Info For <br> Account: {{$cellPayUserTransaction->account}}</h3>
                            <hr>
                            @php
                                $request = json_decode($cellPayUserTransaction->request,true);
                            @endphp
                            @if(!empty($request))
                                <dl class="row m-t-md">
                                    @if (is_array($request) || is_object($response))

                                        @foreach ($request as $key=>$value)
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
                                        <dd class="col-md-5 text-left">{{(string)$request}} </dd>
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
