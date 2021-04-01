@if(is_array($context))
    @foreach($context as $key => $contextData)
        @if($key != 'exception' && $key != 'refStan' && $key != 'check_payment_id' && $key != 'execute_payment_id' && $key != 'transaction_id')
            <a data-toggle="modal" href="#modal-context-{{$log->id}}-{{$key}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
            <div id="modal-context-{{$log->id}}-{{$key}}" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 class="m-t-none m-b">{{ $key }}</h3>
                                    <hr>
                                    <dl class="row m-t-md">
                                        @if(is_string($contextData))
                                            <dt class="col-md-3 text-right">{{$key}}: </dt>
                                            <dd class="col-md-8">{{ $contextData }}</dd>

                                        @endif

                                        @if(is_array($contextData))
                                            @foreach($contextData as $contextKey => $data)
                                                <dt class="col-md-5 text-right">{{$contextKey}}: </dt>
                                                @if(! is_array($data))
                                                    <dd class="col-md-6">{{ $data }}</dd>
                                                @else
                                                    <dd class="col-md-6"></dd>
                                                    @foreach($data as $key1 => $value1)
                                                        <dt class="col-md-5  text-right">{{ $key1 }}</dt>
                                                        @if(! is_array($value1))
                                                            <dd class="col-md-6"><?php print_r($value1) ?></dd>
                                                        @else
                                                            <dd class="col-md-6"></dd>
                                                            @foreach($value1 as $key2 => $value2)
                                                                <dt class="col-md-5  text-right">{{ $key2 }}</dt>
                                                                @if(! is_array($value2))
                                                                    <dd class="col-md-6"><?php print_r($value2) ?></dd>
                                                                @else
                                                                    <dd class="col-md-6"></dd>
                                                                    @foreach($value2 as $key3 => $value3)
                                                                        <dt class="col-md-5  text-right">{{ $key3 }}</dt>
                                                                        <dd class="col-md-6"><?php print_r($value3) ?></dd>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endforeach
@endif
