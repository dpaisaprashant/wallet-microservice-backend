@if($agentHierarchyPayment->response_json != null)
    <a  data-toggle="modal" href="#modal-form-agent-hierarchy-payment{{$agentHierarchyPayment->id}}">
        <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
    </a>
    <div id="modal-form-agent-hierarchy-payment{{ $agentHierarchyPayment->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 700px">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-`12">
                            <h3 class="m-t-none m-b">Response</h3>
                            <hr>
                            <dl class="row m-t-md">
                                @if($agentHierarchyPayment->response_json != null)
                                    <?php $response = json_decode($agentHierarchyPayment->response_json, true)?>
                                @endif
                                @if($response != null)
                                    @foreach($response as $key => $value)
                                        <dt class="col-md-5 text-right">{{ $key }} :</dt>
                                        <dd class="col-md-6">
                                            @if(is_array($value) || is_object($value))
                                                @foreach($value as $secondKey=>$secondValue)
                                                    <b>{{ $secondKey }} :</b>
                                                    @if(!is_array($secondValue) || !is_object($secondValue))
                                                        {{$secondValue}}
                                                        <br>
                                                    @else
                                                        {{ $secondValue }}
                                                    @endif
                                                @endforeach
                                            @else
                                                {{$value}}
                                            @endif
                                        </dd>
                                    @endforeach
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div>
        No Response.
    </div>
@endif
