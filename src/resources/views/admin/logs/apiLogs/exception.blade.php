@if(is_array($exception))
    @if(count($exception) > 0)
        <a data-toggle="modal" href="#modal-exception-{{$log->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
        <div id="modal-exception-{{$log->id}}" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">Exception</h3>
                                <hr>
                                <dl class="row m-t-md">
                                    @foreach($exception as $exceptionKey => $exceptionValue)
                                        @if($exceptionKey != 'trace')
                                            <dt class="col-md-3 text-right">{{$exceptionKey}}: </dt>
                                            <dd class="col-md-8">{{ $exceptionValue }}</dd>
                                        @endif
                                    @endforeach
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
