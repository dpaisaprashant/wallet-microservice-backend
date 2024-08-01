@if(!empty($adminAlteredAgent))
    @if($type == "before_change")
        <a data-toggle="modal" href="#BeforeChange{{$adminAlteredAgent->id}}" ><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
        <div id="BeforeChange{{ $adminAlteredAgent->id }}" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 795px">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">Agent Before Change by Admin </h3>
                                <hr>
                                @php
                                    $response = json_decode($adminAlteredAgent->agent_before,true);
                                @endphp
                                @include('admin.user.JsonDecodeLogic',['response'=>$response])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($type == "after_change")
        <a data-toggle="modal" href="#AfterChange{{$adminAlteredAgent->id}}" ><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
        <div id="AfterChange{{ $adminAlteredAgent->id }}" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 795px">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">Agent After Change By Admin</h3>
                                <hr>
                                @php
                                    $response = json_decode($adminAlteredAgent->agent_after,true);
                                @endphp
                                @include('admin.user.JsonDecodeLogic',['response'=>$response])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
