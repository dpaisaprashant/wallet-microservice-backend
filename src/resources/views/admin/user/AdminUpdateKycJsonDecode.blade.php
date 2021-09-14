@if(!empty($adminUpdatedKyc))
    @if($type == "before_change")
        <a data-toggle="modal" href="#BeforeChange{{$adminUpdatedKyc->id}}" ><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
        <div id="BeforeChange{{ $adminUpdatedKyc->id }}" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 795px">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">User Kyc before update </h3>
                                <hr>
                                @php
                                    $response = json_decode($adminUpdatedKyc->kyc_before_change,true);
                                @endphp
                                @include('admin.user.JsonDecodeLogic',['response'=>$response])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($type == "after_change")
        <a data-toggle="modal" href="#AfterChange{{$adminUpdatedKyc->id}}" ><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
        <div id="AfterChange{{ $adminUpdatedKyc->id }}" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 795px">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">User Kyc After update </h3>
                                <hr>
                                @php
                                    $response = json_decode($adminUpdatedKyc->kyc_after_change,true);
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
